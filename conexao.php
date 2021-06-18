<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Credentials: true");
header("Access-Control-Allow-Methods: POST, GET");

$conexao = mysqli_connect("127.0.0.1", "root", "", "bd_veiculos");
 
if (!$conexao) {
    echo "<script>alert(Erro ao conectar no banco!)</script>";
    exit();
} 
 
mysqli_close($conexao);
?> 