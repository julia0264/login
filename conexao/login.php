<?php
session_start();
include("conexaobancodados.php");
if(empty($_POST["email"]) || empty($_POST["senha"])){
    header("location: index.php");
    exit();
}
$email = mysqli_real_escape_string($conexao, $_POST["email"]);
$senha = mysqli_real_escape_string($conexao, $_POST["senha"]);

$envio = "select * from usuario where email = '{$email}' and senha = md5('$senha');";
$resultado = mysqli_query ($conexao, $envio);
$linhas = mysqli_num_rows($resultado);

if($linhas == 1){
    $dados = mysqli_fetch_assoc($resultado);
    
    $usuario = $dados ["nome"];
    $_SESSION ["nome"]= $usuario;
    header("location: deu.php");
    exit();
}else{
    header("location: index.php");
    exit();
}
?>