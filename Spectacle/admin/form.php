<?php
    session_start();
    if (isset($_SESSION['notification'])) {
        echo $_SESSION['notification'];
    }
    session_destroy();
?>

<!DOCTYPE html>

<html lang="fr">

    <head>

        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>BLOG • admin - form</title>

    </head>

    <body>
        
        <form action="treatment.php" method="post" enctype="multipart/form-data">

            <label for="title">Titre</label>
            <input type="text" name="title" maxlength="100" value="<?= isset($_SESSION['form']['title']) ? $_SESSION['form']['title'] : null ?>" required>

            <label for="content">Contenu</label>
            <textarea name="content" cols="30" rows="10" maxlength="65535" required><?= isset($_SESSION['form']['content']) ? $_SESSION['form']['content'] : null ?></textarea>

            <label for="img">Image principale</label>
            <input type="file" name="img" accept="image/png, image/jpg, image/jpeg, image/jp2, image/webp" required>

            <label for="alt">Texte alternatif</label>
            <input type="text" name="alt" maxlength="100" value="<?= isset($_SESSION['form']['alt']) ? $_SESSION['form']['alt'] : null ?>" required>

            <label for="author">Auteur</label>
            <input type="text" name="author" maxlength="45" value="<?= isset($_SESSION['form']['author']) ? $_SESSION['form']['author'] : null ?>" required>

            <label for="published">Publier ?</label>
            <select name="published" required>
                <option value="">-- choisir --</option>
                <option value="true">oui</option>
                <option value="false">non</option>
            </select>

            <input type="submit" value="Créer">

        </form>

    </body>

</html>