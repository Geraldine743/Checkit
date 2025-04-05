<?php require_once __DIR__."/templates/header.php" ?>

<div class="container col-xxl-8 px-4 py-5">
    <h1>Se connecter</h1>
    <form action="" method="post">
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" name="email" id="email" class="form-control">
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Mot de passe</label>
            <input type="password" name="password" id="password" class="form-control">
        </div>
        <input type="submit" name="loginUser" value="connexion" class="btn btn-primary">
    </form>
</div>

<?php require_once __DIR__."/templates/footer.php" ?>