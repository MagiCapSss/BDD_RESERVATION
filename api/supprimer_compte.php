<?php
session_start();
require 'bdd.php';

if (!isset($_SESSION['user_id'])) {
    $_SESSION['error'] = "Vous devez être connecté pour accéder à cette fonctionnalité.";
    header("Location: connexion.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== ($_SESSION['csrf_token'] ?? '')) {
        $_SESSION['error'] = "Erreur de validation CSRF. Veuillez réessayer.";
        echo "<script>alert('Erreur de validation CSRF.'); window.location.href='profil.php';</script>";
        exit();
    }

    $user_id = $_SESSION['user_id'];

    try {
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "DELETE FROM users WHERE id = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$user_id]);

        if ($stmt->rowCount() > 0) {
            session_destroy();
            echo "<script>alert('Compte supprimé avec succès.'); window.location.href='connexion.php';</script>";
        } else {
            $_SESSION['error'] = "Erreur lors de la suppression du compte.";
            echo "<script>alert('Erreur lors de la suppression du compte.'); window.location.href='profil.php';</script>";
        }

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