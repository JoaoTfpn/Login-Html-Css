<?php
session_start();
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="imagens/logo.png">
    <link rel="stylesheet" type="text/css" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title>Login</title>
</head>

<body>
    <a href="./dados/update.php">Atualizar</a>
    <div class="container text-center">
        <?php
        if(isset($_SESSION['id_user']) and (isset($_SESSION['nome']))){
            echo "Bem vindo " . $_SESSION['nome'] . "<br>";
            echo "<a href='sair.php'>Sair</a><br>";
        }else{
            echo "<div id='dados-usuario'>";
            echo "<button type='button' class='btn btn-outline-warning m-3' data-bs-toggle='modal' data-bs-target='#loginModal'>Login</button>";
            echo "<button type='button' class='btn btn-outline-dark' data-bs-toggle='modal' data-bs-target='#cadUsuarioModal'>Cadastre-se</button>";
            echo "</div>";
        }

        if(isset($_SESSION['msg'])){
            echo $_SESSION['msg'];
            unset($_SESSION['msg']);
        }

        ?>
        <div class="m-5">
            <span id="msgAlert"></span>
        </div>
    </div>

    <div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="loginModalLabel">Faça seu login na Golden Express</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="login-usuario-form">
                        <span id="msgAlertErroLogin"></span>
                        <div class="mb-3">
                            <label for="email" class="col-form-label">Usuário:</label>
                            <input type="text" name="email" class="form-control" id="email" placeholder="Digite o usuário">
                        </div>
                        <div class="mb-3">
                            <label for="senha" class="col-form-label">Senha:</label>
                            <input type="password" name="senha" class="form-control" id="senha" autocomplete="on" placeholder="Digite a senha">
                        </div>
                        <div class="mb-3">
                            <input type="submit" class="btn btn-outline-primary bt-sm" id="login-usuario-btn" value="Acessar">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="cadUsuarioModal" tabindex="-1" aria-labelledby="cadUsuarioModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="cadUsuarioModalLabel">Cadastro</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="cad-usuario-form">
                        <span id="msgAlertErroCad"></span>

                        <div class="mb-3">
                            <label for="cadnome" class="col-form-label">Nome Completo:</label>
                            <input type="text" name="cadnome" class="form-control" id="cadnome" placeholder="Informe o seu nome completo">
                        </div>

                        <div class="mb-3">
                            <label for="cademail" class="col-form-label">E-mail:</label>
                            <input type="email" name="cademail" class="form-control" id="cademail" placeholder="Informe o seu e-mail">
                        </div>

                        <div class="mb-3">
                            <label for="cadendereco" class="col-form-label">Endereço:</label>
                            <input type="text" name="cadendereco" class="form-control" id="cadendereco" placeholder="Informe o seu Endereço">
                        </div>

                        <div class="mb-3">
                            <label for="cadtelefone" class="col-form-label">Telefone:</label>
                            <input type="text" name="cadtelefone" class="form-control" id="cadtelefone" placeholder="Informe o seu Telefone">
                        </div>

                        <div class="mb-3">
                            <label for="cadsenha" class="col-form-label">Senha:</label>
                            <input type="password" name="cadsenha" class="form-control" id="cadsenha" autocomplete="on" placeholder="Informe a sua senha">
                        </div>

                        <div class="mb-3">
                            <input type="submit" class="btn btn-outline-success bt-sm" id="cad-usuario-btn" value="Cadastrar">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="js/custom.js"></script>
</body>

</html>