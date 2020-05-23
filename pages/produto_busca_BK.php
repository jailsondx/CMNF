<?php
require 'require.php';
?>

<!-- MODAL REQUESTS-->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>


<div class="buscar-box">
    <div class="textbox">
        <h1>PESQUISA DE PRODUTOS</h1>
        <form method="POST" action="" name="Pesquisa">
            <div class="form-group">

                <input type="text" class="form-control" id="search" name="search" maxlength="250" autocomplete="off" placeholder="DESCRIÇÃO OU CODIGO DE BARRAS">
                        
                        <?php
                        $busca = strtoupper(filter_input(INPUT_POST, 'search', FILTER_SANITIZE_STRING));
                        if ($busca) {
                            busca_produto($busca, $conn);
                        }
                        ?>
                    
                <a href="select_screen.php"> <input type="button" class="btn btn-warning" id="btn-return" value="VOLTAR" name="VOLTAR"> </a>
                <input type="submit" class="btn btn-warning" id="btn" value="BUSCAR" name="BUSCAR">
            </div>
        </form>
    </div>
    
</div>

<!-- MODAL -->

<div class="modal fade" id="modal_busca" tabindex="-1" role="dialog" aria-labelledby="modal_buscaLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="modal_buscaLabel">EDITAR PRODUTO</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">


                <form method="POST" action="../functions/valida.php" name="Login">
                    <div class="form-group">

                        <label for="item">Item</label>
                        <input type="text" class="form-control" name="item" maxlength="250" autocomplete="off">

                        <label for="cod_barras">Codigo de Barras</label>
                        <input type="text" class="form-control" name="cod_barras" maxlength="13" autocomplete="off">

                        <label for="fornecedor">Fornecedor</label>
                        <input type="text" class="form-control" name="fornecedor" maxlength="250" autocomplete="off">

                        <label for="valor_compra">Compra</label>
                        <input type="text" class="form-control" id="pos_left" name="valor_compra" placeholder="R$" maxlength="8" autocomplete="off">

                        <label for="valor_venda" id="txt_right">Venda</label>
                        <input type="text" class="form-control" id="pos_right" name="valor_venda" placeholder="R$" maxlength="8" autocomplete="off">

                        <label for="quantidade">Quantidade</label>
                        <input type="number" class="form-control" id="pos_left" name="quantidade" maxlength="9" autocomplete="off">

                        <label for="embalagem" id="txt_right">Embalagem</label>
                        <input type="text" class="form-control" id="pos_right" name="embalagem" maxlength="12" autocomplete="off">

                        <label for="data">Data da Compra</label>
                        <input type="date" class="form-control" name="data_compra" maxlength="12" autocomplete="off">


                    </div>



            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-warning">Salvar Atualização do Produto</button>
                </form>
            </div>
        </div>
    </div>
</div>