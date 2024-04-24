// ################################################################################################
// EFFETS SELECTION FILMS
// ################################################################################################

const $cards = document.querySelectorAll('.film-card');

$cards.forEach($card => {
  $card.addEventListener('mouseenter', (e) => {
    const bounds = $card.getBoundingClientRect();
    document.addEventListener('mousemove', (e) => rotateToMouse(e, $card, bounds));
  });

  $card.addEventListener('mouseleave', () => {
    document.removeEventListener('mousemove', rotateToMouse);
    $card.style.transform = '';
  });
});

function rotateToMouse(e, $card, bounds) {
  const mouseX = e.clientX;
  const mouseY = e.clientY;

  // Ajuste les limites pour exclure la bordure de l'élément
  const adjustedBounds = {
    left: bounds.left + $card.clientLeft,
    top: bounds.top + $card.clientTop,
    right: bounds.right + $card.clientLeft,
    bottom: bounds.bottom + $card.clientTop,
    width: bounds.width,
    height: bounds.height
  };

  // Vérifie si la souris est à l'intérieur des limites de la carte
  if (
    mouseX >= adjustedBounds.left &&
    mouseX <= adjustedBounds.right &&
    mouseY >= adjustedBounds.top &&
    mouseY <= adjustedBounds.bottom
  ) {
    const leftX = mouseX - adjustedBounds.left;
    const topY = mouseY - adjustedBounds.top;
    const center = {
      x: leftX - adjustedBounds.width / 2,
      y: topY - adjustedBounds.height / 2
    };
    const distance = Math.sqrt(center.x ** 2 + center.y ** 2);

    $card.style.transform = `
          scale3d(1.07, 1.07, 1.07)
          rotate3d(
              ${center.y / 100},
              ${-center.x / 100},
              0,
              ${Math.log(distance) * 2}deg
          )
      `;

    $card.querySelector('.glow').style.backgroundImage = `
          radial-gradient(
              circle at
              ${center.x * 2 + adjustedBounds.width / 2}px
              ${center.y * 2 + adjustedBounds.height / 2}px,
              #ffffff55,
              #0000000f
          )
      `;
  }
}

// ################################################################################################
// Ouverture séléction de classe
// ################################################################################################

document.addEventListener('DOMContentLoaded', function () {
  // Vérifie si la classe a déjà été choisie (vérifie le cookie)
  const selectedClass = getCookie('selectedClass');
  const voted = getCookie('voted');

  console.log(selectedClass);

  // Si la classe est déjà choisie, masque le pop-up
  if (selectedClass) {
    document.getElementById('blur-background').style.display = 'none';
    document.getElementById('modal').style.display = 'none';

    // Vérifie si la page actuelle est "films.php" avant de rediriger
    if (window.location.href.includes('films.php?selectedClass=')) {
      // Envoie la classe choisie au serveur en tant que paramètre de requête GET
      fetch('films.php', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: `selectedClass=${encodeURIComponent(selectedClass)}`,
      })
      return;
    }

    // Vérifie si la page actuelle est "films.php" avant de rediriger
    if (window.location.href.includes('films.php')) {
      // Envoie la classe choisie au serveur en tant que paramètre de requête GET
      window.location.href = 'films.php?selectedClass=' + encodeURIComponent(selectedClass);
    }

  } else {
    document.getElementById('blur-background').style.display = 'block';
    document.getElementById('modal').style.display = 'flex';
    document.getElementById('Vote-section').style.display = 'none';
  }
});


function selectClass() {
  // Récupère la classe choisie
  const selectedClass = document.getElementById('classSelector').value;

  // Enregistre la classe dans un cookie
  setCookie('selectedClass', selectedClass, 7); // 7 jours d'expiration

  // Envoie la classe choisie au serveur en tant que paramètre de requête GET
  window.location.href = 'films.php?selectedClass=' + encodeURIComponent(selectedClass);

  // Cache l'arrière-plan flou et la modal
  document.getElementById('blur-background').style.display = 'none';
  document.getElementById('modal').style.display = 'none';
}

function votedNow() {
  // Enregistre la classe dans un cookie
  setCookie('voted_now', false, 30); // 7 jours d'expiration
}


// Fonction pour définir un cookie
function setCookie(name, value, days) {
  const date = new Date();
  date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
  const expires = "expires=" + date.toUTCString();

  // Ajoutez SameSite=None; Secure à la chaîne du cookie
  const cookieString = name + "=" + value + ";" + expires + ";path=/;SameSite=None;Secure";

  document.cookie = cookieString;
}


// Fonction pour récupérer la valeur d'un cookie
function getCookie(name) {
  const cname = name + "=";
  const decodedCookie = decodeURIComponent(document.cookie);
  const ca = decodedCookie.split(';');
  for (let i = 0; i < ca.length; i++) {
    let c = ca[i];
    while (c.charAt(0) === ' ') {
      c = c.substring(1);
    }
    if (c.indexOf(cname) === 0) {
      return c.substring(cname.length, c.length);
    }
  }
  return null;
}

// ################################################################################################
// Swipe card
// ################################################################################################

var swiper = new Swiper(".swiper", {
  effect: "cards",
  grabCursor: true,
  initialSlide: 2,
  speed: 500,
  loop: true,
  rotate: true,
  mousewheel: {
    invert: false
  }
});

