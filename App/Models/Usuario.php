<?php

    //Usuario = Arquivo que contém apenas as informações do projeto em questão, ou seja,
    //arquivo utilizado para o programador que irá utilizar o framework inserir dados do
    //seu projeto.

    // "Arquivo do programador que utiliza o framework"

    //Arquivo Usuario = Requisito funcional

    //Requisitos são solicitações, desejos, necessidades.
    //Requisito funcional = Um requisito funcional é a aquele que descreve
    // o que o sistema fará.

    namespace App\Models;

    use MF\Model\Model;

    class Usuario extends Model{
        private $id;
        private $nome;
        private $email;
        private $senha;
        private $nome_arquivo_usuario;

        public function __set($atributo, $valor){
            $this->$atributo = $valor;
        }

        public function __get($atributo){
            return $this->$atributo;
        }


        //Validar se um cadastro pode ser feito
        public function validarCadastro(){
            $valido = true;

            if (trim($this->__get('nome')) == '') {
                $valido = false;
            }
            // filter_var($this->__get('email'),FILTER_VALIDATE_EMAIL) = Determina se o email é valido de acordo com o
            // formato nome@dominio (ex: outlook.com)

            if (!filter_var(trim($this->__get('email')), FILTER_VALIDATE_EMAIL)) {
                $valido = false;
            }
            if (strlen(trim($this->__get('senha'))) < 3) {
                $valido = false;
            }

            return $valido;
        }

        //Verifica se o usuário não está presente no banco de dados
        public function verificar_bd(){
            $query = "SELECT nome, email                         
                      FROM 
                             usuarios 
                      WHERE 
                            nome = :nome
                      OR
                            email = :email";

            // PDO STATEMENT ( declaração PDO )
            // Representa uma query não executada e, após a execução da instrução,
            // um conjunto de resultados associado.

            //Preparação da query
            //A query não é executada, o metódo prepare somente retorna um pdo statement com a query não
            //executada como valor do atributo "queryString".
            $stmt = $this->db->prepare($query);

            //Validação dos dados digitados pelo usuário que serão inseridos na query
            //Se os dados forem comandos sql, bindValue(vincular valor) não permite que a inserção seja feita
            //OBS: Se tiver algum numero antes do sql injection, bindvalue irá inserir tais números na query
            //Caso contrário a inserção é feita normalmente

            $stmt->bindValue(":nome", "@".$this->__get("nome"));
            $stmt->bindValue(":email", $this->__get("email"));

            //Executa a query válida
            $stmt->execute();


            //  fetch = Busca o primeiro registro no PDO STATEMENT (query associada aos resultados da consulta)
            //  Ou seja, o fetch obtém o primeiro resultado da consulta e armazena esse resultado em um array.
            //          Retorna o registro obtido na consulta com o filtro do fetch aplicado
            //  Filtros:
            //          PDO:FETCH_ASSOC = indices associativos
            //          PDO:FETCH_NUM = indices numericos
            //          PDO:FETCH_BOTH = ambos os indices (Padrão)
            //          PDO:FETCH_OBJ = array de objetos

            $retorno = $stmt->fetch(\PDO::FETCH_ASSOC);

            return $retorno;
        }


        //Salva o usuário no banco de dados
        public function salvar_usuario(){
                if (empty($this->verificar_bd())) {

                    $query = "INSERT INTO usuarios(nome, email, senha) VALUES (:nome, :email, :senha);";

                    // PDO STATEMENT ( declaração PDO )
                    // Representa uma query não executada e, após a execução da instrução,
                    // um conjunto de resultados associado.

                    //Preparação da query
                    //A query não é executada, o metódo prepare somente retorna um pdo statement com a query não
                    //executada como valor do atributo "queryString".
                    $stmt = $this->db->prepare($query);

                    //Validação dos dados digitados pelo usuário que serão inseridos na query
                    //Se os dados forem comandos sql, bindValue(vincular valor) não permite que a inserção seja feita
                    //OBS: Se tiver algum numero antes do sql injection, bindvalue irá inserir tais números na query
                    //Caso contrário a inserção é feita normalmente

                    $stmt->bindValue(":nome", "@" . trim($this->__get("nome")));
                    $stmt->bindValue(":email", trim($this->__get("email")));
                    $stmt->bindValue(":senha", trim($this->__get("senha")));

                    //Executa a query válida
                    $stmt->execute();


                    return true;
                }
                return false;
            }

            //Atualiza algum dado de um usuário
            function editar_usuario(){
                $query = "UPDATE usuarios SET nome_arquivo_usuario = :nome_arquivo_usuario WHERE id = :id;";

                // PDO STATEMENT ( declaração PDO )
                // Representa uma query não executada e, após a execução da instrução,
                // um conjunto de resultados associado.

                //Preparação da query
                //A query não é executada, o metódo prepare somente retorna um pdo statement com a query não
                //executada como valor do atributo "queryString".
                $stmt = $this->db->prepare($query);

                //Validação dos dados digitados pelo usuário que serão inseridos na query
                //Se os dados forem comandos sql, bindValue(vincular valor) não permite que a inserção seja feita
                //OBS: Se tiver algum numero antes do sql injection, bindvalue irá inserir tais números na query
                //Caso contrário a inserção é feita normalmente
                $stmt->bindValue(":id", $this->__get("id"));
                $stmt->bindValue(":nome_arquivo_usuario", $this->__get("nome_arquivo_usuario"));

                //Executa a query válida
                $stmt->execute();

            }

        //Válida o login realizado
        public function autenticar_usuario(){

            // PDO STATEMENT ( declaração PDO )
            // Representa uma query e, após a execução da instrução,
            // um conjunto de resultados associado.

            $query = "SELECT id, nome, senha FROM usuarios WHERE email = :email";

            //Preparação da query
            //A query não é executada, o metódo prepare somente retorna um pdo statement com a query não
            //executada como valor do atributo "queryString".
            $stmt = $this->db->prepare($query);

            //Validação dos dados digitados pelo usuário que serão inseridos na query
            //Se os dados forem comandos sql, bindValue(vincular valor) não permite que a inserção seja feita
            //OBS: Se tiver algum numero antes do sql injection, bindvalue irá inserir tais números na query
            //Caso contrário a inserção é feita normalmente
            $stmt->bindValue(':email', trim($this->__get('email')));

            //Executa a query válida
            $stmt->execute();

            //  fetch = Busca o primeiro registro no PDO STATEMENT (query associada aos resultados da consulta)
            //  Ou seja, o fetch obtém o primeiro resultado da consulta e armazena esse resultado em um array.
            //          Retorna o registro obtido na consulta com o filtro do fetch aplicado
            //  Filtros:
            //          PDO:FETCH_ASSOC = indices associativos
            //          PDO:FETCH_NUM = indices numericos
            //          PDO:FETCH_BOTH = ambos os indices (Padrão)
            //          PDO:FETCH_OBJ = array de objetos

            $usuario = $stmt->fetch(\PDO::FETCH_ASSOC);

            //Validação de login

            //Sucesso
            if (password_verify($this->__get('senha'), $usuario['senha'])) {

                //Após extrair os dados do banco de dados,
                //Insere-se o nome e o id no model

                $this->__set('id', $usuario['id']);
                $this->__set('nome', $usuario['nome']);
                return true;
            } //Erro
            else {
                return false;
            }

        }

        //Recupera a informação de um usuário
        public function obter_usuario(){
            $query = "SELECT nome, email, nome_arquivo_usuario from usuarios where id = :id";

            // PDO STATEMENT ( declaração PDO )
            // Representa uma query não executada e, após a execução da instrução,
            // um conjunto de resultados associado.

            //Preparação da query
            //A query não é executada, o metódo prepare somente retorna um pdo statement com a query não
            //executada como valor do atributo "queryString".
            $stmt = $this->db->prepare($query);

            //Validação dos dados digitados pelo usuário que serão inseridos na query
            //Se os dados forem comandos sql, bindValue (vincular valor) não permite que a inserção seja feita
            //OBS: Se tiver algum numero antes do sql injection, bindvalue irá inserir tais números na query
            //Caso contrário a inserção é feita normalmente

            $stmt->bindValue(":id", $this->__get("id"));

            //Executa a query válida
            $stmt->execute();

            //  fetch = Busca o primeiro registro no PDO STATEMENT (query associada aos resultados da consulta)
            //  Ou seja, o fetch obtém o primeiro resultado da consulta e armazena esse resultado em um array.
            //          Retorna o registro obtido na consulta com o filtro do fetch aplicado
            //  Filtros:
            //          PDO:FETCH_ASSOC = indices associativos
            //          PDO:FETCH_NUM = indices numericos
            //          PDO:FETCH_BOTH = ambos os indices (Padrão)
            //          PDO:FETCH_OBJ = array de objetos

            $usuario = $stmt->fetch(\PDO::FETCH_ASSOC);

            return $usuario;
        }


        //Recupera do banco de dados todos os usuarios
        public function obter_usuarios(){
            $query = "
                    SELECT
                        u.id,
                        u.nome,
                        u.email,
                        u.nome_arquivo_usuario,
                        (                 ##Subquery
                            SELECT 
                                COUNT(*) 
                            FROM
                                usuarios_seguidores as us
                            WHERE 
                                us.id_usuario_seguidor = :id_usuario_autenticado
                                AND
                                us.id_usuario_seguido = u.id
                        ) as seguido_s_1_n_0    
                    
                      FROM
                           usuarios as u
                      WHERE
                            u.nome LIKE :nome
                            AND
                            u.id != :id_usuario_autenticado
                       ";

            // PDO STATEMENT ( declaração PDO )
            // Representa uma query não executada e, após a execução da instrução,
            // um conjunto de resultados associado.

            //Preparação da query
            //A query não é executada, o metódo prepare somente retorna um pdo statement com a query não
            //executada como valor do atributo "queryString".
            $stmt = $this->db->prepare($query);

            //Validação dos dados digitados pelo usuário que serão inseridos na query
            //Se os dados forem comandos sql, bindValue (vincular valor) não permite que a inserção seja feita
            //OBS: Se tiver algum numero antes do sql injection, bindvalue irá inserir tais números na query
            //Caso contrário a inserção é feita normalmente

            $stmt->bindValue(":nome", trim($this->__get("nome")).'%');
            $stmt->bindValue(":id_usuario_autenticado", $this->__get("id"));

            //Executa a query válida
            $stmt->execute();

            //  fetchAll = Busca todos os registros no PDO STATEMENT (query associada aos resultados da consulta)
            //             Ou seja, o fetchAll obtém todos os resultado da consulta e armazena esse resultado em um array.
            //             Retorna todos os registros obtido na consulta com o filtro do fetchAll aplicado
            //  Filtros:
            //          PDO:FETCH_ASSOC = indices associativos
            //          PDO:FETCH_NUM = indices numericos
            //          PDO:FETCH_BOTH = ambos os indices (Padrão)
            //          PDO:FETCH_OBJ = array de objetos

            $usuarios = $stmt->fetchAll(\PDO::FETCH_ASSOC);

            return $usuarios;
        }


        //Verifica se o usuário já seguiu o usuário em questão
        public function verificar_bd_usuarios_seguidores($id_usuario_seguidor, $id_usuario_seguido){
            $query = "SELECT id_usuario_seguidor, id_usuario_seguido                         
                      FROM 
                             usuarios_seguidores
                      WHERE 
                            id_usuario_seguidor = :id_usuario_seguidor
                      AND
                            id_usuario_seguido = :id_usuario_seguido;";

            // PDO STATEMENT ( declaração PDO )
            // Representa uma query não executada e, após a execução da instrução,
            // um conjunto de resultados associado.

            //Preparação da query
            //A query não é executada, o metódo prepare somente retorna um pdo statement com a query não
            //executada como valor do atributo "queryString".
            $stmt = $this->db->prepare($query);

            //Validação dos dados digitados pelo usuário que serão inseridos na query
            //Se os dados forem comandos sql, bindValue(vincular valor) não permite que a inserção seja feita
            //OBS: Se tiver algum numero antes do sql injection, bindvalue irá inserir tais números na query
            //Caso contrário a inserção é feita normalmente

            $stmt->bindValue(":id_usuario_seguidor", $id_usuario_seguidor);
            $stmt->bindValue(":id_usuario_seguido",  $id_usuario_seguido);

            //Executa a query válida
            $stmt->execute();


            //  fetch = Busca o primeiro registro no PDO STATEMENT (query associada aos resultados da consulta)
            //  Ou seja, o fetch obtém o primeiro resultado da consulta e armazena esse resultado em um array.
            //          Retorna o registro obtido na consulta com o filtro do fetch aplicado
            //  Filtros:
            //          PDO:FETCH_ASSOC = indices associativos
            //          PDO:FETCH_NUM = indices numericos
            //          PDO:FETCH_BOTH = ambos os indices (Padrão)
            //          PDO:FETCH_OBJ = array de objetos

            $retorno = $stmt->fetch(\PDO::FETCH_ASSOC);

            return $retorno;
        }


        public function seguir_usuario($id_usuario_seguido){

            if(empty($this->verificar_bd_usuarios_seguidores($this->__get("id"),$id_usuario_seguido))) {

                $query = "INSERT INTO usuarios_seguidores(id_usuario_seguidor, id_usuario_seguido)  VALUES (:id_usuario_seguidor, :id_usuario_seguido);";

                // PDO STATEMENT ( declaração PDO )
                // Representa uma query não executada e, após a execução da instrução,
                // um conjunto de resultados associado.

                //Preparação da query
                //A query não é executada, o metódo prepare somente retorna um pdo statement com a query não
                //executada como valor do atributo "queryString".
                $stmt = $this->db->prepare($query);

                //Validação dos dados digitados pelo usuário que serão inseridos na query
                //Se os dados forem comandos sql, bindValue (vincular valor) não permite que a inserção seja feita
                //OBS: Se tiver algum numero antes do sql injection, bindvalue irá inserir tais números na query
                //Caso contrário a inserção é feita normalmente

                $stmt->bindValue(":id_usuario_seguidor", $this->__get("id"));
                $stmt->bindValue(":id_usuario_seguido", $id_usuario_seguido);

                //Executa a query válida
                $stmt->execute();

                return true;
            }
        }

        public function deixar_de_seguir_usuario($id_usuario_seguido){
            $query = "DELETE FROM usuarios_seguidores WHERE id_usuario_seguidor = :id_usuario_seguidor
                      AND id_usuario_seguido  = :id_usuario_seguido";

            // PDO STATEMENT ( declaração PDO )
            // Representa uma query não executada e, após a execução da instrução,
            // um conjunto de resultados associado.

            //Preparação da query
            //A query não é executada, o metódo prepare somente retorna um pdo statement com a query não
            //executada como valor do atributo "queryString".
            $stmt = $this->db->prepare($query);

            //Validação dos dados digitados pelo usuário que serão inseridos na query
            //Se os dados forem comandos sql, bindValue (vincular valor) não permite que a inserção seja feita
            //OBS: Se tiver algum numero antes do sql injection, bindvalue irá inserir tais números na query
            //Caso contrário a inserção é feita normalmente

            $stmt->bindValue(":id_usuario_seguidor", $this->__get("id"));
            $stmt->bindValue(":id_usuario_seguido", $id_usuario_seguido);

            //Executa a query válida
            $stmt->execute();

            return true;
        }


        //Recupera o total de tweets de um usuário
        public function obter_qtd_tweets_usuario(){
            $query = "SELECT count(*) as qtd_tweets from tweets where id_usuario = :id_usuario";

            // PDO STATEMENT ( declaração PDO )
            // Representa uma query não executada e, após a execução da instrução,
            // um conjunto de resultados associado.

            //Preparação da query
            //A query não é executada, o metódo prepare somente retorna um pdo statement com a query não
            //executada como valor do atributo "queryString".
            $stmt = $this->db->prepare($query);

            //Validação dos dados digitados pelo usuário que serão inseridos na query
            //Se os dados forem comandos sql, bindValue (vincular valor) não permite que a inserção seja feita
            //OBS: Se tiver algum numero antes do sql injection, bindvalue irá inserir tais números na query
            //Caso contrário a inserção é feita normalmente

            $stmt->bindValue(":id_usuario", $this->__get("id"));

            //Executa a query válida
            $stmt->execute();

            //  fetch = Busca o primeiro registro no PDO STATEMENT (query associada aos resultados da consulta)
            //  Ou seja, o fetch obtém o primeiro resultado da consulta e armazena esse resultado em um array.
            //          Retorna o registro obtido na consulta com o filtro do fetch aplicado
            //  Filtros:
            //          PDO:FETCH_ASSOC = indices associativos
            //          PDO:FETCH_NUM = indices numericos
            //          PDO:FETCH_BOTH = ambos os indices (Padrão)
            //          PDO:FETCH_OBJ = array de objetos

            $qtd_tweets = $stmt->fetch(\PDO::FETCH_ASSOC);

            return $qtd_tweets;
        }

        //Recupera o total de usuários que um usuário está seguindo
        public function obter_qtd_seguindo_usuario(){
            $query = "SELECT count(*) as qtd_seguindo from usuarios_seguidores where id_usuario_seguidor = :id_usuario_seguidor";

            // PDO STATEMENT ( declaração PDO )
            // Representa uma query não executada e, após a execução da instrução,
            // um conjunto de resultados associado.

            //Preparação da query
            //A query não é executada, o metódo prepare somente retorna um pdo statement com a query não
            //executada como valor do atributo "queryString".
            $stmt = $this->db->prepare($query);

            //Validação dos dados digitados pelo usuário que serão inseridos na query
            //Se os dados forem comandos sql, bindValue (vincular valor) não permite que a inserção seja feita
            //OBS: Se tiver algum numero antes do sql injection, bindvalue irá inserir tais números na query
            //Caso contrário a inserção é feita normalmente

            $stmt->bindValue(":id_usuario_seguidor", $this->__get("id"));

            //Executa a query válida
            $stmt->execute();

            //  fetch = Busca o primeiro registro no PDO STATEMENT (query associada aos resultados da consulta)
            //  Ou seja, o fetch obtém o primeiro resultado da consulta e armazena esse resultado em um array.
            //          Retorna o registro obtido na consulta com o filtro do fetch aplicado
            //  Filtros:
            //          PDO:FETCH_ASSOC = indices associativos
            //          PDO:FETCH_NUM = indices numericos
            //          PDO:FETCH_BOTH = ambos os indices (Padrão)
            //          PDO:FETCH_OBJ = array de objetos

            $qtd_tweets = $stmt->fetch(\PDO::FETCH_ASSOC);

            return $qtd_tweets;
        }


        //Recupera o total de seguidores que um usuário possui
        public function obter_qtd_seguidores_usuario(){
            $query = "SELECT count(*) as qtd_seguidores from usuarios_seguidores where id_usuario_seguido = :id_usuario_seguido";

            // PDO STATEMENT ( declaração PDO )
            // Representa uma query não executada e, após a execução da instrução,
            // um conjunto de resultados associado.

            //Preparação da query
            //A query não é executada, o metódo prepare somente retorna um pdo statement com a query não
            //executada como valor do atributo "queryString".
            $stmt = $this->db->prepare($query);

            //Validação dos dados digitados pelo usuário que serão inseridos na query
            //Se os dados forem comandos sql, bindValue (vincular valor) não permite que a inserção seja feita
            //OBS: Se tiver algum numero antes do sql injection, bindvalue irá inserir tais números na query
            //Caso contrário a inserção é feita normalmente

            $stmt->bindValue(":id_usuario_seguido", $this->__get("id"));

            //Executa a query válida
            $stmt->execute();

            //  fetch = Busca o primeiro registro no PDO STATEMENT (query associada aos resultados da consulta)
            //  Ou seja, o fetch obtém o primeiro resultado da consulta e armazena esse resultado em um array.
            //          Retorna o registro obtido na consulta com o filtro do fetch aplicado
            //  Filtros:
            //          PDO:FETCH_ASSOC = indices associativos
            //          PDO:FETCH_NUM = indices numericos
            //          PDO:FETCH_BOTH = ambos os indices (Padrão)
            //          PDO:FETCH_OBJ = array de objetos

            $qtd_tweets = $stmt->fetch(\PDO::FETCH_ASSOC);

            return $qtd_tweets;
        }






    }
?>