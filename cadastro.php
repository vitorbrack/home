<?php
include_once 'controller/PessoaController.php';
include_once './model/Pessoa.php';
include_once './model/Endereco.php';
include_once './model/Mensagem.php';
$pe = new Pessoa();
$en = new Endereco();
$msg = new Mensagem();
$pe->setFkEndereco($en);
$btEnviar = FALSE;
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <style>
        .btInput {
            padding: 10px 20px 10px 20px;
            margin-top: 20px;
            margin-bottom: 20px;
        }
    </style>
    <script>
            function mascara(t, mask){
                var i = t.value.length;
                var saida = mask.substring(1,0);
                var texto = mask.substring(i)
                
                if (texto.substring(0,1) != saida){
                    t.value += texto.substring(0,1);
                }
            }
        </script>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Navbar</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavDropdown">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Features</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Pricing</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Dropdown link
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                            <li><a class="dropdown-item" href="#">Action</a></li>
                            <li><a class="dropdown-item" href="#">Another action</a></li>
                            <li><a class="dropdown-item" href="#">Something else here</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container-fluid">
        <div class="row" style="margin-top: 30px;">
            <div class="col-8 offset-2">

                <div class="card-header bg-dark text-center text-white border" style="padding-bottom: 15px; padding-top: 15px;">
                    Cadastro de Cliente
                </div>
                <?php
                //envio dos dados para o BD
                if (isset($_POST['cadastrar'])) {
                    $nome = trim($_POST['nome']);
                    if ($nome != ""){
                    $idpessoa = $_POST['idpessoa'];
                    $nome = $_POST['nome'];
                    $dtNasc = $_POST['dtNasc'];
                    $login = $_POST['login'];
                    $senha = $_POST['senha'];
                    $perfil = $_POST['perfil'];
                    $cpf = $_POST['cpf'];
                    $email = $_POST['email'];
                    $cep = $_POST['cep'];
                    $logradouro = $_POST['logradouro'];
                    $complemento = $_POST['complemento'];
                    $bairro = $_POST['bairro'];
                    $cidade = $_POST['cidade'];
                    $uf = $_POST['uf'];

                    $pc = new PessoaController();
                    unset($_POST['cadastrar']);
                    $msg = $pc->inserirPessoa(
                        $nome,
                        $dtNasc,
                        $login,
                        $senha,
                        $perfil,
                        $email,
                        $cpf, 
                        $cep, 
                        $logradouro , 
                        $complemento , 
                        $bairro, 
                        $cidade, 
                        $uf
                    );
                    echo $msg->getMsg();
                            echo "<META HTTP-EQUIV='REFRESH' CONTENT=\"2;
                                URL='cadastro.php'\">";
                }
            }
                ?>
                <div class="card-body border">
                    <form method="post" action="">
                        <div class="row">
                            <div class="col-md-6">
                            <strong>Código: <label style="color:red;">
                                            <?php
                                            if ($pe != null) {
                                                echo $pe->getIdPessoa();
                                                ?>
                                            </label></strong>
                                        <input type="hidden" name="idpessoa" 
                                               value="<?php echo $pe->getIdPessoa() ?>"><br>
                                               <?php
                                           }
                                           ?>     
                                <label>Nome Completo</label>
                                <input class="form-control" type="text" name="nome" value="<?php echo $pe->getNome(); ?>">
                                <label>Data de Nascimento</label>
                                <input class="form-control" type="date" name="dtNasc" value="<?php echo $pe->getDtNasc(); ?>">
                                <label>E-Mail</label>
                                <input class="form-control" type="email" name="email" value="<?php echo $pe->getEmail(); ?>">
                                <label>CPF</label>
                                <input class="form-control" type="text" name="cpf" value="<?php echo $pe->getCpf(); ?>">
                            </div>
                            <div class="col-md-6">
                                <br>
                                <label>Login</label>
                                <input class="form-control" type="text" name="login" value="<?php echo $pe->getLogin(); ?>">
                                <label>Senha</label>
                                <input class="form-control" type="password" name="senha" value="<?php echo $pe->getSenha(); ?>">
                                <label>Conf. Senha</label>
                                <input class="form-control" type="password" name="senha2">
                                <label>Perfil</label>
                                <select name="perfil" class="form-select">
                                    <option>[--Selecione--]</option>
                                    <option value="<?php echo $pe->getPerfil();?>">Cliente</option>
                                    <option value="<?php echo $pe->getPerfil();?>">Funcionário</option>
                                </select>
                            </div>
                        </div>
                        <div class="card-header bg-dark text-center text-white border" style="padding-bottom: 15px; padding-top: 15px;">
                            Endereço do cliente
                        </div>
                        <div class="col-12 ">
                            <div class="card-header bg-light text-center text-dark border">
                                <div class="row">
                                <label>Código: </label> <br>
                                </div>
                                <div class="row">
                                
                                    <div class="col-md-6 ">
                                        <label>CEP</label><br>
                                        <input class="form-control" type="text" id="cep" onkeypress="mascara(this, '#####-###')" maxlength="9" value="<?php echo $pe->getFkEndereco()->getCep(); ?>" name="cep">
                                        <label>Logradouro</label>
                                        <input type="text" class="form-control" name="logradouro" id="rua" value="<?php echo $pe->getFkEndereco()->getLogradouro(); ?>" >
                                        <label>Complemento</label>
                                        <input type="text" class="form-control" name="complemento" id="complemento" <?php echo $pe->getFkEndereco()->getComplemento(); ?>" >
                                    </div>
                                    <div class="col-md-6">
                                        <label>Bairro</label>
                                        <input type="text" class="form-control" name="bairro" id="bairro" value="<?php echo $pe->getFkEndereco()->getBairro(); ?>" >
                                        <label>Cidade</label>
                                        <input type="text" class="form-control" name="cidade" id="cidade" value="<?php echo $pe->getFkEndereco()->getCidade(); ?>" >
                                        <label>UF</label>
                                        <input type="text" class="form-control" name="uf" id="uf" value="<?php echo $pe->getFkEndereco()->getUf(); ?>" maxlength="2" >
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-6 offset-4">
                            <input type="submit" name="cadastrar" class="btn btn-success btInput" value="Enviar">
                            &nbsp;&nbsp;
                            <input type="reset" class="btn btn-light btInput" value="Limpar">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="js/bootstrap.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script>
        var myModal = document.getElementById('myModal')
        var myInput = document.getElementById('myInput')

        myModal.addEventListener('shown.bs.modal', function () {
            myInput.focus()
        })
    </script>
    <script src="js/JQuery.js"></script>
    <script src="js/JQuery.min.js"></script>
    <script>
        var myModal = document.getElementById('myModal')
        var myInput = document.getElementById('myInput')

        myModal.addEventListener('shown.bs.modal', function() {
            myInput.focus()
        })
    </script>
    <!-- Adicionando Javascript controle de endereço via cep-->
    <script>
        $(document).ready(function() {

            function limpa_formulário_cep() {
                // Limpa valores do formulário de cep.
                $("#rua").val("");
                $("#bairro").val("");
                $("#cidade").val("");
                $("#uf").val("");
                $("#cepErro").val("");
            }

            //Quando o campo cep perde o foco.
            $("#cep").blur(function() {

                //Nova variável "cep" somente com dígitos.
                var cep = $(this).val().replace(/\D/g, '');

                //Verifica se campo cep possui valor informado.
                if (cep != "") {

                    //Expressão regular para validar o CEP.
                    var validacep = /^[0-9]{8}$/;

                    //Valida o formato do CEP.
                    if (validacep.test(cep)) {

                        //Preenche os campos com "..." enquanto consulta webservice.
                        $("#rua").val("...");
                        $("#bairro").val("...");
                        $("#cidade").val("...");
                        $("#uf").val("...");


                        //Consulta o webservice viacep.com.br/
                        $.getJSON("https://viacep.com.br/ws/" + cep + "/json/?callback=?", function(dados) {

                            if (!("erro" in dados)) {
                                //Atualiza os campos com os valores da consulta.
                                $("#rua").val(dados.logradouro);
                                $("#bairro").val(dados.bairro);
                                $("#cidade").val(dados.localidade);
                                $("#uf").val(dados.uf);

                            } //end if.
                            else {
                                //CEP pesquisado não foi encontrado.
                                limpa_formulário_cep();
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Oops...',
                                    text: 'CEP não encontrado'
                                })

                            }
                        });
                    } //end if.
                    else {
                        //cep é inválido.
                        limpa_formulário_cep();
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'CEP Inválido'

                        })
                    }
                } //end if.
                else {
                    //cep sem valor, limpa formulário.
                    limpa_formulário_cep();
                }
            });
        });
    </script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="sweetalert2.min.js"></script>
    <link rel="stylesheet" href="sweetalert2.min.css"> 
</body>

</html>