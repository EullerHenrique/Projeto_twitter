<?php
    //IndexController = Arquivo que contém apenas as informações do projeto em questão, ou seja,
    //arquivo utilizado para o programador que irá utilizar o framework inserir dados do
    //seu projeto.

    // "Arquivo do programador que utiliza o framework"

    //Arquivo IndexController = Requisito funcional

    //Requisitos são solicitações, desejos, necessidades.
    //Requisito funcional = Um requisito funcional é a aquele que descreve
    // o que o sistema fará.


    namespace App\Controllers;

    //Recursos do miniframework (feitos pelo programador desenvolvedor)
    use MF\Controller\Action;
    use MF\Model\Container;

    class IndexController extends Action{

        //Actions
        public function index(){
            session_abort();
            session_start();

            //Se a variavel login não estiver vazia, exibe mensagem de erro
            //Caso contrário, a mensagem de erro não é exibida
            $this->view->login = isset($_SESSION['login_erro'])? $_SESSION['login_erro']:'';
            session_destroy();
            $this->render('index');
        }

        public function login(){
            session_start();

            //Se a variavel login não estiver vazia, exibe mensagem de erro
            //Caso contrário, a mensagem de erro não é exibida
            $_SESSION['login_erro'] = isset($_GET['login_erro']) ? $_GET['login_erro'] : '';
            header('Location: /');
        }

        public function inscreverse(){
            //Os campos nome, email e senha são limpos
            $this->view->usuario = array(
                'nome' => '',
                'email' => '',
                'senha' => ''
            );

            $this->view->erroCadastro = false;
            $this->render('inscreverse');
        }

        public function registrar(){

            //Intância a conexão ao banco de dados e o model
            $usuario = Container::getModel('Usuario');

            //Insere os dados no model
            $usuario->__set('nome',  isset($_POST['nome'])? $_POST['nome']: '');
            $usuario->__set('email',  isset($_POST['email'])? $_POST['email']: '');
            $usuario->__set('senha',  isset($_POST['senha'])? $_POST['senha']: '');

            //Salva os dados do model no banco de dados

            //Sucesso
            if ($usuario->validarCadastro()) {

                //Função criptográfica  argon2id:
                //      - Sua criptográfia é unidirecional, ou seja, não é possível reverter.
                //      - É a mais segura atualmente
                //      - Disponível a partir do php 7.3
                //      - Converte uma string para um código hash de 98 caracteres.

                //Hash -> Um hash é uma sequência de bits geradas por um algoritmo de dispersão,
                //        em geral representada em base hexadecimal. Tal sequência de bits geralmente
                //        é utilizada para garantir a integridade de um dado.
                //        Ao utilizar um código hash como uma senha, ele irá garantir a integridade,
                //        o sigilo e a disponibilidade dos dados.

                $usuario->__set('senha', password_hash($_POST['senha'], PASSWORD_ARGON2ID));

                if ($usuario->salvar_usuario()) {
                    $this->render('cadastro');
                } //Erro
                else {
                    //Os dados são reinseridos na página para facilitar a correção do erro
                    $this->view->usuario = array(
                        'nome' =>  isset($_POST['nome'])? $_POST['nome']: '',
                        'email' =>  isset($_POST['email'])? $_POST['email']: '',
                        'senha' =>  isset($_POST['senha'])? $_POST['senha']: ''
                    );
                    $this->view->erroCadastro = "erro2";
                    $this->render('inscreverse');
                }
            }else{
                //Os dados são reinseridos na página para facilitar a correção do erro
                $this->view->usuario = array(
                    'nome' => isset($_POST['nome'])? $_POST['nome']: '',
                    'email' =>  isset($_POST['nome'])? $_POST['email']: '',
                    'senha' =>  isset($_POST['nome'])? $_POST['senha']: ''
                );
                $this->view->erroCadastro = "erro1";
                $this->render('inscreverse');

            }

        }
    }
?>