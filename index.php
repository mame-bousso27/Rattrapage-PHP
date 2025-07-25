<?php
session_start();

// Router très simple
$page = isset($_GET['page']) ? $_GET['page'] : 'home';

switch ($page) {
    case 'login':
        require 'views/auth/login.php';
        break;
    case 'register':
        require 'views/auth/register.php';
        break;
    case 'patient':
        require 'controllers/patient.php';
        require 'views/patient/dashboard.php';
        break;
    default:
        require 'views/home.php';
        break;
}
?>