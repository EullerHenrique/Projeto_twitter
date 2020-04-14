<?php
    // Controller/Action = Arquivo que contém scripts de inicialização dos
    // Controllers do framework, ou seja,
    // as configurações iniciais dos Controllers.

    // "Arquivo do programador que desenvolve a framework"

    //Arquivo Action = Requisito não funcional

    //Requisitos são solicitações, desejos, necessidades.
    //Requisito não funcional = Um requisito não funcional é aquele que descreve
    // como o sistema fará.


    namespace MF\Controller;

    abstract class Action{
        protected $view;
        // view = layout + page

        public function __construct(){

            // / = (globalnamespace = namespace raiz do php) ou "use stdClass" ->
            // Deve-se utilizar global namespace ou "use..."  quando
            // algum namespace for definido no código (o namespace App/Controllers foi definido).

            // No contexto deste código, global namespaces se referem às classes nativas do php, por isso são globais,
            // ou seja, porque as classes podem ser utilizadas em qualquer script).

            //Se o globalnamespace ou "use stdClass" não for utilizado, a classe stdClass será procurada no namespace
            //MF/Controller. Como essa classe não está presente neste nameSpace, o php irá retornar um erro.


            //O global space ou o use é utilizado para permitir que uma classe nativa do php, ou seja,
            // uma classe global do php seja utilizada.

            $this->view = new \stdClass(); // \stdClass = permite a criação de um objeto vazio
        }


        //Se o layout informado existir, exibe o layout e chama a função content (essa chamada está dentro do layout)
        //Se o layout informado não existir, a função content é chamada
        protected function render($page, $layout='layout'){

            //Action.php é requerido em IndexController.php (é como se o código de Action.php estivesse
            //dentro de IndexController.php),
            //IndexController é requerido em index.php (é como se o código de IndexController estivesse
            //dentro de index.php), logo, o ponto de referência para
            //a navegação entre os arquivos é o index.php

            $this->view->page = $page;
            if(file_exists("../App/Views/".$layout.".phtml")){ // Verifica se o arquivo existe
                require_once "../App/Views/".$layout.".phtml";
            }else{
                $this->content();
            }

        }

        protected function content(){ //Exibe a página requerida

            //$view.phtml é requerido em IndexController.php (é como se o código de
            //index.php estivesse dentro de IndexControlle.php), logo, o atributo dados
            //é acessível em $view.phtml.

            $classAtual = get_class($this);
            $classAtual = str_replace('App\\Controllers\\','', $classAtual);
            $classAtual = strtolower(str_replace('Controller','', $classAtual));

            require_once "../App/Views/".$classAtual."/".$this->view->page.".phtml";
        }

    }



?>