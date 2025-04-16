<?php

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Content-Type");
header("Content-Type: application/json; charset=UTF-8");

include_once("../../config/db.php");

$input = json_decode(file_get_contents("php://input"), true);
