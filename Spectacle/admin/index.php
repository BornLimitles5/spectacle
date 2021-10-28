<?php
    session_start();
    if (isset($_SESSION['notification'])) {
        echo $_SESSION['notification'];
    }
    session_destroy();
    require_once('../config/database.php');
    $req = $db->query('SELECT id, image, descri, alt, prix, dateD, dateF, name, ville, salle FROM showtime ORDER BY id ASC');
    $posts = $req->fetchAll();
    $req = $db->query('SELECT id, image, descri, alt, prix, dateD, dateF, name, ville, salle FROM circus ORDER BY id ASC');
    $circus = $req->fetchAll();
    $req = $db->query('SELECT id, image, descri, alt, prix, dateD, dateF, name, ville, salle FROM concerto ORDER BY id ASC');
    $concerto = $req->fetchAll();
?>

<!DOCTYPE html>

<html lang="fr">

    <head>

        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>BLOG • espace administrateur</title>

        <link rel="stylesheet" href="../assets/css/fontawesome.css">

    </head>

    <body>

        <h1>Espace administrateur </h1>

        <table>
            <thead>
                <h2>Table Showtime</h2>
                <tr>
                    <th>ID</th>
                    <th>image</th>
                    <th>description</th>
                    <th>alt</th>
                    <th>prix</th>
                    <th>dateD</th>
                    <th>dateF</th>
                    <th>name</th>
                    <th>ville</th>
                    <th>salle</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    foreach ($posts as $showtime) { ?>
                        <tr>
                            <td><?= $showtime['id'] ?></td>
                            <td><?= $showtime['image'] ?></td>
                            <td><?= $showtime['descri'] ?></td>
                            <td><?= $showtime['alt'] ?></td>
                            <td><?= $showtime['prix'] ?></td>
                            <td><?= $showtime['dateD'] ?></td>
                            <td><?= $showtime['dateF'] ?></td>
                            <td><?= $showtime['name'] ?></td>
                            <td><?= $showtime['ville'] ?></td>
                            <td><?= $showtime['salle'] ?></td>
                            <td>
                                <a href="#"><i class="fas fa-pen-square"></i></a>
                                <a href="treatment.php?delete=<?= $showtime['id'] ?>"><i class="fas fa-trash"></i></a>
                            </td>
                        </tr>    
                    <?php }
                ?>
            </tbody>
        </table>

        <a href="form.php">Ajouter un article</a>
         <table>
            <thead>
                <h2>Table Circus</h2>
                <tr>
                    <th>ID</th>
                    <th>image</th>
                    <th>description</th>
                    <th>alt</th>
                    <th>prix</th>
                    <th>dateD</th>
                    <th>dateF</th>
                    <th>name</th>
                    <th>ville</th>
                    <th>salle</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    foreach ($circus as $cirque) { ?>
                        <tr>
                            <td><?= $cirque['id'] ?></td>
                            <td><?= $cirque['image'] ?></td>
                            <td><?= $cirque['descri'] ?></td>
                            <td><?= $cirque['alt'] ?></td>
                            <td><?= $cirque['prix'] ?></td>
                            <td><?= $cirque['dateD'] ?></td>
                            <td><?= $cirque['dateF'] ?></td>
                            <td><?= $cirque['name'] ?></td>
                            <td><?= $cirque['ville'] ?></td>
                            <td><?= $cirque['salle'] ?></td>
                            <td>
                                <a href="#"><i class="fas fa-pen-square"></i></a>
                                <a href="treatment2.php?delete=<?= $cirque['id'] ?>"><i class="fas fa-trash"></i></a>
                            </td>
                        </tr>    
                    <?php }
                ?>
            </tbody>
        </table>

        <a href="form2.php">Ajouter un article</a>
         <table>
            <thead>
                <h2>Table Concerto</h2>
                <tr>
                    <th>ID</th>
                    <th>image</th>
                    <th>description</th>
                    <th>alt</th>
                    <th>prix</th>
                    <th>dateD</th>
                    <th>dateF</th>
                    <th>name</th>
                    <th>ville</th>
                    <th>salle</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    foreach ($concerto as $concert) { ?>
                        <tr>
                            <td><?= $concert['id'] ?></td>
                            <td><?= $concert['image'] ?></td>
                            <td><?= $concert['descri'] ?></td>
                            <td><?= $concert['alt'] ?></td>
                            <td><?= $concert['prix'] ?></td>
                            <td><?= $concert['dateD'] ?></td>
                            <td><?= $concert['dateF'] ?></td>
                            <td><?= $concert['name'] ?></td>
                            <td><?= $concert['ville'] ?></td>
                            <td><?= $concert['salle'] ?></td>
                            <td>
                                <a href="#"><i class="fas fa-pen-square"></i></a>
                                <a href="treatment3.php?delete=<?= $concert['id'] ?>"><i class="fas fa-trash"></i></a>
                            </td>
                        </tr>    
                    <?php }
                ?>
            </tbody>
        </table>

        <a href="form3.php">Ajouter un article</a>
        
    </body>

</html>