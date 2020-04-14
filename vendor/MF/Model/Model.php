<?php
    //Model/Model = Arquivo que contém scripts de inicialização
    //do framework, ou seja, as configurações iniciais do framework.

    //"Arquivo do programador que desenvolve a framework"

    //Arquivo Model = Requisito não funcional

    //Requisitos são solicitações, desejos, necessidades.
    //Requisito não funcional = Um requisito não funcional é aquele que descreve
    //como o sistema fará.

    namespace MF\Model;

    abstract class Model{
        protected $db;

        public function __construct(\PDO $db){
            $this->db = $db;
        }

    }









?>
