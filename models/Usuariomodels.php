<?php
class Usuariomodels{
private $id;
private $nome;
private $email;
private $senha;

public function getId():int{
    return $this->id;
}
public function setId(int $id){
    $this -> id = $id;
}

public function getNome(): string{
    return $this->nome;
}
public function setNome(string $nome){
    $this->nome=$nome;
}

public function getEmail(): string{
    return $this -> email;
}
public function setEmail(string $email){
   $this->email =$email; 
}

public function getSenha(): string{
    return $this->senha;
}

public function setSenha(string $senha){
    $this->senha=$senha;
}
}