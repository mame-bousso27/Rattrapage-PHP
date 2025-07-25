<?php include '../../layouts/header.php'; ?>

<div class="row">
    <div class="col-md-4">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Mon Profil</h5>
                <p class="card-text">
                    <strong>Nom:</strong> <?= htmlspecialchars($patient['nom']) ?><br>
                    <strong>Prénom:</strong> <?= htmlspecialchars($patient['prenom']) ?><br>
                    <strong>Email:</strong> <?= htmlspecialchars($patient['email']) ?><br>
                    <strong>Téléphone:</strong> <?= htmlspecialchars($patient['telephone']) ?>
                </p>
                <a href="#" class="btn btn-warning">Modifier</a>
            </div>
        </div>
    </div>

    <div class="col-md-8">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Mes Prochains Rendez-vous</h5>
                <?php if (count($rendez_vous) > 0): ?>
                <ul class="list-group">
                    <?php foreach ($rendez_vous as $rv): ?>
                    <?php if ($rv['statut'] == 'confirme'): ?>
                    <li class="list-group-item">
                        <?= htmlspecialchars($rv['specialite']) ?> -
                        Le <?= date('d/m/Y', strtotime($rv['date_rv'])) ?> à
                        <?= substr($rv['heure_rv'], 0, 5) ?>
                    </li>
                    <?php endif; ?>
                    <?php endforeach; ?>
                </ul>
                <?php else: ?>
                <p>Aucun rendez-vous à venir.</p>
                <a href="prendre_rv.php" class="btn btn-primary">Prendre un rendez-vous</a>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<?php include '../../layouts/footer.php'; ?>