<?php include 'layouts/header.php'; ?>

<div class="jumbotron text-center">
    <h1 class="display-4">Bienvenue à la Clinique Médicale</h1>
    <p class="lead">Prenez rendez-vous en ligne avec nos spécialistes</p>
    <hr class="my-4">
    <?php if (!isset($_SESSION['patient_id'])): ?>
    <p>Connectez-vous pour gérer vos rendez-vous</p>
    <a class="btn btn-primary btn-lg" href="views/auth/login.php" role="button">Se connecter</a>
    <a class="btn btn-secondary btn-lg" href="views/auth/register.php" role="button">S'inscrire</a>
    <?php else: ?>
    <p>Bienvenue <?= htmlspecialchars($_SESSION['patient_nom']) ?>!</p>
    <a class="btn btn-primary btn-lg" href="views/patient/dashboard.php" role="button">Tableau de bord</a>
    <?php endif; ?>
</div>

<?php include 'layouts/footer.php'; ?>