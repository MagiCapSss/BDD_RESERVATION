<?php
include 'header.php';
?>

<div class="container d-flex justify-content-center align-items-center mt-5">
    <div class="col-md-6 mt-5 mb-5">
        <div class="card shadow p-4">
            <h2 class="text-center mb-4 mt-4">Connexion</h2>
            
            <?php
            if (isset($_SESSION['error'])) {
                echo '<div class="alert alert-danger">' . $_SESSION['error'] . '</div>';
                unset($_SESSION['error']);
            }
            if (isset($_SESSION['success'])) {
                echo '<div class="alert alert-success">' . $_SESSION['success'] . '</div>';
                unset($_SESSION['success']);
            }
            ?>
            
            <form action="traitement_connexion.php" method="POST">
                <div class="mb-3 mt-4">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email" required>
                </div>
                <div class="mt-4 mb-3">
                    <label for="password" class="form-label">Mot de passe</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                </div>
                <button type="submit" class="btn btn-primary w-100 mt-4">Se connecter</button>
            </form>
            <div class="text-center mt-5 mb-5">
                <p>Pas encore inscrit ? <a href="inscritption.php">Créez un compte</a></p>
            </div>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>