<?php
require_once '../config/database.php';
require_once '../models/Patient.php';

session_start();

if (isset($_POST['action'])) {
    switch ($_POST['action']) {
        case 'register':
            $success = registerPatient(
                $pdo,
                $_POST['nom'],
                $_POST['prenom'],
                $_POST['email'],
                $_POST['password'],
                $_POST['telephone']
            );
            
            if ($success) {
                $_SESSION['message'] = "Inscription réussie! Connectez-vous maintenant.";
                header("Location: ../views/auth/login.php");
            } else {
                $_SESSION['error'] = "Erreur lors de l'inscription.";
                header("Location: ../views/auth/register.php");
            }
            exit();
            
        case 'login':
            $patient = loginPatient($pdo, $_POST['email'], $_POST['password']);
            
            if ($patient) {
                $_SESSION['patient_id'] = $patient['id'];
                $_SESSION['patient_nom'] = $patient['nom'];
                header("Location: ../views/patient/dashboard.php");
            } else {
                $_SESSION['error'] = "Email ou mot de passe incorrect.";
                header("Location: ../views/auth/login.php");
            }
            exit();
    }
}

if (isset($_GET['action']) && $_GET['action'] == 'logout') {
    session_destroy();
    header("Location: ../index.php");
    exit();
}
?>