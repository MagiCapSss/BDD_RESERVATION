<?php
session_start();

require 'bdd.php';

ini_set('display_errors', 1);
error_reporting(E_ALL);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
        $_SESSION['error'] = "Échec de la vérification CSRF.";
        echo "<script>alert('Échec de la vérification CSRF.'); window.location.href='inscritption.php';</script>";
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
        echo "<script>alert('Les mots de passe ne correspondent pas.'); window.location.href='inscritption.php';</script>";
        exit();
    }

    if (!preg_match("/^\\+?[0-9]{10,15}$/", $telephone)) {
        $_SESSION['error'] = "Numéro de téléphone invalide.";
        echo "<script>alert('Numéro de téléphone incorrect !'); window.location.href='inscritption.php';</script>";
        exit();
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['error'] = "Adresse email invalide.";
        echo "<script>alert('Adresse email invalide !'); window.location.href='inscritption.php';</script>";
        exit();
    }

    $sql = "SELECT id FROM users WHERE email = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$email]);

    if ($stmt->fetch()) {
        $_SESSION['error'] = "Cet email est déjà utilisé.";
        echo "<script>alert('Cet email est déjà utilisé.'); window.location.href='inscritption.php';</script>";
        exit();
    }

    $password_hash = password_hash($password, PASSWORD_DEFAULT);

    $sql = "INSERT INTO users (nom, prenom, date_naissance, telephone, email, mot_de_passe) 
            VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $pdo->prepare($sql);
    $success = $stmt->execute([$nom, $prenom, $date_naissance, $telephone, $email, $password_hash]);

    if ($success) {
        $_SESSION['success'] = "Inscription réussie ! Vous pouvez maintenant vous connecter.";
        echo "<script>alert('Inscription réussie !'); window.location.href='connexion.php';</script>";
        exit();
    } else {
        $_SESSION['error'] = "Une erreur est survenue. Veuillez réessayer.";
        echo "<script>alert('Une erreur est survenue. Veuillez réessayer.'); window.location.href='inscritption.php';</script>";
        exit();
    }
} else {
    header("Location: inscritption.php");
    exit();
}
?>