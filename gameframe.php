<?php
session_start();
if (!isset($_SESSION['username'])) {
  header("Location: http://yixboost.nl.eu.org/yixboost/please-login/");
  exit();
}
?>
<?php
$gameid = $_GET['id'];
$jsonData = file_get_contents('games.json');
$games = json_decode($jsonData, true);

if (array_key_exists($gameid, $games)) {
  $game = $games[$gameid];
  $cat = $game['cat'];
  $name = $game['name'];
  $iframe = "http://yixboost.nl.eu.org/yixboost/games/" . $gameid . "/";
} else {
  echo "Game not found";
}
?>
<?php
header("X-Frame-Options: ALLOW-FROM http://yixboost.nl.eu.org");
?>
<!DOCTYPE html>
<html>

<head>
  <link rel="icon" href="http://yixboost.nl.eu.org/yixboost/games/<?php echo $gameid; ?>/<?php echo $gameid; ?>.png"
    type="image/x-icon">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
  <script src="https://kit.fontawesome.com/6948f435f5.js" crossorigin="anonymous"></script>
  <title>
    <?php echo $name; ?> Unblocked | Yixboost Games
  </title>
</head>
<style>
  body {
    margin: 0;
    padding: 0;
    font-family: Arial, Helvetica, sans-serif;
  }

  .game-container {
    position: relative;
    width: 100%;
    height: calc(100vh - 50px);
  }

  .game-iframe {
    width: 100%;
    height: 100%;
    border: none;
  }

  .bottom-bar {
    position: fixed;
    bottom: 0;
    left: 0;
    width: 100%;
    height: 50px;
    background-color: #f1f1f1;
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 0 10px;
    background-color: black;
    color: white;
    border-top: 1px solid white;
  }

  .logo img {
    height: 40px;
    width: auto;
  }

  .icons {
    display: flex;
    gap: 10px;
    margin-right: 20px;
  }

  .icons i {
    font-size: 20px;
  }

  .icons i:hover {
    transform: rotate(10deg);
    transition: transform 0.2s ease;
  }
</style>
</head>

<body>
  <div class="game-container">
    <iframe class="game-iframe" src="<?php echo $iframe; ?>"></iframe>
  </div>
  <div class="bottom-bar">
    <div class="logo"><a href='http://yixboost.nl.eu.org/yixboost/games/#<?php echo $cat; ?>'><img
          src='images/game-page-logo.png'></a>
    </div>
    <div class="icons">
      <i class="fas fa-rotate-right"></i>
      <i class="fas fa-share-alt"></i>
      <i class="fas fa-expand"></i>
    </div>
  </div>
  <script>

    // Voeg een eventlistener toe voor het keydown-event op het document
    document.addEventListener('keydown', function (e) {
      // Controleer of de ingedrukte toets de spatiebalk is (keyCode 32)
      if (e.keyCode === 32) {
        // Voorkom het standaardgedrag van de spatiebalk (scrollen)
        e.preventDefault();
      }
    });

    // Verplaats de focus naar het iframe
    window.addEventListener('DOMContentLoaded', function () {
      var iframe = document.querySelector('.game-iframe');
      iframe.onload = function () {
        console.log('De iframe is geladen');
        iframe.contentWindow.focus();
      };
      iframe.src = '<?php echo $iframe; ?>';
    });

    document.addEventListener('keydown', function (event) {
      var iframe = document.querySelector('.game-iframe');
      var key = event.key.toLowerCase();
      if (key === 'arrowup' || key === 'arrowdown' || key === 'arrowleft' || key === 'arrowright' || key === 'w' || key === 'a' || key === 's' || key === 'd' || key === ' ') {
        iframe.contentWindow.focus();
      }
      iframe.contentWindow.postMessage(event.key, '*');
    });
    // Zet game in fullscreen
    const expandButton = document.querySelector('.fas.fa-expand');
    const gameIframe = document.querySelector('.game-iframe');

    expandButton.addEventListener('click', () => {
      gameIframe.requestFullscreen();
    });

    // Herlaad de game
    const reloadIcon = document.querySelector('.fa-rotate-right');
    reloadIcon.addEventListener('click', function () {
      location.reload();
    });

  </script>
</body>

</html>