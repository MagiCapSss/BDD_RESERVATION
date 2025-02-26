<?php include 'header.php'; ?>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow p-4">
                <h2 class="text-center mb-4">Réserver un créneau</h2>

                <!-- Formulaire de réservation -->
                <form action="traitement_reservation.php" method="POST">
                    <div class="mb-3">
                        <label for="date" class="form-label">Choisissez une date</label>
                        <input type="text" class="form-control" id="date" name="date" required>
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
                    <!-- Token CSRF (à générer dynamiquement en PHP) -->
                    <input type="hidden" name="csrf_token" value="TOKEN_A_REMPLACER">
                    <!-- Bouton de validation -->
                    <button type="submit" class="btn btn-primary w-100">Réserver</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Liste des réservations -->
<div class="container mt-4">
    <h3 class="text-center">Mes Réservations</h3>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <ul class="list-group">
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    12/03/2025 à 09:00
                    <form action="annuler_reservation.php" method="POST">
                        <input type="hidden" name="reservation_id" value="1">
                        <button type="submit" class="btn btn-danger btn-sm">Annuler</button>
                    </form>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    15/03/2025 à 14:00
                    <form action="annuler_reservation.php" method="POST">
                        <input type="hidden" name="reservation_id" value="2">
                        <button type="submit" class="btn btn-danger btn-sm">Annuler</button>
                    </form>
                </li>
            </ul>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>