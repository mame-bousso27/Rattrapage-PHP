<?php
require_once '../config/database.php';
require_once '../models/Patient.php';
require_once '../models/RendezVous.php';

session_start();

// Vérifier si le patient est connecté
if (!isset($_SESSION['patient_id'])) {
    header("Location: ../views/auth/login.php");
    exit();
}

$patient_id = $_SESSION['patient_id'];

if (isset($_POST['action'])) {
    switch ($_POST['action']) {
        case 'prendre_rv':
            $success = demanderRV(
                $pdo,
                $patient_id,
                $_POST['specialite_id'],
                $_POST['date_rv'],
                $_POST['heure_rv']
            );
            
            if ($success) {
                $_SESSION['message'] = "Rendez-vous demandé avec succès!";
            } else {
                $_SESSION['error'] = "Erreur lors de la demande de rendez-vous.";
            }
            header("Location: mes_rv.php");
            exit();
            
        case 'annuler_rv':
            $success = demanderAnnulationRV(
                $pdo,
                $_POST['rv_id'],
                $patient_id
            );
            
            if ($success) {
                $_SESSION['message'] = "Demande d'annulation envoyée!";
            } else {
                $_SESSION['error'] = "Impossible d'annuler (délai de 48h non respecté).";
            }
            header("Location: mes_rv.php");
            exit();
    }
}

// Récupérer les données pour les vues
$patient = getPatientById($pdo, $patient_id);
$specialites = getSpecialites($pdo);
$rendez_vous = getRVByPatient($pdo, $patient_id);
?>