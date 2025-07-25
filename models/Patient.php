<?php
function registerPatient($pdo, $nom, $prenom, $email, $password, $telephone) {
    $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
    
    $sql = "INSERT INTO patients (nom, prenom, email, password, telephone) 
            VALUES (:nom, :prenom, :email, :password, :telephone)";
    
    $stmt = $pdo->prepare($sql);
    return $stmt->execute([
        ':nom' => $nom,
        ':prenom' => $prenom,
        ':email' => $email,
        ':password' => $hashedPassword,
        ':telephone' => $telephone
    ]);
}

function loginPatient($pdo, $email, $password) {
    $sql = "SELECT * FROM patients WHERE email = :email";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([':email' => $email]);
    $patient = $stmt->fetch();
    
    if ($patient && password_verify($password, $patient['password'])) {
        return $patient;
    }
    return false;
}

function getPatientById($pdo, $id) {
    $sql = "SELECT id, nom, prenom, email, telephone FROM patients WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([':id' => $id]);
    return $stmt->fetch();
}
?>