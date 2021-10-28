<div class="Flex">

    <h1>Accueil</h1>

    <div class="row">
        <p>Içi Seront Afficher Les Dernières News Pour Chaque Cathégorie 3 de Chaques Concert / Cinéma /Thêatres Afficher Par Ordre Récent Possibilité de devoir Crée 2 Bd Suplémenaire :(</p>
    </div>

    <div id="row">
         <h3>Les Piéce de Theatres Du Jour</h3>
     <div class="Box">
        
         
          <?php 
       
        $req = $db->query('SELECT * FROM showtime ORDER BY id DESC LIMIT 3');
        $posts = $req->fetchAll();
        foreach ($posts as $post) { ?>

         <div class="card" style="width: 18rem;">
              <img src="assets/img/posts/<?= $post['image'] ?>" class="card-img-top " alt="<?= $post['alt'] ?>">
             <div class="card-body">
                  <h5 class="card-title"><?= $post['name'] ?></h5>
                  <h6 class="card-subtitle mb-2 text-muted"><?= $post['ville'] . ' - '.'Salle' .' ' . $post['salle'] .'-'. '<br>'. 'Du'.' ' . $post['dateD'] .'<br>'.'Au'.' '.$post['dateF'].' '  ?></h6>
                  <p class="card-text"><?= substr($post['descri'],0,100). '...' ?></p>
                 <a href="index.php?page=post&articles=<?= $post ['id'] ?>" class="btn btn-secondary">Lire la suite</a>
             </div>
         </div>
         
         <?php }    ?>
     </div>
     </div>
            <h3>Les Cirques Du Jour</h3>
      <div class="Box">
         
          <?php 
       
        $req = $db->query('SELECT * FROM circus ORDER BY id ASC LIMIT 3');
        $posts = $req->fetchALL();
        foreach ($posts as $post) { ?>

         <div class="card" style="width: 18rem;">
              <img src="assets/img/posts/<?= $post['image'] ?>" class="card-img-top " alt="<?= $post['alt'] ?>">
             <div class="card-body">
                  <h5 class="card-title"><?= $post['name'] ?></h5>
                  <h6 class="card-subtitle mb-2 text-muted"><?= $post['ville'] . ' - '.'Salle' .' ' . $post['salle'] .'-'. '<br>'. 'Du'.' ' . $post['dateD'] .'<br>'.'Au'.' '.$post['dateF'].' '  ?></h6>
                  <p class="card-text"><?= substr($post['descri'],0,100). '...' ?></p>
                 <a href="index.php?page=post&article=<?= $post ['id'] ?>" class="btn btn-secondary">Lire la suite</a>
             </div>
         </div>
         
         <?php }    ?>
     </div>
     </div>
     <h3>Les Concert de Theatres</h3>
      <div class="Box">
         
          <?php 
       
        $req = $db->query('SELECT * FROM concerto ORDER BY id ASC LIMIT 3');
        $posts = $req->fetchALL();
        foreach ($posts as $post) { ?>

         <div class="card" style="width: 18rem;">
              <img src="assets/img/posts/<?= $post['image'] ?>" class="card-img-top " alt="<?= $post['alt'] ?>">
             <div class="card-body">
                  <h5 class="card-title"><?= $post['name'] ?></h5>
                  <h6 class="card-subtitle mb-2 text-muted"><?= $post['ville'] . ' - '.'Salle' .' ' . $post['salle'] .'-'. '<br>'. 'Du'.' ' . $post['dateD'] .'<br>'.'Au'.' '.$post['dateF'].' '  ?></h6>
                  <p class="card-text"><?= substr($post['descri'],0,100). '...' ?></p>
                 <a href="index.php?page=post&article=<?= $post ['id'] ?>" class="btn btn-secondary">Lire la suite</a>
             </div>
         </div>
         
         <?php }    ?>
     </div>
     </div>
        </div>