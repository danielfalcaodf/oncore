<?php
// site config
define("SITE", [

    "nome" => "OnCore",
    "desc" => "OnCore panel de admin para server de Linux ",
    "domain" => "localauth.com",
    "locale" => "pt_BR",
    "root" => "https://localhost/oncore"

]);
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

    "facebook_page" => "robsonvleite2",
    "facebook_author" => "robsonvleite",
    "facebook_appId" => "2193729837289",
    "twitter_creator" => "@robsonvleite",
    "twitter_site" => "@robsonvleite",


]);

// mail config

define("MAIL", [

    "host" => "smtp.sendgrid.net",
    "port" => "587",
    "user" => "apikey",
    "passwd" => "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",
    "from_name" => "Dev Jumbom",
    "from_email" => "devjumbom@dev.jumbom.com.br",


]);

// face config

define("FACEBOOK_LOGIN", []);
// google config

define("GOOGLE_LOGIN", []);