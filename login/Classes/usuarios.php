<?php
    class Usuario
        {
            private $pdo;
            public $msgErro = "";
            public function conectar($nome, $host, $email, $senha)
            {
                global $pdo;
                try {
                    $pdo = new PDO("mysql:dbname=".$nome.";$host=".$host,$email,$senha);
                } catch (PDOException $e){
                    $msgErro = $e->getMessage();
                }
            
            }            
            public function cadastro($nome, $email, $endereço, $telefone, $senha)
            {
                global $pdo;
                //Saber se já existe esse email cadastrado. AAAAAAA SÃO 4 HORAS DA MANHA EU PRECISO DORMIR
                $sql = $pdo->prepare("SELECT id_usuario FROM usuarios WHERE email = :e");

                $sql->bindvalue(":e",$email);

                $sql->execute();

                if($sql->rowCount() > 0)
                {
                    return false; //JA TEM CADASTRO NESSA PORRA
                }
                else{
                    $sql = $pdo->prepare("INSERT INTO usuarios (nome, email, endereço, telefone, senha) VALUES (:n, :e, :en, :t, :s)");
                    $sql->bindvalue(":n",$nome);
                    $sql->bindvalue(":e",$email);
                    $sql->bindvalue(":en",$endereço);
                    $sql->bindvalue(":t",$telefone);
                    $sql->bindvalue(":s",md5($senha));
                    $sql->execute();
                    return true;
                }
            }
            public function logar($email, $senha)
            {
                global $pdo;
                $sql = $pdo->prepare("SELECT id_usuario FROM usuarios WHERE email = :e AND senha = :s");
                $sql->bindValue(":e",$email);
                $sql->bindValue(":s",md5($senha));
                $sql->execute();

                if($sql->rowCount() > 0)
                {
                    $dado = $sql->fetch();
                    session_start();
                    $_SESSION['id_usuario'] = $dado['id_usuario'];
                    return true;
                }
                else{
                    return false;
                }
            }
        }
?>