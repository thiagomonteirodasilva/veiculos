<?php
require_once('conexao.php');

//Atualiza as informações do veículo
$idVeiculo = (int)$_POST['id_veiculo'];
$veiculo = trim(mysqli_real_escape_string($conexao, $_POST['veiculo']));
$marca = trim(mysqli_real_escape_string($conexao, $_POST['marca']));
$ano = (int)$_POST['ano'];
$descricao = trim(mysqli_real_escape_string($conexao, $_POST['descricao']));
$vendido = (int)$_POST['vendido'];

//Verificações
if($idVeiculo <= 0){
    $erro = 'Não recebeu ID do veículo!';
} else if(!$veiculo){
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

 //Rodando a atualização
 if(!$erro){
     $updateVeiculo =   "
                            UPDATE
                                tb_veiculos
                            SET
                                veiculo = '".$veiculo."'
                                , marca = '".$marca."'
                                , descricao = '".$descricao."'
                                , vendido = '".$vendido."'
                                , ano = '".$ano."'
                                , updated = NOW();
                            WHERE
                                id = '".$idVeiculo."'
                        ";

    if(!mysqli_query($conexao, $updateVeiculo)){
        $erro = 'Erro ao atualizar veículo!';
    }
 }

 //JSON final
 if(!$erro){
     mysqli_commit($conexao);
     $arrJSON[] = array(
         'sucesso' => 'Atualizado com sucesso!'
     );
 } else {
     mysqli_rollback($conexao);
     $arrJSON[] = array(
        'erro' => $erro
    );
 }

 echo json_encode($arrJSON);
 ?>