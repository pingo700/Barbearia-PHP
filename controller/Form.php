<?php
class Form
{
  public function __construct()
  {
    Transaction::open();
  }
  public function controller()
  {
    try {
      Transaction::get();
      $crud = new Crud();
      $retorno = $crud->select("sobre");
      if (!$retorno["erro"]) {
        $tabela = new Template("view/sobre.html");
        $tabela->set("linha", $retorno["msg"]);
        $retorno["msg"] = $tabela->saida();
      }
    } catch (Exception $e) {
      $retorno["msg"] = "Ocorreu um erro! " . $e->getMessage();
      $retorno["erro"] = TRUE;
    }
    return $retorno;
  }

  public function __destruct()
  {
    Transaction::close();
  }
}