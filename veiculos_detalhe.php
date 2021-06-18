<?php
require_once('conexao.php');

$idVeiculo = (int)$_GET['id_veiculo'];

if($idVeiculo <= 0){
    $erro = 'Não recebeu o ID do veículo!';
}

//Traz os detalhes do veículo
if(!$erro){
    $sqlVeiculo =   "
                        SELECT
                            veiculo
                            , marca
                            , ano
                            , descricao
                            , vendido
                        FROM
                            tb_veiculos
                        WHERE
                            id = '".$idVeiculo."'
                    ";

    if($resVeiculo = mysqli_query($conexao, $sqlVeiculo)){
        $dadosVeiculo = mysqli_fetch_assoc($resVeiculo);
    } else {
        $erro = 'Erro ao trazer detalhes do veículo!';
    }
}

//JSON final
if(!$erro){
    $arrJSON[] = array(
        'veiculo'   => $dadosVeiculo['veiculo'],
        'marca'     => $dadosVeiculo['marca'],
        'ano'       => $dadosVeiculo['ano'],
        'descricao' => $dadosVeiculo['descricao'],
        'vendido'   => $dadosVeiculo['vendido']
    );
} else {
    $arrJSON[] = array(
        'erro' => $erro
    );
}

echo json_encode($arrJSON);
?>