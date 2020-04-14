<?php
    //Connection = Arquivo que contém apenas as informações do projeto em questão,
    //ou seja, arquivo utilizado para o programador que irá utilizar o framework
    //inserir dados do seu projeto.

    // "Arquivo do programador que utiliza o framework"

    //Arquivo Route = Requisito funcional

    //Requisitos são solicitações, desejos, necessidades.
    //Requisito funcional = Um requisito funcional é a aquele que descreve
    // o que o sistema fará.

    namespace App;

    class Connection{

        //Atributos e metódos estáticos podem ser acessador sem que a classe precise ser instanciada
        public static function getDb(){
            try{
                $conexao = new \PDO(
                    "mysql:host=localhost;dbname=twitter;charset=utf8",
                    "euller",
                    "12345"
                );

                return $conexao;
            }catch (\PDOException $e){
                //.. Tratar de alguma forma .. //
                echo "A conexão com o banco de dados não foi estabelecida";
            }
        }
    }
?>