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
    
        <form action="treatment3.php" method="post" enctype="multipart/form-data">

            <label for="name">Titre</label>
            <input type="text" name="name" maxlength="100"  required>
<br><br>
            <label for="descri">Contenu</label>
            <textarea name="descri" cols="30" rows="10" maxlength="65535" required></textarea>
<br><br>
            <label for="image">Image principale</label>
            <input type="file" name="image" accept="image/png, image/jpg, image/jpeg, image/jp2, image/webp" required>
<br><br>
            <label for="alt">Texte alternatif</label>
            <input type="text" name="alt" maxlength="100"  required>
<br><br>
            <label for="ville">ville</label>
            <input type="text" name="ville" maxlength="45"  required>
<br><br>
            <label for="prix">prix</label>
            <input type="number" name="prix" min="0" max="9000" step="0.01"  required>
<br><br>
             <label for="dateD">Date de début</label>
            <input type="datetime-local" name="dateD" min="2021-27-10-T00:00"  required>
<br><br>
             <label for="dateF">Date de Fin</label>
            <input type="datetime-local" name="dateF" min="2021-27-10-T00:00"   required>
<br><br>
              <label for="salle">salle</label>
            <input type="number" name="salle" min="0" max="9000" required>
<br><br>
            <input type="submit" value="Créer">

        </form>

    </body>

</html>