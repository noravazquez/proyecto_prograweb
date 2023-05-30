<?php
declare(strict_types=1);
require_once(__DIR__."/controllers/factura.php");

use PhpCfdi\CfdiToJson\JsonConverter;
require '../vendor/autoload.php';
$contents = file_get_contents('FITVII0000174731.xml');
$json = JsonConverter::convertToJson($contents);
echo "<pre>";
echo $json;

$cantidad = $factura->new($json);
echo $cantidad;
?>