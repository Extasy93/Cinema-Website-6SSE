<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="Page de planing / Cinéma - Hainaut">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Cache-Control" content="max-age=31536000">
    <link rel="stylesheet" href="assets\css\style.css">
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
    <link href="https://fonts.googleapis.com/css2?family=Fredoka:wght@300&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Poppins:900i" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Comfortaa" rel="stylesheet">
    <title>Cinéma Des Retho - Planing</title>
    <link rel="shortcut icon" href="assets\img\cinema-icon.webp" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"/>
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body class="dynamic-wallpaper">

    <div class="container">
        <a href="home.html" class="retour-link">
            <img id="arrow-cursor" class="imgRetour" src="assets\img\retour.webp" alt="retour">
        </a>
        <div class="sous-container">

            <div class="divContentPlanning">
                <h1>
                    <span id="planning-seance-text" class="reveal-h1">Planning Des Séances<span>📽️</span></span>
                </h1>
            </div>

            <video id="video-background" autoplay loop muted>
                <!-- Format vidéo pour les écrans larges -->
                <source src="../assets/img/planning-large.mp4" type="video/mp4" media="(min-width: 768px)">
                <!-- Format vidéo pour les écrans étroits (téléphones) -->
                Votre navigateur ne prend pas en charge la diffusion de vidéo.
            </video>
            
            <img id="image-mobile" src="../assets/img/planning-small.webp" alt="Description de l'image">
        </div>
    </body>
    <script src="assets\js\script.js"></script>
</html>
