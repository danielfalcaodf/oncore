<?php
// site config
define("SITE", [

    "nome" => "OnCore",
    "desc" => "OnCore panel de admin para server de Linux ",
    "domain" => "localauth.com",
    "locale" => "pt_BR",
    "root" => "https://localhost/oncore"

]);
//root OS
$root = '/';
if (PHP_OS == "WINNT") {
    # code...
    $root = "C:\\xampp";
}
define('ROOT_OS',  $root);
// site minify
if ($_SERVER['SERVER_NAME'] == "localhost") {
    require __DIR__ . "/Minify.php";
}

// database criado
define("DATA_LAYER_CONFIG", [
    "driver" => "mysql",
    "host" => "localhost",
    "port" => "3306",
    "dbname" => "auth",
    "username" => "root",
    "passwd" => "",
    "options" => [
        PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8",
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
        PDO::ATTR_CASE => PDO::CASE_NATURAL
    ]
]);

// social 

define("SOCIAL", [

    "facebook_page" => "",
    "facebook_author" => "",
    "facebook_appId" => "",
    "twitter_creator" => "",


]);

// mail config

define("MAIL", [

    "host" => "",
    "port" => "",
    "user" => "",
    "passwd" => "",
    "from_name" => "",
    "from_email" => "",


]);

// face config

define("FACEBOOK_LOGIN", []);
// google config

define("GOOGLE_LOGIN", []);