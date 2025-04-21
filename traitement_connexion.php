<?php 
session_start();
require 'bdd.php';

ini_set('display_errors', 1);
error_reporting(E_ALL);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = htmlspecialchars($_POST['email']);
    $password = $_POST['password'];

    if (empty($email) || empty($password)) {
        $_SESSION['error'] = "Veuillez remplir tous les champs.";
        header("Location: connexion.php");
        exit();
    }

    $sql = "SELECT id, nom, prenom, date_naissance, telephone, email, mot_de_passe FROM users WHERE email = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$email]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($password, $user['mot_de_passe'])) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user_nom'] = $user['nom'];
        $_SESSION['user_prenom'] = $user['prenom'];
        $_SESSION['user_date_naissance'] = $user['date_naissance'];
        $_SESSION['user_telephone'] = $user['telephone'];
        $_SESSION['user_email'] = $user['email'];
        $_SESSION['success'] = "Bienvenue, " . $user['prenom'] . "!";

        header("Location: profil.php");
        exit();
    } else {
        $_SESSION['error'] = "Identifiants incorrects.";
        header("Location: connexion.php");
        exit();
    }
} else {
    header("Location: connexion.php");
    exit();
}
?>