<!-- MENU -->
<nav class="navbar navbar-expand-lg navbar-dark" style="background-color: #e67e22;">
   <!-- <span class="navbar-toggler-icon"></span>   -->
    <div class="navbar-brand">CMNF</div>
    <div class="collapse navbar-collapse" id="conteudoNavbarSuportado">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Relatórios
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="gera_pdf_produtos.php" target="_blank">Produtos</a>
                    <a class="dropdown-item" href="gera_pdf_fornecedores.php" target="_blank">Fornecedores</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="fornecedor_busca2.php" target="_blank">Buscar Fornecedor</a>
                </div>
            </li>

        </ul>

    </div>
</nav>
<!-- ---------------------------------------------------------------------- -->


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

    <a href="produto_busca2.php">
        <div class="box">
            <div class="icon">
                <i class="fas fa-box"></i>
            </div>
            <div class="conteudo">
                <h2>Buscar Produto</h2>
            </div>
        </div>
    </a>

</div>

