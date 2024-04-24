<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="Page de vote / Cinéma - Hainaut">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Cache-Control" content="max-age=31536000">
    <link rel="stylesheet" href="assets\css\style.css">
    <link rel="shortcut icon" href="cinema-icon.webp" type="image/x-icon">
    <link href="https://fonts.googleapis.com/css2?family=Fredoka:wght@300&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Poppins:900i" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Comfortaa" rel="stylesheet">
    <title>Cinéma Des Retho - Vote</title>
    <link rel="shortcut icon" href="assets\img\cinema-icon.webp" type="image/x-icon">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"/>
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body class="dynamic-wallpaper">
    <div id="blur-background"></div>

    <?php
        ob_start();

        // Définissez l'attribut SameSite pour le cookie
        ini_set('session.cookie_samesite', 'None');

        if (isset($_COOKIE['voted_now']) && $_COOKIE['voted_now'] === 'true') {
            echo "
                <script>
                    Swal.fire({
                        icon: 'success',
                        title: 'Vote enregistré !',
                        text: 'Votre vote à bien été prises en comptes.',
                        confirmButtonText: 'OK',
                    });

                    setCookie('voted_now', false, 30);
                </script>
            ";
        }
    ?>

    <script>
        function hasVotedNotification() {
            Swal.fire({
                icon: "error",
                title: "Oops...",
                text: "Vous avez déja voté !",
            });
        }
    </script>

    <div id="modal" class="modal">
        <div class="modal-content">
            <h2>Choisissez votre classe :</h2>
            <select id="classSelector">
                <option value="1er">6AE1, 6AE2 ou 5AN1</option>
                <option value="2ème">4SSE, 3SSE, 3TS1 ou 3TS2</option>
                <option value="3ème">3TS3, 5AN2 ou 5SSE</option>
                <option value="4ème">1C, 2C1, 2C2, 2S1, 2S2</option>
            </select>
            <button onclick="selectClass()">Valider</button>
        </div>
    </div>

    <!-- Boîte de dialogue vote caché -->
    <div id="voteModal" style="display: none;">
        <div class="modal-vote-content">
            <h2>Vous venez de voter !</h2>
        </div>
    </div>

    <div class="container">
        <a href="home.html" class="retour-link">
            <img id="arrow-cursor" class="imgRetour" src="assets\img\retour.webp" alt="retour">
        </a>
        <div class="sous-container">

            <div class="divContentVote">
                <h1>
                    <span id="h1-vote-film-text" class="reveal-h1">C'est l'heure de voter ! <img src="assets/img/voting-box.webp" alt="Icône de vote" class="custom-vote-icon"></span>
                </h1>
                <h2>
                    <?php
                        include 'pdo.php';
                        if (isset($_GET['selectedClass'])) {
                            $selectedClass = $_GET['selectedClass'];

                            // Récupère les films depuis la base de données
                            $stmt = $conn->prepare("SELECT * FROM films WHERE classe = :selectedClass ORDER BY votes DESC LIMIT 1");
                            $stmt->bindParam(':selectedClass', $selectedClass);
                            $stmt->execute();
                            $films = $stmt->fetchAll(PDO::FETCH_ASSOC);

                            if ($films) {
                                $film = $films[0]; // Prend le premier film (celui avec le plus de votes)
                        
                                ?>
                                    <span id="plus-de-vote-film-text" class="reveal-h2">Le film qui a le plus de votes actuellement est : <span class="reveal-h2-color-result"><?php echo $film['titre']; ?></span></span>
                                <?php
                            } else {
                                ?>
                                    <span class="reveal-h2">Aucun film trouvé pour la classe sélectionnée.</span>
                                <?php
                            }
                        }
                    ?>
                </h2>   
                <h2>
                    <span id="list-film-text" class="reveal-h2">Voter parmi les films de cette liste: </span>
                </h2>      
            </div>

            <section id="Vote-section">
                <div class="film-content">
                    <script>

                        $(document).ready(function () {
                            // Initialisez Swiper
                            var mySwiper = new Swiper('.swiper', {
                                // Configuration de Swiper
                                loop: true,
                            });

                            // Attribution de l'ID du premier élément au chargement de la page
                            filmId = $('.swiper-slide:first').attr('film_id');
                            $('.cta').attr('data-film-id', filmId);
                            console.log('ID du film au chargement de la page:', filmId);

                            // Ajoutez un gestionnaire d'événements 'transitionend' à chaque élément .swiper-slide
                            $('.swiper-slide').on('transitionend', function () {
                                // Récupérez l'ID du film à partir de l'attribut 'film_id' de la slide active
                                var filmId = $('.swiper-slide-active').attr('film_id');
                                $('.cta').attr('data-film-id', filmId);
                            });

                            // Ajoutez le bouton avec un gestionnaire d'événements click
                            $('.cta').on('click', function () {
                                // Récupérez l'ID du film à partir de l'attribut 'data-film-id' du bouton
                                var filmId = $(this).attr('data-film-id');
                                console.log('Clic sur le bouton avec l\'ID du film:', filmId);
                                if (hasVoted()) {
                                    hasVotedNotification()
                                } else {
                                    window.location.href = 'voted.php?filmId=' + filmId;
                                }
                            });

                            function hasVoted() {
                                return document.cookie.indexOf('voted=true') !== -1;
                            }
                        });

                        // Fonction pour afficher filmId dans la console
                        function getFilmId() {
                            console.log(filmId);
                        }
                    </script>

                    <div class="info">
                        <p>Votez pour votre film préféré ! Le film le plus voté sera celui diffusé lors de votre séance alors... Faites le bon choix ! </p>
                        <button class="cta">
                            <span id="text-vote">Voter <img src="assets/img/voting-box.webp" alt="Icône de vote" class="custom-vote-icon"></span>
                            <span id="svg-vote">
                                <svg width="66px" height="43px" viewBox="0 0 66 43" version="1.1"
                                    xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                    <g id="arrow" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                        <path class="one"
                                            d="M40.1543933,3.89485454 L43.9763149,0.139296592 C44.1708311,-0.0518420739 44.4826329,-0.0518571125 44.6771675,0.139262789 L65.6916134,20.7848311 C66.0855801,21.1718824 66.0911863,21.8050225 65.704135,22.1989893 C65.7000188,22.2031791 65.6958657,22.2073326 65.6916762,22.2114492 L44.677098,42.8607841 C44.4825957,43.0519059 44.1708242,43.0519358 43.9762853,42.8608513 L40.1545186,39.1069479 C39.9575152,38.9134427 39.9546793,38.5968729 40.1481845,38.3998695 C40.1502893,38.3977268 40.1524132,38.395603 40.1545562,38.3934985 L56.9937789,21.8567812 C57.1908028,21.6632968 57.193672,21.3467273 57.0001876,21.1497035 C56.9980647,21.1475418 56.9959223,21.1453995 56.9937605,21.1432767 L40.1545208,4.60825197 C39.9574869,4.41477773 39.9546013,4.09820839 40.1480756,3.90117456 C40.1501626,3.89904911 40.1522686,3.89694235 40.1543933,3.89485454 Z"
                                            fill="#FFFFFF"></path>
                                        <path class="two"
                                            d="M20.1543933,3.89485454 L23.9763149,0.139296592 C24.1708311,-0.0518420739 24.4826329,-0.0518571125 24.6771675,0.139262789 L45.6916134,20.7848311 C46.0855801,21.1718824 46.0911863,21.8050225 45.704135,22.1989893 C45.7000188,22.2031791 45.6958657,22.2073326 45.6916762,22.2114492 L24.677098,42.8607841 C24.4825957,43.0519059 24.1708242,43.0519358 23.9762853,42.8608513 L20.1545186,39.1069479 C19.9575152,38.9134427 19.9546793,38.5968729 20.1481845,38.3998695 C20.1502893,38.3977268 20.1524132,38.395603 20.1545562,38.3934985 L36.9937789,21.8567812 C37.1908028,21.6632968 37.193672,21.3467273 37.0001876,21.1497035 C36.9980647,21.1475418 36.9959223,21.1453995 36.9937605,21.1432767 L20.1545208,4.60825197 C19.9574869,4.41477773 19.9546013,4.09820839 20.1480756,3.90117456 C20.1501626,3.89904911 20.1522686,3.89694235 20.1543933,3.89485454 Z"
                                            fill="#FFFFFF"></path>
                                        <path class="three"
                                            d="M0.154393339,3.89485454 L3.97631488,0.139296592 C4.17083111,-0.0518420739 4.48263286,-0.0518571125 4.67716753,0.139262789 L25.6916134,20.7848311 C26.0855801,21.1718824 26.0911863,21.8050225 25.704135,22.1989893 C25.7000188,22.2031791 25.6958657,22.2073326 25.6916762,22.2114492 L4.67709797,42.8607841 C4.48259567,43.0519059 4.17082418,43.0519358 3.97628526,42.8608513 L0.154518591,39.1069479 C-0.0424848215,38.9134427 -0.0453206733,38.5968729 0.148184538,38.3998695 C0.150289256,38.3977268 0.152413239,38.395603 0.154556228,38.3934985 L16.9937789,21.8567812 C17.1908028,21.6632968 17.193672,21.3467273 17.0001876,21.1497035 C16.9980647,21.1475418 16.9959223,21.1453995 16.9937605,21.1432767 L0.15452076,4.60825197 C-0.0425130651,4.41477773 -0.0453986756,4.09820839 0.148075568,3.90117456 C0.150162624,3.89904911 0.152268631,3.89694235 0.154393339,3.89485454 Z"
                                            fill="#FFFFFF"></path>
                                    </g>
                                </svg>
                            </span>
                        </button>
                    </div>

                    <div class="swiper">
                        <div class="swiper-wrapper">
                    
                        <?php
                            include 'pdo.php';
                            if (isset($_GET['selectedClass'])) {
                                $selectedClass = $_GET['selectedClass'];

                            // Récupère les films depuis la base de données
                            $stmt = $conn->prepare("SELECT * FROM films WHERE classe = :selectedClass");
                            $stmt->bindParam(':selectedClass', $selectedClass);
                            $stmt->execute();
                            $films = $stmt->fetchAll(PDO::FETCH_ASSOC);

                            foreach ($films as $film) {
                                ?>
                                    <div film_id="<?php echo $film['id']; ?>" datafilm="<?php echo $film['titre']; ?>" class="swiper-slide" style="background: linear-gradient(to top, #0f2027, #203a4300, #2c536400), url('<?php echo $film['image']; ?>') no-repeat 50% 50% / cover;">
                                        <span><?php echo $film['votes']; ?><img src="assets/img/voting-box.webp" alt="Icône de vote" class="custom-vote-icon"></span>
                                        <h2><?php echo $film['titre']; ?></h2>
                                    </div>
                                <?php } 
                            }
                        ?>
                        </div>
                    </div>
                </div>
                
            </section>
        </div>
    </body>
    <script src="assets\js\script.js"></script>
</html>
