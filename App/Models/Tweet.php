<?php
    //Tweet = Arquivo que contém apenas as informações do projeto em questão, ou seja,
    //arquivo utilizado para o programador que irá utilizar o framework inserir dados do
    //seu projeto.

    // "Arquivo do programador que utiliza o framework"

    //Arquivo Tweet = Requisito funcional

    //Requisitos são solicitações, desejos, necessidades.
    //Requisito funcional = Um requisito funcional é a aquele que descreve
    // o que o sistema fará.

    namespace App\Models;

    use MF\Model\Model;

    class Tweet extends Model{
        private $id;
        private $id_usuario;
        private $tweet;
        private $data;
        private $nome_arquivo_tweet;

        public function __set($atributo, $valor){
            $this->$atributo = $valor;
        }

        public function __get($atributo){
            return $this->$atributo;
        }

        //Salva o tweet no banco de dados
        public function salvar_tweet(){

            $tweet = trim($this->__get('tweet')); // Remove o espaço que está sobrando do início de uma string
            if ($tweet != '' || $this->__get('nome_arquivo_tweet') != '') {

                $query = "INSERT INTO tweets (id_usuario, tweet,nome_arquivo_tweet) values(:id_usuario, :tweet, :nome_arquivo_tweet);";

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

                $stmt->bindValue(":id_usuario", $this->__get("id_usuario"));
                $stmt->bindValue(":tweet", $tweet);
                $stmt->bindValue(":nome_arquivo_tweet", $this->__get("nome_arquivo_tweet"));

                //Executa a query válida
                $stmt->execute();
            }
        }

        function obter_nome_arquivo_tweet(){
            $query = "SELECT nome_arquivo_tweet FROM tweets WHERE id = :id";

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

            $stmt->bindValue(":id",$this->__get("id"));

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

            return $stmt->fetch();

        }

        function remover_tweet(){
            $query = "DELETE FROM tweets WHERE id = :id";


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

            $stmt->bindValue(":id",$this->__get("id"));

            //Executa a query válida
            $stmt->execute();


        }

        //Recupera do banco de dados todos os tweets
        public function obter_tweets(){
            $query = "
                SELECT
                       t.id,
                       t.id_usuario,
                       u.nome,
                       t.tweet,
                       t.nome_arquivo_tweet,
                       DATE_FORMAT(t.data, '%d/%m/%Y %H%:%i') as data
                FROM
                         tweets as t
                     INNER 
                     JOIN
                         usuarios as u 
                     ON
                         (t.id_usuario = u.id)
                WHERE 
                      t.id_usuario  = :id_usuario
                      OR 
                      t.id_usuario in (
                          SELECT
                                 id_usuario_seguido 
                          FROM
                               usuarios_seguidores 
                          WHERE id_usuario_seguidor = :id_usuario
                      )
                ORDER BY
                        t.data DESC";

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

            $stmt->bindValue(":id_usuario",$this->__get("id_usuario"));

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

            $tweets = $stmt->fetchAll(\PDO::FETCH_ASSOC);

            return $tweets;
        }

    }
?>