<?php

    //AppController = Arquivo que contém apenas as informações do projeto em questão, ou seja,
    //arquivo utilizado para o programador que irá utilizar o framework inserir dados do
    //seu projeto.

    // "Arquivo do programador que utiliza o framework"

    //Arquivo AppController = Requisito funcional

    //Requisitos são solicitações, desejos, necessidades.
    //Requisito funcional = Um requisito funcional é a aquele que descreve
    // o que o sistema fará.


    namespace App\Controllers;

    //Recursos do miniframework (feitos pelo programador desenvolvedor)
    use MF\Controller\Action;
    use MF\Model\Container;

    class AppController extends Action{

        public function verificaAutentificacao(){
            if(!isset($_SESSION['id']) || $_SESSION['id'] == '' || !isset($_SESSION['nome']) || $_SESSION['nome'] == ''){
                //A página/script se torna restrita, ou seja, o usuário tem que se logar pela primeira vez

                header('Location: /login?login_erro=erro2');
            }
        }

        public function timeline(){
            session_start();

            //Verifica se a autentificação já foi realizada
            $this->verificaAutentificacao();

                //A página timeline se torna acessível, ou seja, o usuário não tem que se logar de novo

                    //Tweet

                    //Intância a conexão ao banco de dados e o model Tweet
                    $tweet = Container::getModel('Tweet');

                    //Insere no model Tweet o id que será pesquisado no banco de dados
                    $tweet->__set('id_usuario', $_SESSION['id']);

                    //Recupera os tweets do id especificado
                    $tweets = $tweet->obter_tweets();


                    //Usuário

                    //Intância a conexão ao banco de dados e o model Usuario
                    $usuario = Container::getModel('Usuario');

                    //Insere no model Usuario o id que será pesquisado no banco de dados
                    $usuario->__set('id', $_SESSION['id']);


                    //Sets no objeto view

                    //Insere os tweets no atributo tweets do objeto view pertencente a classe Action
                    $this->view->tweets = $tweets;
                    $this->view->info_usuario = $usuario->obter_usuario();
                    $this->view->qtd_tweets_usuario = $usuario->obter_qtd_tweets_usuario();
                    $this->view->qtd_seguindo_usuario = $usuario->obter_qtd_seguindo_usuario();
                    $this->view->qtd_seguidores_usuario = $usuario->obter_qtd_seguidores_usuario();
                    $this->view->erro_arquivo_tweet =  isset($_SESSION['erro_arquivo_tweet'])? $_SESSION['erro_arquivo_tweet']:'';
                    $this->view->erro_arquivo_usuario =  isset($_SESSION['erro_arquivo_usuario'])? $_SESSION['erro_arquivo_usuario']:'';
                    unset($_SESSION['erro_arquivo_tweet']);
                    unset($_SESSION['erro_arquivo_usuario']);

                    $_SESSION['flag'] = 1;
                    $this->render('timeline');
        }

        public function quem_seguir(){
            session_abort();
            session_start();

            //Verifica se a autentificação já foi realizada
            $this->verificaAutentificacao();

            $pesquisar = isset($_SESSION['pesquisar'])? $_SESSION['pesquisar']:'';

            $usuarios = array();

            //Usúario

            //Intância a conexão ao banco de dados e o model
            $usuario = Container::getModel('Usuario');

            //Insere no model o id do usuário seguidor
            $usuario->__set('id', $_SESSION['id']);

                if($pesquisar != '') {

                    //Insere no model o nome que será pesquisado no banco de dados
                    $usuario->__set('nome', "@".$pesquisar);

                    //Recupera os usuários com o nome especificado
                    //e
                    //os usuários que começam com o nome especificado
                    $usuarios = $usuario->obter_usuarios();

                }else if($pesquisar == ''){

                    //Insere no model o nome "@" para pesquisar todos os nomes presentes no banco de dados
                    $usuario->__set('nome', "@");

                    //Recupera os usuários que começam com o nome especificado
                    $usuarios = $usuario->obter_usuarios();


                }

                //Sets no objeto view

                //Insere os usuarios no atributo usuarios do objeto view pertencente a classe Action
                $this->view->usuarios = $usuarios;
                $this->view->info_usuario = $usuario->obter_usuario();
                $this->view->qtd_tweets_usuario = $usuario->obter_qtd_tweets_usuario();
                $this->view->qtd_seguindo_usuario = $usuario->obter_qtd_seguindo_usuario();
                $this->view->qtd_seguidores_usuario = $usuario->obter_qtd_seguidores_usuario();
                $this->view->erro_arquivo_tweet =  isset($_SESSION['erro_arquivo_tweet'])? $_SESSION['erro_arquivo_tweet']:'';
                $this->view->erro_arquivo_usuario =  isset($_SESSION['erro_arquivo_usuario'])? $_SESSION['erro_arquivo_usuario']:'';
                unset($_SESSION['erro_arquivo_tweet']);
                unset($_SESSION['erro_arquivo_usuario']);

                $_SESSION['flag'] = 2;

                $this->render('quem_seguir');

            }

        public function pesquisar(){

            session_start();

            //Verifica se a autentificação já foi realizada
            $this->verificaAutentificacao();

            $_SESSION['pesquisar'] = isset($_GET['pesquisar']) ? trim($_GET['pesquisar']) : '';

            header('Location: quem_seguir');

        }

        public function acao(){
            session_start();

            $this->verificaAutentificacao();

            $acao = isset($_GET['acao'])? $_GET['acao']: '';
            $id_usuario_seguidor = $_SESSION['id'];
            $id_usuario_seguido = isset($_GET['id_usuario_seguido'])? $_GET['id_usuario_seguido']: '';

            //Intância a conexão ao banco de dados e o model
            $usuario = Container::getModel('Usuario');

            //Insere no model o id do usuário seguidor
            $usuario->__set('id',$id_usuario_seguidor);

            if($acao == 'seguir'){
                $usuario->seguir_usuario($id_usuario_seguido);
            }else if($acao == 'deixar_de_seguir'){
                $usuario->deixar_de_seguir_usuario($id_usuario_seguido);
            }

            header('Location: reload_pesquisa?pesquisar='.$_SESSION['pesquisar']);

        }

        public function reload_pesquisa(){

            session_start();

            //Verifica se a autentificação já foi realizada
            $this->verificaAutentificacao();


            $_SESSION['pesquisar'] = $_GET['pesquisar'];

            header('Location: quem_seguir');
        }

            public function salvar_arquivo_do_perfil(){

                session_start();

                //Verifica se a autentificação já foi realizada
                $this->verificaAutentificacao();

                //Intância a conexão ao banco de dados e o model
                $usuario = Container::getModel('Usuario');

                //Insere no model o id do usuário que realizou o upload
                $usuario->__set('id',  $_SESSION['id']);

                //Realiza o upload do arquivo
                //Intância a conexão ao banco de dados e o model
                $upArquivo = Container::getModel('Upload');

                //Realiza o upload do arquivo
                $erro = $upArquivo->upload_arquivo($_FILES['arquivo'], "IMG/");

                //Insere o nome do arquivo no banco de dados, ou seja, atualiza o banco de dados
                $usuario->__set('nome_arquivo_usuario', $upArquivo->__get('nome_arquivo'));
                $usuario->editar_usuario();

                $_SESSION['erro_arquivo_usuario'] = $erro;

                if($_SESSION['flag'] == 1) {
                    //Exibe a página timeline
                    header('Location: timeline');
                }else if($_SESSION['flag'] == 2){
                    //Exibe a página quem seguir
                    header('Location: quem_seguir');
                }
            }

        function remover_arquivo_do_perfil(){
            session_start();

            $this->verificaAutentificacao();

            //Intância a conexão ao banco de dados e o model Usuario
            $usuario = Container::getModel('Usuario');

            //Obtém do banco de dados os dados do usuário com o id em questão
            $usuario->__set('id',  $_SESSION['id']);
            $dados_usuario = $usuario->obter_usuario();

            echo $_SESSION['id'];
            print_r($dados_usuario);

            //Intância a conexão ao banco de dados e o model Upload
            $arquivo = Container::getModel('Upload');

            //Remove o arquivo
            $arquivo->remover_arquivo($dados_usuario['nome_arquivo_usuario'], "IMG/");

            //Remove o nome do arquivo do banco de dados
            $usuario->__set('nome_arquivo_usuario', '');
            $usuario->editar_usuario();

            if($_SESSION['flag'] == 1) {
                //Exibe a página timeline
                header('Location: timeline');
            }else if($_SESSION['flag'] == 2){
                //Exibe a página quem seguir
                header('Location: quem_seguir');
            }
        }

        public function tweet(){
            session_start();

            //Verifica se a autentificação já foi realizada
            $this->verificaAutentificacao();

            //O script tweet se torna acessível, com isso o tweet é registrado

            //Intância a conexão ao banco de dados e o model
            $tweet = Container::getModel('Tweet');

            //Caso exista, salva o nome do arquivo inserido no tweet no banco de dados
            if(!empty($_FILES['arquivo']['name'])){

                //Intância a conexão ao banco de dados e o model
                $upArquivo = Container::getModel('Upload');

                //Realiza o upload do arquivo
                $erro = $upArquivo->upload_arquivo($_FILES['arquivo'], "IMG/");

                $_SESSION['erro_arquivo_tweet'] = $erro;

                $tweet->__set('nome_arquivo_tweet', $upArquivo->__get('nome_arquivo'));
            };

            //Insere os dados no model
            $tweet->__set('tweet', $_POST['tweet']);
            $tweet->__set('id_usuario', $_SESSION['id']);

            //Salva os dados do model no banco de dados
            $tweet->salvar_tweet();

            //Exibe a página timeline
            header('Location: timeline');
        }

        public function remover_tweet(){
            session_start();

            //Verifica se a autentificação já foi realizada
            $this->verificaAutentificacao();

            //O script tweet se torna acessível, com isso o tweet é registrado

            //Intância a conexão ao banco de dados e o model
            $tweet = Container::getModel('Tweet');

            //Insere o id do tweet que será removido no model
            $tweet->__set('id', $_GET['id']);

            //Obtém o nome do arquivo do tweet com o id em questão
            $nome_arquivo_tweet = $tweet->obter_nome_arquivo_tweet();

            //Caso o tweet possua um arquivo, o arquivo é removido da pasta IMG
            $this->remover_arquivo_do_tweet($nome_arquivo_tweet['nome_arquivo_tweet'], "IMG/");

            //Remove o tweet do banco de dados
            $tweet->remover_tweet();

            //Exibe a página timeline
            header('Location: timeline');
        }

        function remover_arquivo_do_tweet($nome_arquivo, $pasta){
            session_abort();
            session_start();

            $this->verificaAutentificacao();

            //Intância a conexão ao banco de dados e o model
            $arquivo = Container::getModel('Upload');

            //Remove o arquivo
            $arquivo->remover_arquivo($nome_arquivo, $pasta);

        }




    }

?>