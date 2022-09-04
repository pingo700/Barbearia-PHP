<?php
class Admin
{
  public function __construct()
  {
    Transaction::open();
  }
  public function controller()
  {
    $inicio = new Template("view/login.html");
    $inicio->set("email", "");
    $inicio->set("password", "");
    $retorno["msg"] = $inicio->saida();
    return $retorno;
  }
  public function validar()
  {
    try {
      Transaction::get();
      $crud = new Crud();
      $retorno = $crud->select("usuario","*","NOME = '".$_POST["email"]."' AND SENHA = '".$_POST["password"]."'");
      if(!$retorno["erro"]){
       
        $tabela = new Template("view/admin.html");
        var_dump($tabela);
        echo "entrei";
        exit();
        //$tabela->set("linha", $retorno["msg"]);
         //$retorno["msg"] = $tabela->saida();
      }else{
        $retorno["msg"] = "<script>Swal.fire(
          'Error 500 !',
          'Usuário incorreto !',
          'question'
        )</script>";
        $retorno["erro"] = TRUE;
      }
    } catch (Exception $e) {
      $retorno["msg"] = "<script>Swal.fire(
        'Error 500 !',
        'Preencha todos os campos!',
        'question'
      )</script>";
      $retorno["erro"] = TRUE;
    }
    return $retorno;
  }

  public function sobre()
  {
    if (isset($_POST["sobre"]) ) {
        try {
          $conexao = Transaction::get();
          $sobre = $conexao->quote($_POST["sobre"]);
          $crud = new Crud();
          $retorno = $crud->update(
              "SOBRE",
              "TEXTO={$sobre}",
              "id=1"
            );
        } catch (Exception $e) {
          $retorno["msg"] = "Ocorreu um erro! " . $e->getMessage();
          $retorno["erro"] = TRUE;
        }
      } else {
        $retorno["msg"] = "<script>Swal.fire(
          'Error 500 !',
          'Preencha todos os campos!',
          'question'
        )</script>";
        $retorno["erro"] = TRUE;
      }
      return $retorno;
  }
  public function produtos()
  {
    if (isset($_POST["nome"]) && isset($_POST["preco"]) && isset($_POST["descricao"])) {
        try {
          $conexao = Transaction::get();
          $emissor = $conexao->quote($_POST["nome"]);
          $receptor = $conexao->quote($_POST["preco"]);
          $mensagem = $conexao->quote($_POST["descricao"]);
          $crud = new Crud();
          if (empty($_POST["id"])) {
            $retorno = $crud->insert(
              "produtos_venda_",
              "NOME,PRECO,DESCRICAO",
              "{$emissor},{$receptor},{$mensagem}"
            );
          } else {
            $id = $conexao->quote($_POST["id"]);
            $retorno = $crud->update(
              "produtos_venda_",
              "NOME={$emissor}, PRECO={$receptor}, DESCRICAO={$mensagem}",
              "id=1"
            );
          }
        } catch (Exception $e) {
          $retorno["msg"] = "Ocorreu um erro! " . $e->getMessage();
          $retorno["erro"] = TRUE;
        }
      } else {
        $retorno["msg"] = "<script>Swal.fire(
          'Error 500 !',
          'Preencha todos os campos!',
          'question'
        )</script>";
        $retorno["erro"] = TRUE;
      }
      return $retorno;
  }
  public function dados()
  {
     if (isset($_POST["colaboradores"]) && isset($_POST["produtos"]) && isset($_POST["anos"]) && isset($_POST["marcas"])) {
        try {
          $conexao = Transaction::get();
          $emissor = $conexao->quote($_POST["colaboradores"]);
          $receptor = $conexao->quote($_POST["produtos"]);
          $mensagem = $conexao->quote($_POST["anos"]);
          $marcas = $conexao->quote($_POST["marcas"]);
          $crud = new Crud();
          if (empty($_POST["id"])) {
            $retorno = $crud->insert(
              "dados",
              "COLABORADORES,MARCAS,PRODUTOS_EM_LINHA,ANOS",
              "{$emissor},{$marcas},{$receptor},{$mensagem}"
            );
          }
        } catch (Exception $e) {
          $retorno["msg"] = "Ocorreu um erro! " . $e->getMessage();
          $retorno["erro"] = TRUE;
        }
      } else {
        $retorno["msg"] = "<script>Swal.fire(
          'Error 500 !',
          'Preencha todos os campos!',
          'question'
        )</script>";
        $retorno["erro"] = TRUE;
      }
      return $retorno;
  }

  public function cadastro()
  {
        if (isset($_POST["email"]) && isset($_POST["senha"])) {
            try {
            $conexao = Transaction::get();
            $emissor = $conexao->quote($_POST["email"]);
            $receptor = $conexao->quote($_POST["senha"]);
            $crud = new Crud();
            if (empty($_POST["id"])) {
                $retorno = $crud->insert(
                "usuario",
                "NOME,SENHA",
                "{$emissor},{$receptor}"
                );
            } else {
                $id = $conexao->quote($_POST["id"]);
                $retorno = $crud->update(
                "usuario",
                "NOME={$emissor}, SENHA={$receptor}",
                "id=1"
                );
            }
            } catch (Exception $e) {
            $retorno["msg"] = "Ocorreu um erro! " . $e->getMessage();
            $retorno["erro"] = TRUE;
            }
        } else {
            $retorno["msg"] = "<script>Swal.fire(
              'Error 500 !',
              'Preencha todos os campos!',
              'question'
            )</script>";
            $retorno["erro"] = TRUE;
        }
        return $retorno;
    }

}