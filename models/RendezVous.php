<?php
function getSpecialites($pdo) {
    $sql = "SELECT * FROM specialites";
    $stmt = $pdo->query($sql);
    return $stmt->fetchAll();
}

function demanderRV($pdo, $patient_id, $specialite_id, $date, $heure) {
    $sql = "INSERT INTO rendez_vous (patient_id, specialite_id, date_rv, heure_rv, statut) 
            VALUES (:patient_id, :specialite_id, :date_rv, :heure_rv, 'en_attente')";
    
    $stmt = $pdo->prepare($sql);
    return $stmt->execute([
        ':patient_id' => $patient_id,
        ':specialite_id' => $specialite_id,
        ':date_rv' => $date,
        ':heure_rv' => $heure
    ]);
}

function getRVByPatient($pdo, $patient_id) {
    $sql = "SELECT rv.*, s.nom as specialite 
            FROM rendez_vous rv
            JOIN specialites s ON rv.specialite_id = s.id
            WHERE rv.patient_id = :patient_id
            ORDER BY rv.date_rv DESC, rv.heure_rv DESC";
    
    $stmt = $pdo->prepare($sql);
    $stmt->execute([':patient_id' => $patient_id]);
    return $stmt->fetchAll();
}

function demanderAnnulationRV($pdo, $rv_id, $patient_id) {
    // Vérifier si le RV est au moins 48h avant
    $sql = "SELECT date_rv, heure_rv FROM rendez_vous 
            WHERE id = :rv_id AND patient_id = :patient_id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([':rv_id' => $rv_id, ':patient_id' => $patient_id]);
    $rv = $stmt->fetch();
    
    if (!$rv) return false;
    
    $rv_datetime = strtotime($rv['date_rv'] . ' ' . $rv['heure_rv']);
    $now = time();
    $diff_heures = ($rv_datetime - $now) / 3600;
    
    if ($diff_heures < 48) {
        return false;
    }
    
    // Mettre à jour le statut
    $sql = "UPDATE rendez_vous SET statut = 'demande_annulation' 
            WHERE id = :rv_id AND patient_id = :patient_id";
    $stmt = $pdo->prepare($sql);
    return $stmt->execute([':rv_id' => $rv_id, ':patient_id' => $patient_id]);
}
?>