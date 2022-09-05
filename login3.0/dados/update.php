<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" type="text/css" href="update.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Atualizar</title>
</head>
<body>
    <h1>Atualizar Dados</h1>
    <form action=""method="POST">
        <input type="text" name="id_user" placeholder="ID"></input>
        <input type="text" name="nome" placeholder="Nome"></input>
        <input type="text" name="endereco" placeholder="Endereço"></input>
        <input type="text" name="telefone" placeholder="Telefone"></input>
        <input type="text" name="email" placeholder="Email"></input>
        <input type="text" name="senha" placeholder="Senha"></input>

        <input type="submit" name="update" value="Atualizar dados">
    </form>
</body>
</html>

<?php
    $connection = mysqli_connect("localhost","root","");
    $db = mysqli_select_db($connection,'dados');

    if(isset($_POST['update'])){
        $id_user = $_POST['id_user'];
        $query = "UPDATE `tbusuarios` SET nome='$_POST[nome]',email='$_POST[email]',telefone='$_POST[telefone]',endereco='$_POST[endereco]',senha='$_POST[senha]' WHERE  id_user='$_POST[id_user]'";

        $query_run = mysqli_query($connection,$query);

        if($query_run){
            echo'<script type="text/javascript"> alert("Dados atualizados") </script>';
        }else{
            echo'<script type="text/javascript"> alert("Dados não atualizados") </script>';
        }
    }
?>