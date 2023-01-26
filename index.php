<?php
require_once('functions.php');
session_start();
$user = $_SESSION['user'] ?: null;
$captchaError = '';
if(isset($_POST['captcha'])) {
    if ($_POST['captcha'] == $_SESSION['captcha']) {
        echo "Captcha valide !";
        if (isset($_POST['email']) && isset($_POST['password'])) {
            $users = logUser($_POST['email'], $_POST['password']);
                 if(!empty($users)) {
                    $user = $users[0];
                    $_SESSION['user'] = $user;
                }
        }           
    } else {
        $captchaError = "Captcha Invalide !";
    }
} 

?>

<html>
<head>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Ma super app sécurisée</title>
        <!-- Bootstrap -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.4.1/dist/css/bootstrap.min.css"
              integrity="sha384-HSMxcRTRxnN+Bdg0JdbxYKrThecOKuH5zCYotlSAcp1+c8xmyTe9GYg1l9a69psu"
              crossorigin="anonymous">
    <a href="logout.php">Log Out Btn</a>
    <a href="register.php">S'enregistrer</a>
    </head>
</head>
<body>
<div class="container">
    <?php if(!$user): ?>
    <h1>Connexion</h1>
    <form action="/" method="POST">
        <div class="form-group">
            <label for="exampleInputEmail1">Email address</label>
            <input name="email" type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
            <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small >
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">Password</label>
            <input name="password" type="password" class="form-control" id="exampleInputPassword1">
        </div>
        <div class="form-group">
            <label for="stayConnected">Rester connecté</label>
            <input name="stayConnected" type="checkbox" id="stayConnected">
        </div>
        <img src="captcha.php" />
        <input type="text" name="captcha" />
        <?= $captchaError ?>
        <!-- <input type="submit" /> -->
        <button type="submit" class="btn btn-primary">Submit</button>

    </form>
    <?php else: ?>
        <h1>Bienvenue <?= $user->email ?></h1>
    <a href="informations.php?id=<?= $user->id ?>">Mes informations</a>
    <?php endif ?>
</div>
</body>
</html>