<?php
require_once('conexao.php');

//Adiciona veículo novo
$veiculo = trim(mysqli_real_escape_string($conexao, $_POST['veiculo']));
$marca = trim(mysqli_real_escape_string($conexao, $_POST['marca']));
$ano = (int)$_POST['ano'];
$descricao = trim(mysqli_real_escape_string($conexao, $_POST['descricao']));
$vendido = (int)$_POST['vendido'];

//Verificações
if(!$veiculo){
    $erro = 'Por favor, digite o nome do veículo!';
} else if(!$marca){
    $erro = 'Por favor, digite o nome da marca!';
} else if(!$descricao){
    $erro = 'Preencha a descrição do veículo!';
} else if(!$vendido){
    $erro = 'Marque se foi vendido ou não!';
} else if(!$ano){
    $erro = 'Preencha o ano do veículo!';
}

mysqli_autocommit($conexao, FALSE);

//Se não houver erro, rodar insert
if(!$erro){
    $sqlInsertVeiculo = "
                            INSERT INTO tb_veiculos
                            (
                                veiculo
                                , marca
                                , ano
                                , descricao
                                , vendido
                                , created
                            )
                            VALUES
                            (
                                '".$veiculo."'
                                , '".$marca."'
                                , '".$ano."'
                                , '".$descricao."'
                                , '".$vendido."'
                                , NOW()
                            )
                        ";

    if(!$mysqli_query($conexao, $sqlInsertVeiculo)){
        $erro = 'Erro ao inserir veículo!';
    }
}

//Retorno JSON
if(!$erro){
    $arrJSON[] = array(
        'sucesso' => 'Veículo adicionado com sucesso!'
    );
    mysqli_commit($conexao);
} else {
    $arrJSON[] = array(
        'erro' => $erro
    );
    mysqli_rollback($conexao);
}

echo json_encode($arrJSON);
?>