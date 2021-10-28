<?php

session_start();

require_once('../config/database.php');

if ($_SERVER['HTTP_REFERER'] == 'http://localhost/dossier-TP/Spectacle/admin/form.php') { // vérifie qu'on vient bien du formulaire

    // nettoyage des données
    $titre = htmlspecialchars($_POST['titre']);
    $descri = htmlspecialchars($_POST['descri']);
    $alt = htmlspecialchars($_POST['alt']);
    $prix = htmlspecialchars($_POST['prix']);
    $dateD = htmlspecialchars($_POST['dateD']);
    $dateF = htmlspecialchars($_POST['dateF']);
    $name = htmlspecialchars($_POST['name']);
    $ville = htmlspecialchars($_POST['ville']);
    $salle = htmlspecialchars($_POST['salle']);

    $errorMessage = '<p>Merci de vérifier les points suivants :</p>';
    $validation = true;

    // vérification du titre
    if (empty($titre) || strlen($titre) > 100) {
        $errorMessage .= '<p>- le champ "titre" est obligatoire et doit comporter moins de 100 caractères.</p>';
        $validation = false;
    }

    // vérification de la description
    if (empty($descri) || strlen($descri) > 65535) {
        $errorMessage .= '<p>- le champ "description" est obligatoire et doit comporter moins de 65535 caractères.</p>';
        $validation = false;
    }

    // vérification du champ alt
    if (empty($alt) || strlen($alt) > 100) {
        $errorMessage .= '<p>- le champ "alt" est obligatoire et doit comporter moins de 100 caractères.</p>';
        $validation = false;
    }

    // vérification du champ prix
    if (empty($prix) || strlen($prix) > 6) {
        $errorMessage .= '<p>- le champ "prix" est obligatoire et doit comporter moins de 45 caractères.</p>';
        $validation = false;
    }

    // vérification du champ dateD
    if (empty($published) || ($published != 'true' && $published != 'false')) {
        $errorMessage .= '<p>- le champ "publier" est obligatoire et doit être soit "oui", soit "non".</p>';
        $validation = false;
    }

      // vérification du champ dateF
      if (empty($published) || ($published != 'true' && $published != 'false')) {
        $errorMessage .= '<p>- le champ "publier" est obligatoire et doit être soit "oui", soit "non".</p>';
        $validation = false;
    }

      // vérification du champ name
      if (empty($name) || strlen($name) > 50) {
        $errorMessage .= '<p>- le champ "name" est obligatoire et doit comporter moins de 100 caractères.</p>';
        $validation = false;
    }

    // vérification du champ ville
    if (empty($ville) || strlen($ville) > 50) {
        $errorMessage .= '<p>- le champ "ville" est obligatoire et doit comporter moins de 100 caractères.</p>';
        $validation = false;
    }

    // vérification du champ salle
    if (empty($salle) || strlen($salle) > 50) {
        $errorMessage .= '<p>- le champ "salle" est obligatoire et doit comporter moins de 100 caractères.</p>';
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
    if (empty($_FILES['img']['name']) || $_FILES['img']['size'] > 2000000 || !in_array($_FILES['img']['type'], $authorizedFormats)) {
        $errorMessage .= '<p>- l\'image est obligatoire, ne doit pas dépasser 2 Mo et doit être au format PNG, JPG, JPEG, JP2 ou WEBP.</p>';
        $validation = false;
    }
    
    if ($validation === true) {
        $timestamp = time(); // récupère le nombre de secondes écoulées depuis le 1er janvier 1970
        $format = strchr($_FILES['img']['name'], '.'); // récupère tout ce qui se trouve après le point (png, jpg, ...)
        $imgName = $timestamp . $format; // crée le nouveau nom d'image
        $req = $db->prepare('INSERT INTO post (titre, descri, img, alt, author, created_at, published) VALUES (:title, :content, :img, :alt, :author, NOW(), :published)'); // prépare la requête
        $req->bindParam(':title', $title, PDO::PARAM_STR); // associe la valeur $title à :title
        $req->bindParam(':content', $content, PDO::PARAM_STR); // associe la valeur $content à :content
        $req->bindParam(':img', $imgName, PDO::PARAM_STR); // associe la valeur $imgName à :img
        $req->bindParam(':alt', $alt, PDO::PARAM_STR); // associe la valeur $alt à :alt
        $req->bindParam(':author', $author, PDO::PARAM_STR); // associe la valeur $author à :author
        $req->bindParam(':published', $published, PDO::PARAM_BOOL); // associe la valeur $published à :published
        $req->execute(); // exécute la requête
        move_uploaded_file($_FILES['img']['tmp_name'], '../assets/img/posts/' . $imgName); // upload du fichier
        $_SESSION['notification'] = 'L\'article a bien été ajouté';
        header('Location: index.php'); // redirection
    } else {
        $_SESSION['notification'] = $errorMessage;
        $_SESSION['form'] = [
            'title' => $title,
            'content' => $content,
            'alt' => $alt,
            'author' => $author
        ];
        header('Location: form.php'); // redirection
    }

} elseif (isset($_GET['delete']) && !empty($_GET['delete'])) {
    $id = (int)$_GET['delete'];
    $req = $db->query('SELECT img FROM showtime WHERE id=' . $id); // récupère le nom de l'image
    $oldImg = $req->fetch();
    if (file_exists('../assets/img/posts/' . $oldImg['img'])) { // vérifie que le fichier existe
        unlink('../assets/img/posts/' . $oldImg['img']); // supprime l'image du dossier local
    }
    $reqDelete = $db->query('DELETE FROM post WHERE id=' . $id); // supprime les données en bdd
    $_SESSION['notification'] = 'L\'article a bien été supprimé';
    header('Location: index.php'); // redirection
}

?>