<?php
require 'database.php';
require 'functions.php';

$log = filter_input(INPUT_POST, 'CHECK', FILTER_SANITIZE_STRING);

if ($log) {
    switch ($log){
        case 'LOGAR':
            $user = addslashes(filter_input(INPUT_POST, 'user', FILTER_SANITIZE_STRING));
            $pass = addslashes(filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING));
            valida_login($user, $pass, $conn);
        break;

        case 'CADASTRAR':
            $prd = new produto(); //instanciando o objeto produto na classe produto no arquivo functions.php
            $prd->item = strtoupper(addslashes(filter_input(INPUT_POST, 'item', FILTER_SANITIZE_STRING)));
            $prd->cod_barras = strtoupper(addslashes(filter_input(INPUT_POST, 'cod_barras', FILTER_SANITIZE_NUMBER_INT)));
            $prd->fornecedor = strtoupper(addslashes(filter_input(INPUT_POST, 'fornecedor', FILTER_SANITIZE_STRING)));
            $prd->valor_compra = addslashes(filter_input(INPUT_POST, 'valor_compra',FILTER_SANITIZE_NUMBER_FLOAT));
            $prd->valor_venda = strtoupper(addslashes(filter_input(INPUT_POST, 'valor_venda', FILTER_SANITIZE_NUMBER_FLOAT)));
            $prd->quantidade = strtoupper(addslashes(filter_input(INPUT_POST, 'quantidade', FILTER_SANITIZE_NUMBER_INT)));
            $prd->embalagem = strtoupper(addslashes(filter_input(INPUT_POST, 'embalagem', FILTER_SANITIZE_STRING)));
            $data = strtoupper(addslashes(filter_input(INPUT_POST, 'data_compra')));
            $prd->data_compra = implode("-",array_reverse(explode("/",$data))); //converte data em formato americano para o MySql
            cadastra_produto($prd, $conn);
            /*
            if (verifica_codbarras($prd->cod_barras, $conn) == TRUE){
                //PRODUTO JÁ EXISTE
            } else {
                cadastra_produto($prd, $conn);
            }
            */
            
        break;

        case 'BUSCAR':
            $busca = strtoupper(addslashes(filter_input(INPUT_POST, 'search', FILTER_SANITIZE_STRING)));
            busca_produto($busca, $conn);
        break;

        case 'REGISTRAR';
            $for = new fornecedor(); //instanciando o objeto fornecedor na classe fornecedor no arquivo functions.php
            $for->fornecedor = strtoupper(addslashes(filter_input(INPUT_POST, 'fornecedor', FILTER_SANITIZE_STRING)));
            $for->cidade = strtoupper(addslashes(filter_input(INPUT_POST, 'cidade', FILTER_SANITIZE_STRING)));
            

            if (verifica_fornecedor($for->fornecedor, $conn) == TRUE){
                //PRODUTO JÁ EXISTE
            } else {
                cadastra_fornecedor($for, $conn);
            }

        break;

        case 'ATUALIZAR';
            $prd = new produto();
            $prd->id = strtoupper(addslashes(filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT)));
            $prd->item = strtoupper(addslashes(filter_input(INPUT_POST, 'item', FILTER_SANITIZE_STRING)));
            $prd->cod_barras = strtoupper(addslashes(filter_input(INPUT_POST, 'cod_barras', FILTER_SANITIZE_NUMBER_INT)));
            $prd->fornecedor = strtoupper(addslashes(filter_input(INPUT_POST, 'fornecedor', FILTER_SANITIZE_STRING)));
            $prd->valor_compra = addslashes(filter_input(INPUT_POST, 'valor_compra',FILTER_SANITIZE_NUMBER_FLOAT));
            $prd->valor_venda = strtoupper(addslashes(filter_input(INPUT_POST, 'valor_venda', FILTER_SANITIZE_NUMBER_FLOAT)));
            $prd->quantidade = strtoupper(addslashes(filter_input(INPUT_POST, 'quantidade', FILTER_SANITIZE_NUMBER_INT)));
            $prd->embalagem = strtoupper(addslashes(filter_input(INPUT_POST, 'embalagem', FILTER_SANITIZE_STRING)));
            $prd->data_compra = strtoupper(addslashes(filter_input(INPUT_POST, 'data_compra')));
            atualiza_produto($prd, $conn);
        break;

        case 'ATUALIZAR2';
            $prd = new produto();
            $prd->id = strtoupper(addslashes(filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT)));
            $prd->item = strtoupper(addslashes(filter_input(INPUT_POST, 'item', FILTER_SANITIZE_STRING)));
            $prd->cod_barras = strtoupper(addslashes(filter_input(INPUT_POST, 'cod_barras', FILTER_SANITIZE_NUMBER_INT)));
            $prd->fornecedor = strtoupper(addslashes(filter_input(INPUT_POST, 'fornecedor', FILTER_SANITIZE_STRING)));
            $prd->valor_compra = addslashes(filter_input(INPUT_POST, 'valor_compra',FILTER_SANITIZE_NUMBER_FLOAT));
            $prd->valor_venda = strtoupper(addslashes(filter_input(INPUT_POST, 'valor_venda', FILTER_SANITIZE_NUMBER_FLOAT)));
            $prd->quantidade = strtoupper(addslashes(filter_input(INPUT_POST, 'quantidade', FILTER_SANITIZE_NUMBER_INT)));
            $prd->embalagem = strtoupper(addslashes(filter_input(INPUT_POST, 'embalagem', FILTER_SANITIZE_STRING)));
            $prd->data_compra = strtoupper(addslashes(filter_input(INPUT_POST, 'data_compra')));
            atualiza_produto2($prd, $conn);
        break;

        case 'ATUALIZAR_FOR';
            $for = new fornecedor();
            $for->id = strtoupper(addslashes(filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT)));
            $for->fornecedor = strtoupper(addslashes(filter_input(INPUT_POST, 'fornecedor', FILTER_SANITIZE_STRING)));
            $for->cidade = strtoupper(addslashes(filter_input(INPUT_POST, 'cidade', FILTER_SANITIZE_STRING)));
            atualiza_fornecedor($for, $conn);
        break;

        case 'DELETAR';
            $prd = addslashes(filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT));
            apaga_produto($prd, $conn);
        break;

        case 'APAGAR';
            $for = addslashes(filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT));
            apaga_fornecedor($for, $conn);
        break;

    }
} else {
    $_SESSION['msg'] = 'ACESSO NÃO AUTORIZADO<br>ERRO V4L1D4';
    header('location: ../pages/index.php');
}

?>
