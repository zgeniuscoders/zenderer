<?php

use Zgeniuscoders\Zenderer\Zenderer\Zenderer;



include "./vendor/autoload.php";


$hello = "hello world b";

$render = new Zenderer();
$render->renderer("accueil.php",[
    "hello" => $hello,
    "hello_a" => "1234",
    "age" => 10
]);
