<?php
require 'require.php';

if ($_SESSION['log']) {
    //unset($_SESSION['log']);
} else {
    $_SESSION['msg'] = 'TENTATIVA DE ACESSO INADEQUADO AO SISTEMA';
    header('location: ../pages/index.php');
}

?>

<div class="container-box-screen">

    <a href="produto_busca.php">
        <div class="box">
            <div class="icon">
                <i class="fas fa-search"></i>
            </div>
            <div class="conteudo">
                <h2>Buscar Produto</h2>
            </div>
        </div>
    </a>

    <a href="produto_cadastro.php">
        <div class="box">
            <div class="icon">
                <i class="fas fa-box"></i>
            </div>
            <div class="conteudo">
                <h2>Cadastrar Produto</h2>
            </div>
        </div>
    </a>

    <a href="fornecedor_cadastro.php">
        <div class="box">
            <div class="icon">
                <i class="fas fa-address-card"></i>
            </div>
            <div class="conteudo">
                <h2>Cadastar Fornecedor</h2>
            </div>
        </div>
    </a>

</div>