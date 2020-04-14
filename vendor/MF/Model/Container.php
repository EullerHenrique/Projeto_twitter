<?php
    // Model/Container = Arquivo que contém scripts de inicialização
    // do framework, ou seja, as configurações iniciais do framework.

    // "Arquivo do programador que desenvolve a framework"

    //Arquivo Container = Requisito não funcional

    //Requisitos são solicitações, desejos, necessidades.
    //Requisito não funcional = Um requisito não funcional é aquele que descreve
    //como o sistema fará.

    namespace MF\Model;

    use App\Connection;

    class Container{

        //Objetivo da função: Retornar o modelo solicitado já instaciado,
        //inclusive com a conexão estabelecida
        public static function getModel($model){
            $class = "App\\Models\\".ucfirst($model);
            $conexao = Connection::getDb();

            //A instẫnciação feita por meio de uma variável contendo um namespace dispensa a utilidade do "use namespace"
            //Neste caso, o use não seria útil, já que a classe que será instanciada precisa ser armazenada em uma variável
            //para ser instanciada posteriormente, e variáveis contendo classes não conseguem ser instanciada.
            //Contudo, variáveis contendo namespaces conseguem ser instanciadas.

            return new $class($conexao);
        }
    }
?>