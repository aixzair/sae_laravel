<?php

$dotenv = fopen('../../.env', 'r');
if ($dotenv) {
    while (($line = fgets($dotenv)) !== false) {
        $line = trim($line);
        if (empty($line) || $line[0] === '#') {
            continue;
        }

        list($key, $value) = explode('=', $line, 2);
        $_ENV[$key] = $value;
    }
    fclose($dotenv);
}

$host = $_ENV['DB_HOST'];
$dbname = $_ENV['DB_DATABASE'];
$user = $_ENV['DB_USERNAME'];
$pass = $_ENV['DB_PASSWORD'];

try {
    $bdd = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $pass);
    $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // echo "Connexion à la base de données réussie.";
} catch (PDOException $e) {
    echo "Erreur de connexion à la base de données : " . $e->getMessage();
}

?>
