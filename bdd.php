<?php
$host = 'sql201.infinityfree.com';
$dbname = 'if0_38808827_reservation_db';
$username = 'if0_38808827';
$password = '9piM0A86CHE';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erreur de connexion : " . $e->getMessage());
}
?>