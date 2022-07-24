<?php
class Inicio
{
  public function __construct()
  {
    Transaction::open();
  }
  public function controller()
  {
    Transaction::get();
    $crud = new Crud();
    $retorno = $crud->select("produtos_venda_");
    $retorno2 = $crud->select("dados");
    $tabela = new Template("view/produtos.html");
    $tabela->set("dados", $retorno2["msg"]);
    $tabela->set("linha", $retorno["msg"]);
    $retorno["msg"] = $tabela->saida();
    return $retorno;
  }
}