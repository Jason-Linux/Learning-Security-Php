<?php
require_once('functions.php');
session_start();
$captchaError = '';
$SetPassError = '';
if(isset($_POST['captcha'])) {
    if ($_POST['captcha'] == $_SESSION['captcha']) {
        echo "Captcha valide !";
        $password = $_POST['password'];
        $email = $_POST['email'];
        $uppercase = preg_match('@[A-Z]@', $password);
        $lowercase = preg_match('@[a-z]@', $password);
        $number    = preg_match('@[0-9]@', $password);
        $specialChars = preg_match('@[^\w]@', $password);
        if (isset($_POST['username']) && isset($email) && isset($password)) {
            if(!$uppercase || !$lowercase || !$number || !$specialChars || strlen($password) < 12){
                $SetPassError = 'Password should be at least 8 characters in length and should include at least one upper case letter, one number, and one special character.' ;
            }else{
            $result = saveUser($_POST['username'], $_POST['email'], password_hash($_POST['password'], PASSWORD_DEFAULT, ['cost' => 12]));
            #Minimum 12 caractères spéciaux recommendation ANSSI
                
            if($result === true) {
                    header('Location: index.php');
                } else {
                    echo "Une erreur est survenue " . $result;
                }
        }}
    } else {
    $captchaError = "Captcha Invalide !";
    }
} 
?>

<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Ma super app sécurisée - Inscription</title>
    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
</head>
<body>
<a href="index.php">HOME</a>
<div class="container">
    <h1>Inscription</h1>
    <form action="/register.php" method="POST" class="needs-validation" novalidate>
        <div class="form-group">
            <label for="username">Nom d'utilisateur :</label>
            <input type="text" class="form-control" id="username" name="username" required>
            <div class="invalid-feedback">
                S'il vous plaît entrez un nom d'utilisateur.
            </div>
        </div>
        <div class="form-group">
            <label for="email">Adresse email :</label>
            <input type="email" class="form-control" id="email" name="email" required>
            <div class="invalid-feedback">
                S'il vous plaît entrez une adresse email valide.
            </div>
        </div>
        <div class="form-group">
            <label for="password">Mot de passe :</label>
            <input type="password" class="form-control" id="password" name="password" required>
            <div class="invalid-feedback">
                S'il vous plaît entrez un mot de passe.
            </div>
        </div>
        <div class="form-group">
            <label for="password-confirm">Confirmez le mot de passe :</label>
            <input type="password" class="form-control" id="password-confirm" name="password-confirm" required>
            <div class="invalid-feedback">
                S'il vous plaît confirmez votre mot de passe.
            </div>
        </div>
        <img src="captcha.php" />
            <input type="text" name="captcha" />
            <?= $captchaError ?>
            <!-- <input type="submit" /> -->
        <button type="submit" class="btn btn-primary">S'inscrire</button>
        <?= $SetPassError ?>
    </form>
    <script>
        var password = document.getElementById("password");
        var confirm_password = document.getElementById("password-confirm");

        function validatePassword(){
            console.log('here');
            if(password.value != confirm_password.value) {
                confirm_password.setCustomValidity("Les mots de passe ne correspondent pas");
                return false;
            } else {
                confirm_password.setCustomValidity('');
                return true;
            }
        }

        password.onchange = validatePassword;
        confirm_password.onkeyup = validatePassword;

        // Example starter JavaScript for disabling form submissions if there are invalid fields
        (function() {
            'use strict';
            window.addEventListener('load', function() {
                // Fetch all the forms we want to apply custom Bootstrap validation styles to
                var forms = document.getElementsByClassName('needs-validation');
                // Loop over them and prevent submission
                var validation = Array.prototype.filter.call(forms, function(form) {
                    form.addEventListener('submit', function(event) {
                        if (form.checkValidity() === false) {
                            event.preventDefault();
                            event.stopPropagation();
                        }
                        form.classList.add('was-validated');
                    }, false);
                });
            }, false);
        })();
    </script>
</div>
</body>
</html>