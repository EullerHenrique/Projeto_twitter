<?php
    //Route = Arquivo que contém apenas as informações do projeto em questão, ou seja,
    //arquivo utilizado para o programador que irá utilizar o framework inserir dados do
    //seu projeto.

    // "Arquivo do programador que utiliza o framework"

    //Arquivo Route = Requisito funcional

    //Requisitos são solicitações, desejos, necessidades.
    //Requisito funcional = Um requisito funcional é a aquele que descreve
                         // o que o sistema fará.


    namespace App;

    use MF\Init\Bootstrap;

    //Classe que define, obtém e executa as rotas

    // Rota = caminho, controller e action
    // Path = caminho

    class Route extends Bootstrap{

        //Define as rotas
        protected function initRoutes(){

            $routes['home'] = array(
                'route' => '/',
                'controller' => 'indexController',
                'action' => 'index'
            );

            $routes['login'] = array(
                'route' => '/login',
                'controller' => 'indexController',
                'action' => 'login'
            );

            $routes['inscreverse'] = array(
                'route' => '/inscreverse',
                'controller' => 'indexController',
                'action' => 'inscreverse'
            );

            $routes['registrar'] = array(
                'route' => '/registrar',
                'controller' => 'indexController',
                'action' => 'registrar'
            );

            $routes['autenticar'] = array(
                'route' => '/autenticar',
                'controller' => 'AuthController',
                'action' => 'autenticar'
            );

            $routes['timeline'] = array(
                'route' => '/timeline',
                'controller' => 'AppController',
                'action' => 'timeline'
            );

            $routes['sair'] = array(
                'route' => '/sair',
                'controller' => 'AuthController',
                'action' => 'sair'
            );

            $routes['tweet'] = array(
                'route' => '/tweet',
                'controller' => 'AppController',
                'action' => 'tweet'
            );

            $routes['remover_tweet'] = array(
                'route' => '/remover_tweet',
                'controller' => 'AppController',
                'action' => 'remover_tweet'
            );

            $routes['quem_seguir'] = array(
                'route' => '/quem_seguir',
                'controller' => 'AppController',
                'action' => 'quem_seguir'
            );

            $routes['pesquisar'] = array(
                'route' => '/pesquisar',
                'controller' => 'AppController',
                'action' => 'pesquisar'
            );

            $routes['reload_pesquisa'] = array(
                'route' => '/reload_pesquisa',
                'controller' => 'AppController',
                'action' => 'reload_pesquisa'
            );

            $routes['acao'] = array(
                'route' => '/acao',
                'controller' => 'AppController',
                'action' => 'acao'
            );

            $routes['salvar_arquivo_do_perfil'] = array(
                'route' => '/salvar_arquivo_do_perfil',
                'controller' => 'AppController',
                'action' => 'salvar_arquivo_do_perfil'
            );

            $routes['remover_arquivo_do_perfil'] = array(
                'route' => '/remover_arquivo_do_perfil',
                'controller' => 'AppController',
                'action' => 'remover_arquivo_do_perfil'
            );


            $this->setRoutes($routes);
        }

    }

?>