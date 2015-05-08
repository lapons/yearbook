<?php

class Participantes {
    
    private $login;
    private $senha;
    private $nomeCompleto;
    private $arquivoFoto;
    private $cidade;
    private $email;
    private $descricao;
    
    public function setLogin($login){
        $this->login = $login;
    }
    
    public function setSenha($senha){
        $this->senha = $senha;
    }
    
    public function setNomeCompleto($nomeCompleto){
        $this->nomeCompleto = $nomeCompleto;
    }
    
    public function setArquivoFoto($arquivoFoto){
        $this->arquivoFoto = $arquivoFoto;
    }
    
    public function setCidade($cidade){
        $this->cidade = $cidade;
    }
    
    public function setEmail($email){
        $this->email = $email;
    }
    
    public function setDescricao($descricao){
        $this->descricao = $descricao;
    }
    
    public function getLogin(){
        return $this->login;
    }
    
    public function getSenha(){
        return $this->senha;
    }
    
    public function getNomeCompleto(){
        return $this->nomeCompleto;
    }
    
    public function getArquivoFoto(){
        return $this->arquivoFoto;
    }
    
    public function getCidade(){
        return $this->cidade;
    }
    
    public function getEmail(){
        return $this->email;
    }
    
    public function getDescricao(){
        return $this->descricao;
    }
    
}

?>