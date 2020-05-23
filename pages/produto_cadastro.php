<?php
require 'require.php';

if ($_SESSION['log']) {
    //unset($_SESSION['log']);
} else {
    $_SESSION['msg'] = 'TENTATIVA DE ACESSO INADEQUADO AO SISTEMA';
    header('location: ../pages/index.php');
}
?>


<div class="cadastro-box">
    <div class="textbox">
        <h1>CADASTRO DE PRODUTOS</h1>
        <form method="POST" action="../functions/valida.php" name="Login">
            <div class="form-group">

                <label for="item">Item</label>
                <input type="text" class="form-control" name="item" maxlength="250" autocomplete="off" required>

                <label for="cod_barras">Codigo de Barras</label>
                <input type="text" class="form-control" name="cod_barras" maxlength="13" autocomplete="off" required>

                <label for="fornecedor">Fornecedor</label>
                <input type="text" class="form-control" name="fornecedor" id="fornecedor" maxlength="250" autocomplete="off">

                <label for="valor_compra">Compra</label>
                <input type="text" class="form-control" id="pos_left" name="valor_compra" placeholder="R$" maxlength="8" autocomplete="off" required>

                <label for="valor_venda" id="txt_right">Venda</label>
                <input type="text" class="form-control" id="pos_right" name="valor_venda" placeholder="R$" maxlength="8" autocomplete="off" required>

                <label for="quantidade">Quantidade</label>
                <input type="text" class="form-control" id="pos_left" name="quantidade" maxlength="9" autocomplete="off">

                <label for="embalagem" id="txt_right">Embalagem</label>
                <input type="text" class="form-control" id="pos_right" name="embalagem" maxlength="12" autocomplete="off">

                <label for="data">Data da Compra</label>
                <input type="text" class="form-control datepicker" name="data_compra" maxlength="12" autocomplete="off">

                <a href="select_screen.php"> <input type="button" class="btn btn-warning" id="btn-return" value="VOLTAR" name="VOLTAR"> </a>
                <input type="submit" class="btn btn-warning" id="btn" value="CADASTRAR" name="CHECK">

            </div>
        </form>

        <!-- SCRIPT DO CALENDÁRIO PARA DATA DA COMPRA -->
        <script>
            $(function() {
                $(".datepicker").datepicker({
                    format: "dd/mm/yyyy",
                    language: "pt-BR"
                });
            });
        </script>

        <!-- SCRIPT DE AUTOCOMPLETE DO FORNECEDOR -->
        <script>
            $(function() {
                $("#fornecedor").autocomplete({
                    source: "../functions/autocomplete_fornecedor.php"
                });
            });
        </script>

    </div>

</div>