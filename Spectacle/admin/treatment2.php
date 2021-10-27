<?php

session_start();

require_once('../config/database.php');

if ($_SERVER['HTTP_REFERER'] == 'http://localhost/spectacle/Spectacle/admin/form2.php') { // vérifie qu'on vient bien du formulaire

    // nettoyage des données
    $name = htmlspecialchars($_POST['name']);
    $alt = htmlspecialchars($_POST['alt']);
    $ville = htmlspecialchars($_POST['ville']);
    $salle = htmlspecialchars($_POST['salle']);
    $dateF = htmlspecialchars($_POST['dateF']);
    $dateD = htmlspecialchars($_POST['dateD']);
    $prix = htmlspecialchars($_POST['prix']);
    $descri = htmlspecialchars($_POST['descri']);
   
  
    $errorMessage = '<p>Merci de vérifier les points suivants :</p>';
    $validation = true;

    // vérification du titre
    if (empty($name) || strlen($name) > 100) {
        $errorMessage .= '<p>- le champ "name" est obligatoire et doit comporter moins de 100 caractères.</p>';
        $validation = false;
    }
    // vérification adresse
    if (empty($alt) || strlen($alt) > 100) {
        $errorMessage .= '<p>- le champ "alt" est obligatoire et doit comporter moins de 100 caractères.</p>';
        $validation = false;
    }
    // vérification ville
    if (empty($ville) || strlen($ville) > 100) {
        $errorMessage .= '<p>- le champ "ville" est obligatoire et doit comporter moins de 100 caractères.</p>';
        $validation = false;
    }
     // vérification Code postal
    if (empty($salle) || is_nan($salle)) {
        $errorMessage .= '<p>- le champ "salle" est obligatoire et doit etre un nombre';
        $validation = false;
    }
    // vérification dateF
    if (empty($dateF) ) {
        $errorMessage .= '<p>- le champ "date de fin" est obligatoire ';
        $validation = false;
    }
     // vérification dateD
    if (empty($dateD) ) {
        $errorMessage .= '<p>- le champ "date de début" est obligatoire ';
        $validation = false;
    }
    // vérification prix
    if (empty($prix) || is_nan($prix) ) {
        $errorMessage .= '<p>- le champ "dateF" est obligatoire ';
        $validation = false;
    }
    // vérification de l'image
    $authorizedFormats = [
        'image/png',
        'image/jpg',
        'image/jpeg',
        'image/jp2',
        'image/webp'
    ];
    // if (empty($_FILES['image']['name'])|| !in_array($_FILES['image']['dateD'], $authorizedFormats)) {
    //     $errorMessage .= '<p>- l\'image est obligatoire, ne doit pas dépasser 2 Mo et doit être au format PNG, JPG, JPEG, JP2 ou WEBP.</p>';
    //     $validation = false;
    // }
   
    // vérification du description
    if (empty($descri) || strlen($descri) > 65535) {
        $errorMessage .= '<p>- le champ "description" est obligatoire et doit comporter moins de 65535 caractères.</p>';
        $validation = false;
    }

    if ($validation === true) {
        $timestamp = time(); // récupère le nombre de secondes écoulées depuis le 1er janvier 1970
        $format = strchr($_FILES['image']['name'], '.'); // récupère tout ce qui se trouve après le point (png, jpg, ...)
        $imgName = $timestamp . $format; // crée le nouveau nom d'image
        $req = $db->prepare('INSERT INTO circus (name, alt, ville, salle, dateF, prix, image, dateD, descri) VALUES (:name, :alt, :ville, :salle, :dateF, :prix, :image, :dateD, :descri)');
        $req->bindParam(':name',$name, PDO::PARAM_STR);
        $req->bindParam(':alt',$alt, PDO::PARAM_STR);
        $req->bindParam(':ville',$ville, PDO::PARAM_STR);
        $req->bindParam(':salle',$salle, PDO::PARAM_STR);
        $req->bindParam(':dateF',$dateF, PDO::PARAM_STR);
        $req->bindParam(':prix',$prix, PDO::PARAM_STR);
        $req->bindParam(':image',$imgName, PDO::PARAM_STR);
        $req->bindParam(':dateD',$dateD, PDO::PARAM_STR);
        $req->bindParam(':descri',$descri, PDO::PARAM_STR);
        $req->execute();
        move_uploaded_file($_FILES['image']['tmp_name'], '../assets/img/posts/' . $imgName); // upload du fichier
    }else {
        $_SESSION['notification'] = $errorMessage;
        header('Location: form.php');
    }




} elseif (isset($_GET['delete']) && !empty($_GET['delete'])) {
    $id = (int)$_GET['delete'];
    $req = $db->query('SELECT image FROM circus WHERE id=' . $id); // récupère le nom de l'image
    $oldImg = $req->fetch();
    if (file_exists('../assets/img/posts/' . $oldImg['image'])) { // vérifie que le fichier existe
        unlink('../assets/img/posts/' . $oldImg['image']); // supprime l'image du dossier local
    }
    $reqDelete = $db->query('DELETE FROM circus WHERE id=' . $id); // supprime les données en bdd
}

header('Location: index.php'); // redirection

?>