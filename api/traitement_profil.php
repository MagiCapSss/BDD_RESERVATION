<?php
session_start();
require 'bdd.php';

if (!isset($_SESSION['user_id'])) {
    $_SESSION['error'] = "Vous devez être connecté pour modifier votre profil.";
    header("Location: connexion.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_id = $_SESSION['user_id'];

    $nom = htmlspecialchars($_POST['nom']);
    $prenom = htmlspecialchars($_POST['prenom']);
    $date_naissance = $_POST['date_naissance'];
    $telephone = htmlspecialchars($_POST['telephone']);
    $email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);

    if (empty($nom) || empty($prenom) || empty($date_naissance) || empty($telephone) || !$email) {
        $_SESSION['error'] = "Tous les champs doivent être remplis correctement.";
        echo "<script>alert('Tous les champs doivent être remplis correctement.'); window.location.href='profil.php';</script>";
        exit();
    }

    if (!preg_match("/^\\+?[0-9]{10,15}$/", $telephone)) {
        $_SESSION['error'] = "Numéro de téléphone invalide.";
        echo "<script>alert('Numéro de téléphone invalide.'); window.location.href='profil.php';</script>";
        exit();
    }

    if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== ($_SESSION['csrf_token'] ?? '')) {
        $_SESSION['error'] = "Erreur de validation. Veuillez réessayer.";
        echo "<script>alert('Erreur de validation CSRF.'); window.location.href='profil.php';</script>";
        exit();
    }

    try {
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "UPDATE users SET nom = ?, prenom = ?, date_naissance = ?, telephone = ?, email = ? WHERE id = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$nom, $prenom, $date_naissance, $telephone, $email, $user_id]);

        if ($stmt->rowCount() > 0) {
            $_SESSION['success'] = "Profil mis à jour avec succès !";
            echo "<script>alert('Profil mis à jour avec succès !'); window.location.href='profil.php';</script>";
        } else {
            $_SESSION['error'] = "Aucune modification détectée.";
            echo "<script>alert('Aucune modification détectée.'); window.location.href='profil.php';</script>";
        }

        $_SESSION['user_nom'] = $nom;
        $_SESSION['user_prenom'] = $prenom;

        exit();
    } catch (PDOException $e) {
        $_SESSION['error'] = "Erreur SQL : " . $e->getMessage();
        echo "<script>alert('Erreur SQL : " . $e->getMessage() . "'); window.location.href='profil.php';</script>";
        exit();
    }
} else {
    header("Location: profil.php");
    exit();
}
?>