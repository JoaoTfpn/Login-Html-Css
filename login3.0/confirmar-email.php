<?php

session_start();
ob_start();

include_once "conexao.php";

$chave = filter_input(INPUT_GET, "chave", FILTER_SANITIZE_STRING);

if(!empty($chave)){
    //echo "Chave: $chave <br>";

    $query_usuario = "SELECT id_user FROM tbusuarios WHERE chave=:chave LIMIT 1";
    $result_usuario = $conn->prepare($query_usuario);
    $result_usuario->bindParam(':chave', $chave, PDO::PARAM_STR);
    $result_usuario->execute();

    if (($result_usuario) and ($result_usuario->rowCount() != 0)) {
        $row_usuario = $result_usuario->fetch(PDO::FETCH_ASSOC);
        extract($row_usuario);

        $query_up_usuario = "UPDATE tbusuarios SET sits_usuario_id = 1, chave=:chave WHERE id_user=$id_user";
        $up_usuario = $conn->prepare($query_up_usuario);
        $chave = NULL;
        $up_usuario->bindParam(':chave', $chave, PDO::PARAM_STR);

        if($up_usuario->execute()){
            $_SESSION['msg'] = "<div class='alert alert-success' role='alert'>E-mail verificado.</div>";
            header("Location: index.php");
        }else{
            $_SESSION['msg'] = "<div class='alert alert-danger' role='alert'>Erro: E-mail verificado.</div>";
            header("Location: index.php");
        }

        
    } else {
        $_SESSION['msg'] = "<div class='alert alert-danger' role='alert'>Error: Email Inválido.</div>";
        header("Location: index.php");
    }

}else{
    $_SESSION['msg'] = "<div class='alert alert-danger' role='alert'>Error: Email Inválido.</div>";
    header("Location: index.php");
}