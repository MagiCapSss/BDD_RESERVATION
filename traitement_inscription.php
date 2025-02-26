<?php
session_start();

require 'bdd.php';

ini_set('display_errors', 1);
error_reporting(E_ALL);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
        $_SESSION['error'] = "Échec de la vérification CSRF.";
        header("Location: inscription.php");
        exit();
    }

    $nom = htmlspecialchars($_POST['nom']);
    $prenom = htmlspecialchars($_POST['prenom']);
    $date_naissance = $_POST['date_naissance'];
    $telephone = htmlspecialchars($_POST['telephone']);
    $email = htmlspecialchars($_POST['email']);
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    if ($password !== $confirm_password) {
        $_SESSION['error'] = "Les mots de passe ne correspondent pas.";
        header("Location: inscritption.php");
        exit();
    }

    $sql = "SELECT id FROM users WHERE email = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$email]);

    if ($stmt->fetch()) {
        $_SESSION['error'] = "Cet email est déjà utilisé.";
        header("Location: inscritption.php");
        exit();
    }

    $password_hash = password_hash($password, PASSWORD_DEFAULT);

    $sql = "INSERT INTO users (nom, prenom, date_naissance, telephone, email, mot_de_passe) 
            VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $pdo->prepare($sql);
    $success = $stmt->execute([$nom, $prenom, $date_naissance, $telephone, $email, $password_hash]);

    if ($success) {
        $_SESSION['success'] = "Inscription réussie ! Vous pouvez maintenant vous connecter.";
        header("Location: connexion.php");
        exit();
    } else {
        $_SESSION['error'] = "Une erreur est survenue. Veuillez réessayer.";
        header("Location: inscritption.php");
        exit();
    }
} else {
    header("Location: inscritption.php");
    exit();
}
?>