<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'lib/vendor/autoload.php';

include_once "conexao.php";

$dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);

if (empty($dados['cadnome'])) {
    $retorna = ['erro' => true, 'msg' => "<div class='alert alert-danger' role='alert'>Erro: Necessário preencher o campo nome!</div>"];
} elseif (empty($dados['cademail'])) {
    $retorna = ['erro' => true, 'msg' => "<div class='alert alert-danger' role='alert'>Erro: Necessário preencher o campo e-mail!</div>"];
} elseif (empty($dados['cadsenha'])) {
    $retorna = ['erro' => true, 'msg' => "<div class='alert alert-danger' role='alert'>Erro: Necessário preencher o campo senha!</div>"];
} else {

    $query_usuario_pes = "SELECT id FROM usuarios WHERE email=:email LIMIT 1";
    $result_usuario = $conn->prepare($query_usuario_pes);
    $result_usuario->bindParam(':email', $dados['cademail'], PDO::PARAM_STR);
    $result_usuario->execute();

    if (($result_usuario) and ($result_usuario->rowCount() != 0)) {
        $retorna = ['erro' => true, 'msg' => "<div class='alert alert-danger' role='alert'>Erro: O e-mail já está cadastrado!</div>"];
    } else {

        $query_usuario = "INSERT INTO usuarios (nome, email, senha, chave) VALUES (:nome, :email, :senha, :chave)";
        $cad_usuario = $conn->prepare($query_usuario);
        $cad_usuario->bindParam(':nome', $dados['cadnome'], PDO::PARAM_STR);
        $cad_usuario->bindParam(':email', $dados['cademail'], PDO::PARAM_STR);
        $senha_cript = password_hash($dados['cadsenha'], PASSWORD_DEFAULT);
        $cad_usuario->bindParam(':senha', $senha_cript, PDO::PARAM_STR);
        $chave = password_hash($dados['cademail'] . date("Y-m-d H:i:s"), PASSWORD_DEFAULT);
        $cad_usuario->bindParam(':chave', $chave, PDO::PARAM_STR);

        $cad_usuario->execute();

        if ($cad_usuario->rowCount()) {

            $mail = new PHPMailer(true);

            try {
                $mail->CharSet = "UTF-8";
                $mail->isSMTP();
                $mail->Host       = 'smtp.mailtrap.io';
                $mail->SMTPAuth   = true;
                $mail->Username   = 'dc561888d1e84a';
                $mail->Password   = 'b8071cc995a955';
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                $mail->Port       = 2525;

                //Recipients
                $mail->setFrom('Trabalhotcc1304@gmail.com', 'Golden Express');
                $mail->addAddress($dados['cademail'], $dados['cadnome']);

                $mail->isHTML(true);                                 
                $mail->Subject = 'Confirma o e-mail';
                $mail->Body    = "Olá " . $dados['cadnome'] . ".<br><br>Obrigado por escolher a Golden Express!<br><br>Já está quase tudo pronto, precisamos somente que você verifique o email no botão abaixo: <br><br> <a href='http://localhost/login/confirmar-email.php?chave=$chave'>Verificar Email</a><br><br>Atenciosamente, <br>Golden Express" ;
                $mail->AltBody = "Olá " . $dados['cadnome'] . ".<br><br>Obrigado por escolher a Golden Express!<br><br>Já está quase tudo pronto, precisamos somente que você verifique o email no botão abaixo: <br><br> <a href='http://localhost/login/confirmar-email.php?chave=$chave'>Verificar Email</a><br><br>Atenciosamente, <br>Golden Express" ;
                $mail->send();

                $retorna = ['erro' => false, 'msg' => "<div class='alert alert-success' role='alert'>Cadastro realizado com sucesso. Verifique o e-mail!</div>"];

            } catch (Exception $e) {
                
                $retorna = ['erro' => true, 'msg' => "<div class='alert alert-danger' role='alert'>Erro: Usuário não cadastrado</div>"];
            }
        } else {
            $retorna = ['erro' => true, 'msg' => "<div class='alert alert-danger' role='alert'>Erro: Usuário não cadastrado</div>"];
        }
    }
}

echo json_encode($retorna);
