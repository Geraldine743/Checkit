<?php 
    require_once __DIR__ . "/templates/header.php"; 
    require_once __DIR__ . "/lib/pdo.php";
    require_once __DIR__ . "/lib/list.php";

    if (isUserConnected()){ 
        $lists = getListsByUserId($pdo, $_SESSION['user']['id']);
    }
?>

<div class="container">
    <div class="d-flex align-items-center justify-content-between">
        <h1>Mes listes</h1>
        <a href="ajout-modification-liste.php" class="btn btn-primary">Ajouter une liste</a>
    </div>
    <div class="row">
    <?php if (isUserConnected()){ 
        if ($lists) {
            foreach ($lists as $list) { ?>
                <div class="col-md-4 my-2">
                    <div class="card w-100">
                        <div class="card-header d-flex align-items-center justify-content-evenly">
                            <i class="bi bi-card-checklist"></i>
                            <h3 class="card-title"><?= $list['title']?></h3>
                        </div>
                        <div class="card-body d-flex align-items-end justify-content-between">
                            <a href="#" class="btn btn-primary">Voir la liste</a>
                            <div>
                                <span class="badge rounded-pill text-bg-primary">
                                    <i class="bi <?= $list['category_icon']?>"></i>
                                    <?= $list['category_name']?>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
        <?php } ?>

        <?php } else { ?>
            <p>Aucune liste</p>
        <?php } ?>
    <?php } else { ?>
        <p>Pour consulter vos listes, vous devez être connecté</p>
    <?php } ?>
    </div>
</div>


<?php require_once __DIR__."/templates/footer.php" ?>