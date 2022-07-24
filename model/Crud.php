<?php
class Crud
{
  public function __construct()
  {
  }

  public function select($tabela = NULL, $campos = "*", $condicao = NULL)
  {
    try {
      if (!$tabela) {
        $retorno["msg"] = "Faltando parâmetro!";
        $retorno["erro"] = TRUE;
      } else {
        $conexao = Transaction::get();
        if (!$condicao) {
          $sql = "SELECT {$campos} FROM {$tabela}";
        } else {
          $sql = "SELECT {$campos} FROM {$tabela} WHERE {$condicao}";
        }
        $resultado = $conexao->query($sql);
        if ($resultado->rowCount() > 0) {
          while ($dados = $resultado->fetch(PDO::FETCH_ASSOC)) {
            $linhas[] = $dados;
          }
          $retorno["msg"] = $linhas;
          $retorno["erro"] = FALSE;
        } else {
          $retorno["msg"] = "<script>Swal.fire(
            'Resultado vazio !',
            'Nenhum registro encontrado!',
            'question'
          )</script>";
          $retorno["erro"] = TRUE;
        }
      }
    } catch (Exception $ex) {
      $retorno["msg"] = "Ocorreu um erro! " . $ex->getMessage();
      $retorno["erro"] = TRUE;
    }
    return $retorno;
  }

  public function insert($tabela = NULL, $campos = NULL, $valores = NULL)
  {
    try {
      if ($tabela && $campos && $valores) {
        $conexao = Transaction::get();
        $sql = "INSERT INTO {$tabela} ({$campos}) VALUES ({$valores}) ";
        $resultado = $conexao->query($sql);
        if ($resultado->rowCount() > 0) {
          $retorno["msg"] = "
          <script>Swal.fire(
            'Sucesso!',
            'Inserido com sucesso!!!',
            'success'
          )</script>
          ";
          $retorno["erro"] = FALSE;
          $retorno["id"] = $conexao->lastInsertId();
        } else {
          $retorno["erro"] = TRUE;
          $retorno["msg"] = "<script>Swal.fire(
            'Erro !',
            'Nenhum registro inserido!',
            'question'
          )</script>";
        }
      } else {
        $retorno["msg"] = "<script>Swal.fire(
          'Error 500 !',
          'Faltando parâmetro!',
          'question'
        )</script>";
        $retorno["erro"] = TRUE;
      }
    } catch (Exception $ex) {
      $retorno["msg"] = "Ocorreu um erro! " . $ex->getMessage();
      $retorno["erro"] = TRUE;
    }
    return $retorno;
  }

  public function update($tabela = NULL, $valores = NULL, $condicao = NULL)
  {
    try {
      if ($tabela && $valores && $condicao) {
        $conexao = Transaction::get();
        $sql = "UPDATE {$tabela} SET {$valores} WHERE {$condicao} ";
        $resultado = $conexao->query($sql);
        if ($resultado->rowCount() > 0) {
          $retorno["msg"] = "<script>Swal.fire(
            'Sucesso!',
            'Atualizado com sucesso!!!',
            'success'
          )</script>";
          $retorno["erro"] = FALSE;
        } else {
          $retorno["erro"] = TRUE;
          $retorno["msg"] = "<script>Swal.fire(
            'Erro !',
            'Nenhum registro atualizado!',
            'question'
          )</script>";
        }
      } else {
        $retorno["msg"] = "<script>Swal.fire(
          'Error 500 !',
          'Faltando parâmetro!',
          'question'
        )</script>";
        $retorno["erro"] = TRUE;
      }
    } catch (Exception $ex) {
      $retorno["msg"] = "Ocorreu um erro! " . $ex->getMessage();
      $retorno["erro"] = TRUE;
    }
    return $retorno;
  }

  public function delete($tabela = NULL, $condicao = NULL)
  {
    try {
      if ($tabela && $condicao) {
        $conexao = Transaction::get();
        $sql = "DELETE FROM {$tabela} WHERE {$condicao} ";
        $resultado = $conexao->query($sql);
        if ($resultado->rowCount() > 0) {
          $retorno["msg"] = "<script>Swal.fire(
            'Sucesso!',
            'Apagado com sucesso!!!',
            'success'
          )</script>";
          $retorno["erro"] = FALSE;
        } else {
          $retorno["erro"] = TRUE;
          $retorno["msg"] = "<script>Swal.fire(
            'Erro !',
            'Nenhum registro apagado!',
            'question'
          )</script>";
        }
      } else {
        $retorno["msg"] = "<script>Swal.fire(
          'Error 500 !',
          'Faltando parâmetro!',
          'question'
        )</script>";
        $retorno["erro"] = TRUE;
      }
    } catch (Exception $ex) {
      $retorno["erro"] = TRUE;
      $retorno["msg"] = "Ocorreu um erro! " . $ex->getMessage();
    }
    return $retorno;
  }
}