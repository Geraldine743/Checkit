<?php 
require_once __DIR__."/templates/header.php";
require_once __DIR__."/lib/pdo.php";
require_once __DIR__."/lib/list.php";
require_once __DIR__."/lib/category.php";

$categories = getCategories($pdo);

if(!isUserConnected()){
    header('location: login.php');
}


$errorsList = [];
$messageList = [];

$list = [
    'title' => '',
    'category_id' => ''
];

// Le formulaire d'ajout/modif de liste a été envoyé
if (isset($_POST['saveList'])) {
    if (!empty($_POST['title'])) {
        $id = null;
        if(isset($_GET['id'])){
            $id = $_GET['id'];
        }
        $res = saveList($pdo, $_POST['title'], (int)$_SESSION['user']['id'], $_POST['category_id'], $id);
        if ($res) {
            if(isset($_GET['id'])){
                $messageList[] = 'La liste a bien été mise à jour.';
            }else {
                header('Location: ajout-modification-liste.php?id=' . $res);
            }
        } else {
            // erreur
            $errorsList[] = "La liste n'a pas été enregistrée";
        }
    } else {
        // erreur
        $errorsList[] = "Le titre est obligatoire";
    }
}

$editMode = false;
if(isset($_GET['id'])){
    $list = getListById($pdo, (int)$_GET['id']);
    $editMode = true;
}

?>

<div class="container col-xxl-8">
    <h1>Liste</h1>


    <?php foreach ($errorsList as $error) { ?>
        <div class="alert alert-danger">
            <?=$error; ?>
        </div>
    <?php } ?>

    <?php foreach ($messageList as $message) { ?>
        <div class="alert alert-success">
            <?=$message; ?>
        </div>
    <?php } ?>

    <div class="accordion" id="accordionExample">
        <div class="accordion-item">
            <h2 class="accordion-header" id="headingOne">
                <button class="accordion-button <?= ($editMode) ? 'collapsed' : '' ?>" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded=<?= ($editMode) ? 'false' : 'true' ?> aria-controls="collapseOne">
                    <?= ($editMode) ? $list['title'] : 'Ajouter une liste' ?>
                </button>
            </h2>
            <div id="collapseOne" class="accordion-collapse collapse <?= (isset($_GET['id'])) ? '' : 'show' ?>" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                <div class="accordion-body">
                    <form action="" method="post">
                        <div class="mb-3">
                            <label for="title" class="form-label">Titre</label>
                            <input type="text" value="<?= $list['title'];?>" name="title" id="title" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label for="category_id" class="form-label">Categorie</label>
                            <select name="category_id" id="category_id" class="form-control">
                                <?php foreach($categories as $category) {?>
                                    <option <?= ($category['id'] === $list['category_id']) ? 'selected="selected"' : '' ?> 
                                    value="<?= $category['id']?>"><?= $category['name']?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <input type="submit" value="Enregistrer" name="saveList" class="btn btn-primary">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


<?php require_once __DIR__."/templates/footer.php"?>