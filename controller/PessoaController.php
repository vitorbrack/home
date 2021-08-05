<?php
require_once "C:/xampp/htdocs/PHPMatutinoPDO/dao/daoPessoa.php";
require_once 'C:/xampp/htdocs/PHPMatutinoPDO/model/Pessoa.php';
require_once 'c:/xampp/htdocs/PHPMatutinoPDO/model/Endereco.php';

class PessoaController {

    public function inserirPessoa($nome, $dtNasc, $login, $senha, 
            $perfil, $email, $cpf,$cep, $logradouro , $uf , $bairro, $cidade, $complemento){

        $endereco = new Endereco();
        $endereco->setCep($cep);
        $endereco->setLogradouro($logradouro);
        $endereco->setUf($uf);
        $endereco->setBairro($bairro);
        $endereco->setCidade($cidade);
        $endereco->setComplemento($complemento);
                
        $pessoa = new Pessoa();
        $pessoa->setNome($nome);
        $pessoa->setDtNasc($dtNasc);
        $pessoa->setLogin($login);
        $pessoa->setSenha($senha);
        $pessoa->setPerfil($perfil);
        $pessoa->setEmail($email);
        $pessoa->setCpf($cpf);
        $pessoa->setFkEndereco($endereco);

        $pessoa->setFkEndereco($endereco);
                
        $daoPessoa = new daoPessoa();
        return $daoPessoa->inserir($pessoa);
    }
}
