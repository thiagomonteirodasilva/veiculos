<?php
require_once('conexao.php');

$idVeiculo = $_POST['id_veiculo'];

//Exclui o veículo
if($idVeiculo <= 0){
    $erro = 'Não recebeu ID do veículo!';
}

mysqli_autocommit($conexao, FALSE);

if(!$erro){
    $deleteVeiculo =    "
                            DELETE FROM
                                tb_veiculos
                            WHERE
                                id = '".$idVeiculo."'
                        ";
    
    if(!mysqli_query($conexao, $deleteVeiculo)){
        $erro = 'Erro ao excluir veículo!'
    }
}

//JSON final
if(!$erro){
    mysqli_commit($conexao);
    $arrJSON[] = array(
        'sucesso' => 'Removido com sucesso!'
    );
} else {
    mysqli_rollback($conexao);
    $arrJSON[] = array(
        'erro' => $erro
    );
}

echo json_encode($arrJSON);
?>