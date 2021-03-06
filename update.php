<?php

    require ("./config/config.php");
    require ("./public/function.php");

    if(!empty($_GET['id'])) 
    {
        $id = test_input($_GET['id']);
    }
    $nom = $prenom = $n_identite = $sexe = $date_birth = $lieu_naissance = $nationalité = $taille = $poids = $adresse = $telephone = $nomError =$prenomError =$n_identiteError =$sexeError =$date_birthError =$lieu_naissanceError=$nationaliteError=$tailleError=$poidsError =$adresseError=$telephoneError ="";
    $isSuccess =false;
    $globalError = "";

    if (!empty($_POST)) {
        $nom = test_input($_POST["nom"]);
        $prenom = test_input($_POST["prenom"]);
        $n_identite = test_input($_POST["n_identite"]);
        $sexe = $_POST["sexe"] ;
        $date_birth = test_input($_POST["date_birth"]);
        $lieu_naissance = test_input($_POST["lieu_naissance"]);
        $nationalite = test_input($_POST["nationalite"]);
        $taille  = test_input($_POST["taille"]);
        $poids = test_input($_POST["poids"]);
        $adresse = test_input($_POST["adresse"]);
        $telephone = test_input($_POST["telephone"]);
        $isSuccess =true;

        if (empty($nom)) {
            $nomError = "<p class='animated flash ' style='color:red;'>Je veux connaitre ton prénom ! </p> ";
            $isSuccess = false; 
        }   else  {
            $nom;
        }

        if (empty($prenom)) {
            $prenomError = "<p class='animated flash ' style='color:red;'>Je veux connaitre ton préprenom ! </p> ";
            $isSuccess = false; 
        }   else  {
            $prenom;
        }

        if (empty($n_identite)) {
            $n_identiteError = "<p class='animated flash ' style='color:red;'>Je veux connaitre ton n_identite ! </p> ";
            $isSuccess = false; 
        }   else  {
            $n_identite ;
        }

        if (empty($sexe)) {
            $sexeError = "<p class='animated flash ' style='color:red;'>Je veux connaitre ton sexe ! </p> ";
            $isSuccess = false; 
        }   else  {
            $sexe;
        }

        if (empty($date_birth)) {
            $date_birthError = "<p class='animated flash ' style='color:red;'>Je veux connaitre ta date de naissance! </p> ";
            $isSuccess = false; 
        }   else  {
            $date_birth;
        }
        if (empty($lieu_naissance)) {
            $lieu_naissanceError = "<p class='animated flash ' style='color:red;'>Je veux connaitre ton lieu_naissance ! </p> ";
            $isSuccess = false; 
        }   else  {
            $lieu_naissance;
        }
        if (empty($nationalite)) {
            $nationaliteError = "<p class='animated flash ' style='color:red;'>Je veux connaitre ta  nationalite ! </p> ";
            $isSuccess = false; 
        }   else  {
            $nationalite;
        }
        if (empty($taille)) {
            $tailleError = "<p class='animated flash ' style='color:red;'>Je veux connaitre ta taille ! </p> ";
            $isSuccess = false; 
        }   else  {
            $taille;
        }
        if (empty($poids)) {
            $poidsError = "<p class='animated flash ' style='color:red;'>Je veux connaitre ton poids ! </p> ";
            $isSuccess = false; 
        }   else  {
            $poids;
        }
        if (empty($adresse)) {
            $adresseError = "<p class='animated flash ' style='color:red;'>Je veux connaitre ton adresse ! </p> ";
            $isSuccess = false; 
        }   else  {
            $adresse;
        }
        if (empty($telephone)) {
            $telephoneError = "<p class='animated flash ' style='color:red;'>Je veux connaitre ton telephone ! </p> ";
            $isSuccess = false; 
        }   else  {
            $telephone;
        }

        if ($isSuccess) {
            $db = Database::connect();
            $requette = $db -> prepare("UPDATE patients SET nom=?,prenom=?,n_identite=?,sexe=?,date_naissance=?,lieu_naissance=?,nationalite=?,taille=?,poids=?,adresse=?,telephone=? WHERE id= ?");
            $requette ->execute(array($nom,$prenom, $n_identite,$sexe, $date_birth, $lieu_naissance,$nationalite, $taille, $poids, $adresse, $telephone , $id ));
            
            Database::disconnect();
            header("Location: index.php");
        }
        
    } else {

        $db = Database::connect();
        $statement = $db->prepare("SELECT * FROM patients where id = ?");
        $statement->execute(array($id));
        $patient = $statement->fetch();

        $nom = $patient["nom"];
        $prenom = $patient["prenom"];
        $n_identite = $patient["n_identite"];
        $sexe = $patient["sexe"] ;
        $date_birth = $patient["date_naissance"];
        $lieu_naissance = $patient["lieu_naissance"];
        $nationalite = $patient["nationalite"];
        $taille  = $patient["taille"];
        $poids = $patient["poids"];
        $adresse = $patient["adresse"];
        $telephone = $patient["telephone"];

        Database::disconnect();
       
    }
   
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="public/css/bootstrap.css" >
    <script src="public/js/bootstrap.js" ></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <style>
        .heading{
            text-align: center;
        }
    </style>
    <link rel="stylesheet" href="public/css/animate.css">
    <title>Document</title>
</head>
<body>

    <div class="container">
            <div class="blue-divider"></div>
                <div class="heading">
                    <h2>formulaire d'ajout de patient</h2>
                </div>
    <div class="row">
            <div class="col-lg-10 col-lg-offset-1">
                <form action="" method="POST" id="patientsForm" >
                    <div class="row">
                            <div class="col-md-6">
                                <label for="nom">nom *</label>
                                <input id="nom"  type="text" name="nom" class="form-control" placeholder="Votre nom" value="<?= $nom; ?>" >
                                <p class="comments "></p>
                            </div>
                            <div class="col-md-6">
                                <label for="prenom">prenom *</label>
                                <input id="prenom"  type="text" name="prenom" class="form-control" placeholder="Votre prénom" value="<?= $prenom; ?>">
                                <p class="comments "></p>
                            </div>
                            <div class="col-md-6">
                                <label for="n_identite">n_identite *</label>
                                <input id="n_identite"  type="text" name="n_identite" class="form-control" placeholder="Votre n_identite"value="<?= $n_identite; ?>">
                                <p class="comments "><?php echo $n_identiteError;?></p>
                            </div>
                            <div class="col-md-6">
                                <label for="sexe">sexe *</label>
                                <select name="sexe" class="custom-select">
                                    <option  selected >choisir son genre </option>                                    
                                    <option value="F"  >feminin</option>
                                    <option value="M">masculin  </option>
                                </select>
                                <p class="comments "><?php echo $sexeError;?></p>
                            </div>
                            <div class="col-md-6">
                                <label for="date_birth">date de naissance *</label>
                                <input type="text" name="date_birth" id="date_birth"class="form-control" placeholder="exemple : 'AAAA/MM/JJ'" value="<?= $date_birth; ?>">
                                  
                                <p class="comments "><?php echo $date_birthError;?></p>
                            </div>
                            <div class="col-md-6">
                                <label for="lieu_naissance">lieu de naissance </label>
                                <input type="text" name="lieu_naissance" id="lieu_naissance"class="form-control" value="<?= $lieu_naissance; ?>">
                                <p class="comments "><?php echo $lieu_naissanceError;?></p>
                            </div>
                            <div class="col-md-6">
                                <label for="nationalite">nationalite*</label>
                                <input type="text" name="nationalite" id="nationalite"class="form-control" value="<?= $nationalite; ?>">
                                <p class="comments "><?php echo $nationaliteError;?></p>
                            </div>
                            <div class="col-md-6">
                                <label for="taille">taille*</label>
                                <input type="number" name="taille" id="taille"class="form-control" value="<?= $taille; ?>">
                                <p class="comments "><?php echo $tailleError;?></p>
                            </div>
                            <div class="col-md-6">
                                <label for="poids">poids*</label>
                                <input type="number" name="poids" id="poids"class="form-control" value="<?= $poids; ?>">
                                <p class="comments "><?php echo $poidsError;?></p>
                            </div>
                            <div class="col-md-6">
                                <label for="poids">adresse</label>
                                <input type="text" name="adresse" id="adresse"class="form-control" value="<?= $adresse; ?>">
                                <p class="comments "><?php echo $adresseError;?></p>
                            </div>
                            <div class="col-md-6">
                                <label for="telephone">telephone</label>
                                <input type="tel" name="telephone" id="telephone"class="form-control"value="<?= $telephone; ?>">
                                <p class="comments "><?php echo $telephoneError;?></p>
                            </div>

                            <div class="col-md-12">
                                <p style="color: red"><strong>* Ces informations sont requises.</strong></p>
                            </div>
                            <div class="col-md-12">
                                <button type="submit"   name="envoyer" class="btn btn-outline-success btn-md text-center">envoyer</button>
                               
                            </div> 
                            
                    </div>
                </form>
            </div>

        </div>
    </div>
    
</body>
</html>