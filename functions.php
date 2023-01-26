<?php

function connectDb()
{
    try {
        $conn = new PDO("mysql:host=169.254.0.5:3307;dbname=authentication", 'root', 'admin');
        // set the PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $conn;
    } catch(PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
        return null;
    }
}

function logUser($email, $password)
{
    $connexion = connectDb();
    $sql = 'SELECT * FROM users WHERE email = "' . $email . '" AND password = "' .$password . '"';
    $stmt = $connexion->prepare($sql);
    $stmt->execute();

    return $stmt->fetchAll(PDO::FETCH_OBJ);
}

function getUser($id) {
    $connexion = connectDb();
    if (is_numeric($_GET['id']) && abs($_GET['id']) == $_GET['id']) {
        $sql = 'SELECT * FROM users WHERE id = '.$_GET['id'];
    }
    else{echo "Sorry, only positive integers allowed here!";}
    $stmt = $connexion->prepare($sql);
    $stmt->execute();

    return $stmt->fetchAll(PDO::FETCH_OBJ);
}

function saveUser($email, $username, $password) {
    $connexion = connectDb();
    $sql = 'INSERT INTO users(username,email,password) VALUES("'.$email.'","'.$username.'","'.$password.'")';
    $stmt = $connexion->prepare($sql);

    return $stmt->execute();
}