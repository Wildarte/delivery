<?php

class Database{

    private $server = "lcalhost";
    private $user = "root";
    private $pass = "";
    private $db = 'delivery';
    private $dbh;
    private $stmt;

    public function __construct()
    {
        //fonte de dados ou DSN contém as informações necessárias para conectar ao banco de dados.
        $dsn = 'mysql:host='.$this->server.';dbname='.$this->db;
        $opcoes = [
            //armazena em cache a conexão para ser reutilizada, evita a sbrecarga de uma nova conexao, resultando em um aplicativo mais rápido
            PDO::ATTR_PERSISTENT => true,
            //lança um PDOException se ocorrer um erro
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        ];

        try{
          //cria a instancia do PDO
          $this->dbh = new PDO($dsn,  $this->user, $this->pass);
        }catch(PDOException $e){
          print "Error!: " . $e->getMessage() . "<br/>";
          die();
        }
    }

    public function query($sql){
      $this->stmt = $this->dbh->prepare($sql);
    }

    public function bind($param, $value, $type = null){
      if(is_null($type)){
        switch(true){
          case is_int($value):
            $type = PDO::PARAM_INT;
          break;
          case is_bool($value):
            $type = PDO::PARAM_BOOL;
          break;
          case is_null($value):
            $type = PDO::PARAM_NULL;
          break;
          default:
            $type = PDO::PARAM_STR;
        }
      }

      $this->stmt->bindValue($param, $value, $type);

    }

    public function executa(){
      return $this->stmt->execute();
    }

    //retorna um resultado
    public function resultado(){
      $this->executa();
      return $this->stmt->fetch(PDO::FETCH_OBJ);
    }

    public function resultados(){
      $this->executa();
      return $this->stmt->fetchAll(PDO::FETCH_OBJ);
    }

    public function totalResultados(){
      return $this->stmt->rowCount();
    }

    public function ultimoIdInserido(){
      return $this->stmt->lastInertId();
    }

}
