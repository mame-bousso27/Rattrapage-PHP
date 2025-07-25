<?php include '../layouts/header.php'; ?>

<div class="container">
    <h2>Connexion Patient</h2>

    <?php if (isset($_SESSION['error'])): ?>
    <div class="alert alert-danger"><?= $_SESSION['error'] ?></div>
    <?php unset($_SESSION['error']); ?>
    <?php endif; ?>

    <?php if (isset($_SESSION['message'])): ?>
    <div class="alert alert-success"><?= $_SESSION['message'] ?></div>
    <?php unset($_SESSION['message']); ?>
    <?php endif; ?>

    <form action="../controllers/auth.php" method="post">
        <input type="hidden" name="action" value="login">

        <div class="form-group">
            <label>Email:</label>
            <input type="email" name="email" class="form-control" required>
        </div>

        <div class="form-group">
            <label>Mot de passe:</label>
            <input type="password" name="password" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-primary">Se connecter</button>
    </form>

    <p class="mt-3">Pas encore inscrit? <a href="register.php">Créer un compte</a></p>
</div>

<?php include '../layouts/footer.php'; ?>