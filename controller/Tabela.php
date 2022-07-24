<?php
class Tabela
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
      $retorno = $crud->select("produtos_venda_");
      if (!$retorno["erro"]) {
        $tabela = new Template("view/form.html");
        $tabela->set("linha", $retorno["msg"]);
        $retorno["msg"] = $tabela->saida();
      }
    } catch (Exception $e) {
      $retorno["msg"] = "Ocorreu um erro! " . $e->getMessage();
      $retorno["erro"] = TRUE;
    }
    return $retorno;
  }

  public function remover()
  {
    if ($_GET["id"]) {
      try {
        $conexao = Transaction::get();
        $id = $conexao->quote($_GET["id"]);
        $crud = new Crud();
        $retorno = $crud->delete(
          "mensagens",
          "id={$id}"
        );
      } catch (Exception $e) {
        $retorno["msg"] = "Ocorreu um erro! " . $e->getMessage();
        $retorno["erro"] = TRUE;
      }
    } else {
      $retorno["msg"] = "<script>Swal.fire(
        'Error 500 !',
        'Faltando parâmetro!',
        'question'
      )</script>";
      $retorno["erro"] = TRUE;
    }
    return $retorno;
  }

  public function editar()
  {
    if (isset($_GET["id"])) {
      try {
        $conexao = Transaction::get();
        $id = $conexao->quote($_GET["id"]);
        $crud = new Crud();
        $retorno = $crud->select(
          "produtos",
          "*",
          "id={$id}"
        );
        if (!$retorno["erro"]) {
          $form = new Template("view/form.html");
          foreach ($retorno["msg"][0] as $key => $value) {
            $form->set($key, $value);
          }
          $retorno["msg"] = $form->saida();
        }
      } catch (Exception $e) {
        $retorno["msg"] = "Ocorreu um erro! " . $e->getMessage();
        $retorno["erro"] = TRUE;
      }
    } else {
      $retorno["msg"] = "<script>Swal.fire(
        'Error 500 !',
        'Faltando parâmetro!',
        'question'
      )</script>";
      $retorno["erro"] = TRUE;
    }
    return $retorno;
  }

  public function __destruct()
  {
    Transaction::close();
  }
}