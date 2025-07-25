<?php include '../../layouts/header.php'; ?>

<div class="container">
    <h2>Mes Rendez-vous</h2>

    <?php if (isset($_SESSION['message'])): ?>
    <div class="alert alert-success"><?= $_SESSION['message'] ?></div>
    <?php unset($_SESSION['message']); ?>
    <?php endif; ?>

    <?php if (isset($_SESSION['error'])): ?>
    <div class="alert alert-danger"><?= $_SESSION['error'] ?></div>
    <?php unset($_SESSION['error']); ?>
    <?php endif; ?>

    <a href="prendre_rv.php" class="btn btn-primary mb-3">Prendre un RV</a>

    <table class="table">
        <thead>
            <tr>
                <th>Spécialité</th>
                <th>Date</th>
                <th>Heure</th>
                <th>Statut</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($rendez_vous as $rv): ?>
            <tr>
                <td><?= htmlspecialchars($rv['specialite']) ?></td>
                <td><?= date('d/m/Y', strtotime($rv['date_rv'])) ?></td>
                <td><?= substr($rv['heure_rv'], 0, 5) ?></td>
                <td>
                    <?php 
                    $statut = [
                        'en_attente' => '<span class="badge bg-warning">En attente</span>',
                        'confirme' => '<span class="badge bg-success">Confirmé</span>',
                        'annule' => '<span class="badge bg-danger">Annulé</span>',
                        'demande_annulation' => '<span class="badge bg-info">Demande annulation</span>'
                    ];
                    echo $statut[$rv['statut']] ?? $rv['statut'];
                    ?>
                </td>
                <td>
                    <?php if ($rv['statut'] == 'en_attente' || $rv['statut'] == 'confirme'): ?>
                    <form action="../controllers/patient.php" method="post" style="display: inline;">
                        <input type="hidden" name="action" value="annuler_rv">
                        <input type="hidden" name="rv_id" value="<?= $rv['id'] ?>">
                        <button type="submit" class="btn btn-sm btn-danger"
                            onclick="return confirm('Annuler ce rendez-vous?')">
                            Annuler
                        </button>
                    </form>
                    <?php endif; ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?php include '../../layouts/footer.php'; ?>