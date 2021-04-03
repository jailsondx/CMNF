<?php
require 'require.php';

if ($_SESSION['log']) {
    //unset($_SESSION['log']);
} else {
    $_SESSION['msg'] = 'TENTATIVA DE ACESSO INADEQUADO AO SISTEMA';
    header('location: ../pages/index.php');
}
?>

<!-- MODAL REQUESTS-->
<!--
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
-->


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

                <a href="select_screen2.php"> <input type="button" class="btn btn-warning" id="btn-return" value="VOLTAR" name="VOLTAR"> </a>
                <input type="submit" class="btn btn-warning" id="btn" value="BUSCAR" name="BUSCAR">
            </div>
        </form>
    </div>

</div>

<!-- MODAL -->

<div class="modal fade" id="produtoModal" tabindex="-1" role="dialog" aria-labelledby="produtoModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="produtoModalLabel">Editar Produto</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="../functions/valida.php" name="Atualiza">
                    <div class="form-group">

                        <input type="hidden" class="form-control" id="recipient-id" name="id">

                        <label for="item">Item</label>
                        <input type="text" class="form-control" id="recipient-item" name="item" maxlength="250" autocomplete="off">

                        <label for="cod_barras">Codigo de Barras</label>
                        <input type="text" class="form-control" id="recipient-codbarras" name="cod_barras" maxlength="13" autocomplete="off">

                        <label for="fornecedor">Fornecedor</label>
                        <input type="text" class="form-control" id="recipient-fornecedor" name="fornecedor" maxlength="250" autocomplete="off">

                        <label for="valor_compra">Compra</label>
                        <input type="text" class="form-control" id="recipient-compra" name="valor_compra" placeholder="R$" maxlength="8" autocomplete="off">

                        <label for="valor_venda" id="txt_right">Venda</label>
                        <input type="text" class="form-control" id="recipient-venda" name="valor_venda" placeholder="R$" maxlength="8" autocomplete="off">

                        <label for="quantidade">Quantidade</label>
                        <input type="text" class="form-control" id="recipient-quantidade" name="quantidade" maxlength="9" autocomplete="off">

                        <label for="embalagem" id="txt_right">Embalagem</label>
                        <input type="text" class="form-control" id="recipient-embalagem" name="embalagem" maxlength="12" autocomplete="off">

                        <label for="data">Data da Compra</label>
                        <input type="date" class="form-control" id="recipient-datacompra" name="data_compra" maxlength="12" autocomplete="off">

                    </div>

            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-warning" value="ATUALIZAR2" name="CHECK">Salvar Atualização do Produto</button>
                <button type="submit" class="btn btn-danger" value="DELETAR" name="CHECK" onClick="return confirm('Deseja Realmente Apagar o Produto?')">Apagar Produto</button>
            </div>
            </form>
        </div>
    </div>
</div>


<!-- MODAL SCRIPT -->
<script>
    $('#produtoModal').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget) // Button that triggered the modal
        var recipient_id = button.data('id') // Extract info from data-* attributes
        var recipient_item = button.data('item')
        var recipient_codbarras = button.data('codbarras')
        var recipient_fornecedor = button.data('fornecedor')
        var recipient_compra = button.data('compra')
        var recipient_venda = button.data('venda')
        var recipient_quantidade = button.data('quantidade')
        var recipient_embalagem = button.data('embalagem')
        var recipient_datacompra = button.data('datacompra')
        // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
        // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
        var modal = $(this)
        //modal.find('.modal-title').text('Editar Produto')
        modal.find('#recipient-id').val(recipient_id)
        modal.find('#recipient-item').val(recipient_item)
        modal.find('#recipient-codbarras').val(recipient_codbarras)
        modal.find('#recipient-fornecedor').val(recipient_fornecedor)
        modal.find('#recipient-compra').val(recipient_compra)
        modal.find('#recipient-venda').val(recipient_venda)
        modal.find('#recipient-quantidade').val(recipient_quantidade)
        modal.find('#recipient-embalagem').val(recipient_embalagem)
        modal.find('#recipient-datacompra').val(recipient_datacompra)
    })
</script>