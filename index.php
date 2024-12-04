<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
?>

<!DOCTYPE html>
<html lang="fr" data-bs-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OneTimeSecret</title>
    <link rel="icon" href="include/icon.webp">
    <link rel="stylesheet" href="include/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link href="node_modules/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <?php 
        include "include/bddConnector.php";
        include "include/dbo.php";
    ?>
    
</head>
<body>
    <div class="container">
<nav class="navbar navbar-expand-lg bg-body-tertiary rounded" aria-label="Eleventh navbar example">
      <div class="container-fluid">
        <a class="navbar-brand" href="?"><img class="navbar-icon" src="include/icon.webp">&nbsp;&nbsp;OneTimeSecret</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarsExample09" aria-controls="navbarsExample09" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarsExample09">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="? ">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="?newMessage">Message</a>
            </li>
            <li class="nav-item">
              <a class="nav-link disabled" aria-disabled="true">Secured Message</a>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown" aria-expanded="false">Language</a>
              <ul class="dropdown-menu">
                <?php
                  foreach (Message::getLanguages() as $lang){ ?>
                    <li><a class="dropdown-item" href="#"><img class="flag-dwn" src="flags/<?php echo $lang['flag_url']?>">&nbsp;&nbsp;&nbsp;<?php echo $lang['lang_lib']?></a></li>
                <?php } ?>
              </ul>
            </li>
          </ul>
        </div>
      </div>
    </nav>
</div>
<br>
<div class="container">
    <?php
    //Affichage des pages

    if (isset($_GET['newMessage'])){
        include "include/newMessage.php";
    }
    if (isset($_GET['readMessage'])){
        include "include/readMessage.php";
    }
    ?>
</div>
<div class="container fixed-bottom">
  <footer class="py-3 my-4">
  <script src="/docs/5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <ul class="nav justify-content-center border-bottom pb-3 mb-3">
      <li class="nav-item"><a href="?" class="nav-link px-2 text-body-secondary">Home</a></li>
      <li class="nav-item"><a href="?newMessage" class="nav-link px-2 text-body-secondary">Message</a></li>
      <li class="nav-item"><a href="#" class="nav-link px-2 text-body-secondary disabled">Secured Message</a></li>
      <li class="nav-item"><a href="#" class="nav-link px-2 text-body-secondary">About</a></li>
    </ul>
    <p class="text-center text-body-secondary">© 2024 Jules PILLOT</p>
  </footer>
</div>
</body>
</html>