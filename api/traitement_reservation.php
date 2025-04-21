<?php
session_start();
require 'bdd.php';

if (!isset($_SESSION['user_id'])) {
    $_SESSION['error'] = "Vous devez être connecté pour faire une réservation.";
    echo "<script>alert('Vous devez être connecté pour faire une réservation.'); window.location.href='connexion.php';</script>";
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_id = $_SESSION['user_id'];
    $date = htmlspecialchars($_POST['date']);
    $heure = htmlspecialchars($_POST['heure']);

    $sql = "SELECT id FROM slots WHERE heure_debut = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$heure]);
    $slot = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$slot) {
        $_SESSION['error'] = "Créneau horaire invalide.";
        echo "<script>alert('Créneau horaire invalide.'); window.location.href='reservation.php';</script>";
        exit();
    }

    $sql = "SELECT id FROM reservations WHERE user_id = ? AND date = ? AND slot_id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$user_id, $date, $slot['id']]);
    $existingReservation = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($existingReservation) {
        $_SESSION['error'] = "Vous avez déjà réservé ce créneau pour cette date.";
        echo "<script>alert('Vous avez déjà réservé ce créneau pour cette date.'); window.location.href='reservation.php';</script>";
        exit();
    }

    $sql = "INSERT INTO reservations (user_id, slot_id, date) VALUES (?, ?, ?)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$user_id, $slot['id'], $date]);

    $_SESSION['success'] = "Réservation effectuée avec succès !";
    echo "<script>alert('Réservation effectuée avec succès !'); window.location.href='reservation.php';</script>";
    exit();
} else {
    header("Location: reservation.php");
    exit();
}