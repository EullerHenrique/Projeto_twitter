<?php
    //Upload = Arquivo que contém apenas as informações do projeto em questão, ou seja,
    //arquivo utilizado para o programador que irá utilizar o framework inserir dados do
    //seu projeto.

    // "Arquivo do programador que utiliza o framework"

    //Arquivo Upload = Requisito funcional

    //Requisitos são solicitações, desejos, necessidades.
    //Requisito funcional = Um requisito funcional é a aquele que descreve
    // o que o sistema fará.

namespace App\Models;

use MF\Model\Model;

class Upload extends Model{
    private $id_usuario;
    private $nome_arquivo;

    public function __set($atributo, $valor){
        $this->$atributo = $valor;
    }

    public function __get($atributo){
        return $this->$atributo;
    }

    function upload_arquivo($arquivo, $pasta){

        //Define os tipos permitidos
        $tipos[0]=".gif";
        $tipos[1]=".jpg";
        $tipos[2]=".jpeg";
        $tipos[3]=".png";

        if(!empty($arquivo['name'])) {
            $nomeOriginal = $arquivo["name"];
            $nomeFinal = md5($nomeOriginal.date("dmYHis"));
            $tipo = strrchr($arquivo["name"], ".");
            $tamanho = $arquivo['size'];
            $tamanhoMaximo = 1024 * 1024 * 2; //2mb

            $arquivoPermitido = false;

            for ($i = 0; $i < count($tipos); $i++) {
                if ($tipos[$i] == $tipo) {
                    $arquivoPermitido = true;
                }
            }

            if ($arquivoPermitido == false) {
                return "1";
            } else if ($tamanho > $tamanhoMaximo) {
                return "2";
            }else if (move_uploaded_file($arquivo["tmp_name"], $pasta.$nomeFinal.$tipo)) {
                $this->nome_arquivo = $nomeFinal.$tipo;
            }else {
                return "3";
            }
        }else{
            return "4";
        }
    }

    function remover_arquivo($nome_arquivo_final,$pasta){

        unlink("$pasta$nome_arquivo_final"); //Remove um arquivo

    }
}
?>