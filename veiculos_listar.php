<?php
require_once('conexao.php');

$termoBuscado = trim(mysqli_real_escape_string($conexao, $_GET['q']));

if($termoBuscado != ''){
    $where = "WHERE (veiculo LIKE %'".$termoBuscado."'% OR marca LIKE %'".$termoBuscado."'%)";
}

//Traz a lista de veículos
$sqlVeiculos =  "
                    SELECT
                        veiculo
                        , marca
                        , id
                    FROM
                        tb_veiculos
                    '".($where != '' ? $where : '')."'
                ";

if($resVeiculos = mysqli_query($conexao, $sqlVeiculos)){
    if(mysqli_num_roms($resVeiculos)){
        while($dadosVeiculos = mysqli_fetch_assoc($resVeiculos)){
            $arrVeiculos[] = array(
                'veiculo'   => $dadosVeiculos['veiculo'],
                'marca'     => $dadosVeiculos['marca'],
                'id'        => $dadosVeiculos['id']
            );
        }
    } else {
        $erro = 'Nenhum veículo a ser exibido.';
    }
} else {
    $erro = 'Erro ao trazer veículos!';
}

//JSON final
if(!$erro){
    $arrJSON[] = array(
        'veiculos' => $arrVeiculos
    );
} else {
    $arrJSON[] = array(
        'erro' => $erro
    );
}

echo json_encode($arrJSON);
?>