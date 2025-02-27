<?php 
require 'bdd.php';
include 'header.php';

if (!isset($_SESSION['user_id'])) {
    $_SESSION['error'] = "Vous devez être connecté pour voir vos réservations.";
    header("Location: connexion.php");
    exit();
}

$user_id = $_SESSION['user_id'];

$sql = "SELECT r.id, r.date, s.heure_debut, s.heure_fin 
        FROM reservations r
        JOIN slots s ON r.slot_id = s.id
        WHERE r.user_id = ?";
$stmt = $pdo->prepare($sql);
$stmt->execute([$user_id]);
$reservations = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow p-4">
                <h2 class="text-center mb-4">Réserver un créneau</h2>

                <form action="traitement_reservation.php" method="POST">
                    <div class="mb-3">
                        <label for="date" class="form-label">Choisissez une date</label>
                        <input type="date" class="form-control" id="date" name="date" required>
                    </div>
                    <div class="mb-3">
                        <label for="heure" class="form-label">Choisissez un créneau horaire</label>
                        <select class="form-control" id="heure" name="heure" required>
                            <option value="08:00">08:00 - 09:00</option>
                            <option value="09:00">09:00 - 10:00</option>
                            <option value="10:00">10:00 - 11:00</option>
                            <option value="11:00">11:00 - 12:00</option>
                            <option value="14:00">14:00 - 15:00</option>
                            <option value="15:00">15:00 - 16:00</option>
                            <option value="16:00">16:00 - 17:00</option>
                        </select>
                    </div>
                    <input type="hidden" name="csrf_token" value="TOKEN_A_REMPLACER">
                    <button type="submit" class="btn btn-primary w-100">Réserver</button>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="container mt-4">
    <h3 class="text-center">Mes Réservations</h3>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <?php if (empty($reservations)): ?>
                <p class="text-center">Vous n'avez pas de réservations.</p>
            <?php else: ?>
                <ul class="list-group">
                    <?php foreach ($reservations as $reservation): ?>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <?= date('d/m/Y', strtotime($reservation['date'])) ?> 
                            à <?= $reservation['heure_debut'] ?> - <?= $reservation['heure_fin'] ?>
                            <form action="annuler_reservation.php" method="POST">
                                <input type="hidden" name="reservation_id" value="<?= $reservation['id'] ?>">
                                <button type="submit" class="btn btn-danger btn-sm">Annuler</button>
                            </form>
                        </li>
                    <?php endforeach; ?>
                </ul>
            <?php endif; ?>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>