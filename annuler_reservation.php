<?php
session_start();
require 'bdd.php';

if (!isset($_SESSION['user_id'])) {
    $_SESSION['error'] = "Vous devez être connecté pour annuler une réservation.";
    echo "<script>alert('Vous devez être connecté pour annuler une réservation.'); window.location.href='connexion.php';</script>";
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $reservation_id = $_POST['reservation_id'];
    $user_id = $_SESSION['user_id'];

    $sql = "SELECT id FROM reservations WHERE id = ? AND user_id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$reservation_id, $user_id]);
    $reservation = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$reservation) {
        $_SESSION['error'] = "Réservation introuvable ou vous n'êtes pas autorisé à l'annuler.";
        echo "<script>alert('Réservation introuvable ou vous n'êtes pas autorisé à l'annuler.'); window.location.href='reservation.php';</script>";
        exit();
    }

    $sql = "DELETE FROM reservations WHERE id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$reservation_id]);

    $_SESSION['success'] = "Réservation annulée avec succès.";
    echo "<script>alert('Réservation annulée avec succès.'); window.location.href='reservation.php';</script>";
    exit();
} else {
    header("Location: reservation.php");
    exit();
}
