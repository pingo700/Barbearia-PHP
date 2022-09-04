<?php 

class Ajax
{
  public function __construct()
  {
    Transaction::open();
  }

  public function controller()
  {

  }
  
  public function Comprar($dados)
  {
    if ($dados["ID"]) {
      try {
        $conexao = Transaction::get();
        $id = $conexao->quote($dados["ID"]));
        $crud = new Crud();
        $retorno = $crud->select("produtos_venda_","*","id = $dados["ID"]");
        insert($tabela = NULL, $campos = NULL, $valores = NULL)
        $retorno = $crud->insert("carrinho","total,id_produto","$RETORNO->PRECO,$RETORNO->id");
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
?>