<?php
    $id = (int)$_GET['article'];
    $req = $db->query('SELECT * FROM showtime WHERE id=' . $id);
    $post = $req->fetch();
?>

<div class="container my-3">

    <div class="row">

        <div class="col-12">
            <h1><?= $showtime['title'] ?></h1>
            <p>Rédigé par <?= $post['author'] ?>, le <?= $showtime['created_at'] ?> (mis à jour le ....)</p>
        </div>
        
        <div class="col-sm-12 col-md-8 offset-md-2 col-lg-6 offset-lg-3 my-3">
            <img src="assets/img/posts/<?= $showtime['img'] ?>" alt="<?= $showtime['alt'] ?>" class="w-100">
        </div>

        <div class="col-12">
            <p><?= $showtime['content'] ?></p>
        </div>
        
    </div>

</div>