<?php
    //AuthController = Arquivo que contém apenas as informações do projeto em questão, ou seja,
    //arquivo utilizado para o programador que irá utilizar o framework inserir dados do
    //seu projeto.

    // "Arquivo do programador que utiliza o framework"

    //Arquivo AuthController = Requisito funcional

    //Requisitos são solicitações, desejos, necessidades.
    //Requisito funcional = Um requisito funcional é a aquele que descreve
    // o que o sistema fará.


    namespace App\Controllers;

    //Recursos do miniframework (feitos pelo programador desenvolvedor)
    use MF\Controller\Action;
    use MF\Model\Container;

    class AuthController extends Action{

        public function autenticar(){

            //Intância a conexão ao banco de dados e o model
            $usuario = Container::getModel('Usuario');

            //Insere os dados no model
            $usuario->__set('email', $_POST['email']);
            $usuario->__set('senha',$_POST['senha']);

            //Válida o login

            //Sucesso
            if($usuario->autenticar_usuario()){
                session_start();
                $_SESSION['id'] = $usuario->__get('id');
                $_SESSION['nome'] = $usuario->__get('nome');
                header('Location: /timeline');
            }
            //Erro
            else{
               header('Location: /login?login_erro=erro'); //Redirecionamento para a página raiz
            }
        }

        public function sair(){
            session_start();
            session_destroy();

            header('Location: /');
        }
    }
?>