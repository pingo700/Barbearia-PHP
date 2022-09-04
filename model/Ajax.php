<?php 

ini_set('display_errors', 1);
ini_set('display_startup_erros', 1);
error_reporting(E_ALL);

if(isset($_REQUEST["COMPRAR"])){
  $Ajax = new Ajax();
  $resultado = $Ajax->Comprar($_REQUEST);
  echo json_encode($resultado, JSON_UNESCAPED_UNICODE);
  header('Content-Type: application/json; charset=utf-8');
}


?>