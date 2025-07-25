<?php include '../../layouts/header.php'; ?>

<div class="container">
    <h2>Prendre un Rendez-vous</h2>

    <?php if (isset($_SESSION['error'])): ?>
    <div class="alert alert-danger"><?= $_SESSION['error'] ?></div>
    <?php unset($_SESSION['error']); ?>
    <?php endif; ?>

    <form action="../controllers/patient.php" method="post">
        <input type="hidden" name="action" value="prendre_rv">

        <div class="mb-3">
            <label for="specialite_id" class="form-label">Spécialité:</label>
            <select class="form-select" id="specialite_id" name="specialite_id" required>
                <option value="">Choisir une spécialité</option>
                <?php foreach ($specialites as $specialite): ?>
                <option value="<?= $specialite['id'] ?>"><?= htmlspecialchars($specialite['nom']) ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="mb-3">
            <label for="date_rv" class="form-label">Date:</label>
            <input type="date" class="form-control" id="date_rv" name="date_rv" required min="<?= date('Y-m-d') ?>">
        </div>

        <div class="mb-3">
            <label for="heure_rv" class="form-label">Heure:</label>
            <input type="time" class="form-control" id="heure_rv" name="heure_rv" required min="08:00" max="18:00"
                step="1800">
            <small class="text-muted">Les rendez-vous sont disponibles de 8h à 18h par créneaux de 30min</small>
        </div>

        <button type="submit" class="btn btn-primary">Demander le rendez-vous</button>
    </form>
</div>

<?php include '../../layouts/footer.php'; ?>