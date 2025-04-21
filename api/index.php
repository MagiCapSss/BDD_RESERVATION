<?php include 'header.php'; ?>

<div class="container mt-4">
<section class="container text-center my-5">
            <h1>Bienvenue au Restaurant Borcelle</h1>
            <p>Une expérience culinaire inoubliable</p>
        </section>

        <section class="container text-center my-5">
            <div class="restaurant">
                <div>
                    <h1>À propos</h1>
                    <p>Bienvenue au Borcelle, un restaurant gastronomique où la haute cuisine rencontre l’élégance et le raffinement. Situé dans un cadre chaleureux et intimiste, Le Borcelle vous invite à un voyage sensoriel inoubliable, où chaque plat est une œuvre d’art, sublimant des ingrédients d’exception avec créativité et passion.<br><br>
                    Notre chef étoilé met un point d’honneur à revisiter les saveurs traditionnelles avec une touche contemporaine, en s’inspirant des produits du terroir et des saisons. Du dressage soigné à l’accord parfait des mets et des vins, chaque détail est pensé pour émerveiller vos papilles. <br><br>
                    Que ce soit pour une soirée romantique, un dîner d’affaires ou une célébration spéciale, Le Borcelle vous promet une expérience culinaire unique, alliant excellence gastronomique et service d’exception. <br><br>
                    Venez découvrir l’art de la gastronomie au Borcelle et laissez-vous envoûter par une cuisine aussi audacieuse que délicate.</p>
                </div>
                <img src="/assets/img/ImageRestaurant.png" class="image-resto" alt="Image du restaurant">
            </div>
        </section>

        <h1 class="text-center">Nos Spécialités</h1>

        <div id="carouselExampleCaptions" class="carousel slide">
            <div class="carousel-indicators">
              <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
              <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
              <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
            </div>
            <div class="carousel-inner">
              <div class="carousel-item active">
                <img src="/assets/img/NoixStJacques.png" class="d-block w-100" alt="...">
                <div class="carousel-caption d-none d-md-block">
                  <h5 class="textCarousel fw-bold">Noix de St Jacques</h5>
                </div>
              </div>
              <div class="carousel-item">
                <img src="/assets/img/PoissonEtLégumes.png" class="d-block w-100" alt="...">
                <div class="carousel-caption d-none d-md-block">
                  <h5 class="textCarousel fw-bold">Poisson et sa montagne de légumes</h5>
                </div>
              </div>
              <div class="carousel-item">
                <img src="/assets/img/QuinoaAuSaumon.png" class="d-block w-100" alt="...">
                <div class="carousel-caption d-none d-md-block">
                  <h5 class="textCarousel fw-bold">Saumon sur son lit de quinoa</h5>
                </div>
              </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
              <span class="carousel-control-prev-icon" aria-hidden="true"></span>
              <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
              <span class="carousel-control-next-icon" aria-hidden="true"></span>
              <span class="visually-hidden">Next</span>
            </button>
          </div>
</div>

<?php include 'footer.php'; ?>
