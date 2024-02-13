<?php
$gameid = $_GET['id'];
$jsonData = file_get_contents('games.json');
$games = json_decode($jsonData, true);

if (array_key_exists($gameid, $games)) {
    $game = $games[$gameid];
    $cat = $game['cat'];
    $name = $game['name'];
    $iframe = "http://yixboost.nl.eu.org/yixboost/games/gameframe.php?id=" . $gameid;

    if (isset($game['extra'])) {
        $extra = $game['extra'];
    } else {
        $extra = null;
    }
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
        background-color: #000;
    }

    .game-container {
        position: relative;
        width: 100%;
        height: calc(100vh - 0px);
    }

    .game-iframe {
        width: 100%;
        height: 100%;
        border: none;
    }

    .chat {
        margin: 20px;
        position: absolute;
        right: 0;
        bottom: 0;
        top: 0;
    }

    .visible {
        opacity: 1;
        transition: opacity 0.5s ease-in-out;
    }

    img {
        opacity: 0;
    }
</style>
</head>

<body>
    <div class="game-container">
        <iframe class="game-iframe" src="<?php echo $iframe; ?>"></iframe>
    </div>
    <a href='https://u24.gov.ua/' target="_blank"><img src="https:\/\/100widgets.com\/stop_war.svg"
            style="width:80px;height:160px;position:fixed;bottom:0;right:0;"></a>
    <script>
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
    </script>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            var image = document.querySelector("img");
            window.addEventListener("scroll", function () {
                if (window.scrollY > 0) {
                    image.classList.add("visible");
                } else {
                    image.classList.remove("visible");
                }
            });
        });
    </script>
</body>

</html>