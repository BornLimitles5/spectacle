<div class="container my-3">

    <h1>Articles</h1>

    <div class="row">
        <div class="col-12">
            <?php
                $req = $db->query('SELECT * FROM post ORDER BY id DESC');
                $posts = $req->fetchAll();
            ?>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>N°</th>
                        <th>Titre</th>
                        <th>Extrait</th>
                        <th>Photo principale</th>
                        <th>Date</th>
                        <th>Auteur</th>
                        <th>Lien</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $i = 1;
                        foreach ($posts as $post) { ?>
                            <tr>
                                <td><?= $i ?></td>
                                <td><?= $post['title'] ?></td>
                                <td><?= substr($post['content'], 0, 200) ?></td>
                                <td><img src="assets/img/posts/<?= $post['img'] ?>" alt="<?= $post['alt'] ?>"></td>
                                <td><?= date('Y-m-d', strtotime($post['created_at'])) ?></td>
                                <td><?= $post['author'] ?></td>
                                <td><a href="index.php?page=post&article=<?= $post['id'] ?>"><i class="fas fa-eye"></i></a></td>
                            </tr>
                        <?php 
                            $i++;   
                        }
                    ?>
                </tbody>
            </table>
        </div>
    </div>

</div>