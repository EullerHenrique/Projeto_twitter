<?php
    // Init/Bootstrap = Arquivo que contém scripts de inicialização
    // do framework, ou seja, as configurações iniciais do framework.

    // "Arquivo do programador que desenvolve a framework"

    //Arquivo Bootstrap = Requisito não funcional

    //Requisitos são solicitações, desejos, necessidades.
    //Requisito não funcional = Um requisito não funcional é aquele que descreve
                             // como o sistema fará.

    namespace MF\Init;

    //Uma classe abstrata não pode ser instanciada, pode ser apenas herdada
    //Métodos abstratos devem ser obrigatoriamente implementados na classe filha.


    abstract class Bootstrap{
        private $routes;

        abstract protected function initRoutes();

        public function __construct(){
            $this->initRoutes();
            $this->run($this->getUrl());
        }

        public function setRoutes(array $routes){
            $this->routes = $routes;
        }

        public function getRoutes(){
            return $this->routes;
        }


        //Visibilidade do protected = O pacote atual e subclasses

        //Obtém a rota atual
        protected function getUrl(){

            //$_SERVER = super global que contém todas as infomações sobre o servidor atual


            //REQUEST_URI = Identifica o recurso no qual aplicar a solicitação

            //URI = Identificador de recurso universal (URL + URN)
            //URL = Localizador de recurso universal
            //URN = Nome de recurso universal



            // parse_url = Retorna os componetentes da URL
            // PHP_URL_PATH = Faz com que o retorno seja apenas o componente PATH
            // PATH = Caminho para o recurso, ou seja, a localização do recurso
            // / = raiz

            //ex:
            //return parse_url("www.google.com/gmail?x=10");
            //PATH = URL
            //QUERY = x=10
            return parse_url($_SERVER['REQUEST_URI'],PHP_URL_PATH);

        }

        //Visibilidade do protected = O pacote atual e subclasses

        //Executa a rota atual
        protected function run($url){
            foreach ($this->getRoutes() as $key => $route){
                if($url == $route['route']){//Ex: / == /
                    // ucfirst() = Torna a primeira letra da string maiúscula
                    // "\\" = \

                    $class = "App\\Controllers\\".ucfirst($route['controller']);
                    $controller = new $class; // Ex: App\Controllers\IndexController

                    $action = $route['action']; // Ex: $route['action'] = index
                    $controller->$action(); //Ex: IndexController->index();

                }
            }
        }


    }





?>