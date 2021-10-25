<?php
    session_start();
    if (isset($_SESSION['notification'])) {
        echo $_SESSION['notification'];
    }
    session_destroy();
    require_once('../config/database.php');
    $req = $db->query('SELECT id, title, author, created_at FROM post ORDER BY id DESC');
    $posts = $req->fetchAll();
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

        <h1>Espace administrateur</h1>

        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>TITRE</th>
                    <th>AUTEUR</th>
                    <th>CRÉATION</th>
                    <th>ACTIONS</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    foreach ($posts as $post) { ?>
                        <tr>
                            <td><?= $post['id'] ?></td>
                            <td><?= $post['title'] ?></td>
                            <td><?= $post['author'] ?></td>
                            <td><?= $post['created_at'] ?></td>
                            <td>
                                <a href="#"><i class="fas fa-pen-square"></i></a>
                                <a href="treatment.php?delete=<?= $post['id'] ?>"><i class="fas fa-trash"></i></a>
                            </td>
                        </tr>    
                    <?php }
                ?>
            </tbody>
        </table>

        <a href="form.php">Ajouter un article</a>
        
    </body>

</html>