<?php

require_once __DIR__."/../connection/Usuarioconnection.php";
require_once __DIR__."/../models/Usuariomodels.php";

class UsuarioRepository{
    public PDO $conn;

    function __construct()
    {
       $this-> conn = Connection::getConnection();
    }

    public function criar (Usuariomodels $usuario) : int {
        try{
            $query ="INSERT INTO usuario (nome, email, senha) VALUES (:nome, :email, :senha)";
            $prepare= $this->conn->prepare($query);
            $prepare->bindValue(":nome", $usuario->getNome());
            $prepare->bindValue(":email", $usuario->getEmail());
            $prepare->bindValue(":senha", $usuario->getSenha());
            $prepare->execute();
            return $this->conn->lastInsertId();

        }catch(Exception $e){
            print("ERRO AO INSERIR USUARIO NO BANCO DE DADOS!");          
        }
    }

    public function findAll(): array{
        $tabela = $this->conn->query("SELECT*FROM usuarios");
        $usuario = $tabela->fetchAll(PDO::FETCH_ASSOC);
        return $usuario; 
    }
    
    public function findUsuarioById(int $id){
        $query = "SELECT*FROM usuarios WHERE id = ?";
        $prepare = $this->conn->prepare($query);
        $prepare->bindParam(1, $id, PDO::PARAM_INT);

        if($prepare->execute()){
            $usuario = $prepare->fetchObject("Usuariomodels");
        }else{
            $usuario=null;
        }
        return $usuario;
    }

    public function atualizar(Usuariomodels $usuario) : bool {
        $query = "UPDATE usuarios SET nome = ?, email = ?, senha = ? WHERE id = ?";
        $prepare = $this->conn->prepare($query);
        $prepare->bindValue(1, $usuario->getNome());
        $prepare->bindValue(2, $usuario->getEmail());
        $prepare->bindValue(3, $usuario->getSenha());
        $prepare->bindValue(4, $usuario->getId());
        $result= $prepare->execute();
    return $result;                

    }

    public function DeleteById(int $id):int{
        $query = "DELETE FROM usuarios WHERE id = :id";
        $prepare = $this->conn->prepare($query);
        $prepare->bindValue(":id", $id);
        $prepare->execute();
        $result=$prepare->rowCount();
        return $result;


    }




}