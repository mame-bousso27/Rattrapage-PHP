<?php include '../layouts/header.php'; ?>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h3 class="text-center">Inscription Patient</h3>
                </div>
                <div class="card-body">
                    <!-- Affichage des messages d'erreur -->
                    <?php if (isset($_SESSION['error'])): ?>
                    <div class="alert alert-danger"><?= htmlspecialchars($_SESSION['error']) ?></div>
                    <?php unset($_SESSION['error']); ?>
                    <?php endif; ?>

                    <!-- Formulaire d'inscription -->
                    <form action="../controllers/auth.php" method="post">
                        <input type="hidden" name="action" value="register">

                        <div class="mb-3">
                            <label for="nom" class="form-label">Nom :</label>
                            <input type="text" class="form-control" id="nom" name="nom" required placeholder="Votre nom"
                                minlength="2">
                        </div>

                        <div class="mb-3">
                            <label for="prenom" class="form-label">Prénom :</label>
                            <input type="text" class="form-control" id="prenom" name="prenom" required
                                placeholder="Votre prénom" minlength="2">
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">Email :</label>
                            <input type="email" class="form-control" id="email" name="email" required
                                placeholder="exemple@email.com">
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label">Mot de passe :</label>
                            <input type="password" class="form-control" id="password" name="password" required
                                placeholder="••••••••" minlength="6">
                            <small class="text-muted">Minimum 6 caractères</small>
                        </div>

                        <div class="mb-3">
                            <label for="telephone" class="form-label">Téléphone :</label>
                            <input type="tel" class="form-control" id="telephone" name="telephone"
                                placeholder="06 12 34 56 78" pattern="[0-9]{10}">
                            <small class="text-muted">Format : 0612345678</small>
                        </div>

                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary">S'inscrire</button>
                        </div>
                    </form>

                    <div class="mt-3 text-center">
                        <p>Déjà inscrit ? <a href="login.php">Connectez-vous ici</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include '../layouts/footer.php'; ?>