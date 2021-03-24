<?php
//Verificação de Sessão
require 'require.php';

if ($_SESSION['log']) {
    //unset($_SESSION['log']);
} else {
    $_SESSION['msg'] = 'TENTATIVA DE ACESSO INADEQUADO AO SISTEMA';
    header('location: ../pages/index.php');
}
//FIM SESSÃO
?>

<div class="buscar-box">
    <div class="textbox">
        <h1>LISTA DE FORNECEDORES</h1>
        <?php
            allfornecedor($conn);
        ?>
        <a href="select_screen.php"> <input type="button" class="btn btn-warning" id="btn-return-xl" value="VOLTAR" name="VOLTAR"> </a>
    </div>
</div>

<!-- MODAL -->

<div class="modal fade" id="fornecedorModal" tabindex="-1" role="dialog" aria-labelledby="fornecedorModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="fornecedorModalLabel">Editar fornecedor</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="../functions/valida.php" name="Atualiza">
                    <div class="form-group">

                        <input type="hidden" class="form-control" id="recipient-id" name="id">

                        <label for="fornecedor">Fornecedor</label>
                        <input type="text" class="form-control" id="recipient-fornecedor" name="fornecedor" maxlength="250" autocomplete="off">

                        <label for="cidade">Cidade</label>
                        <input type="text" class="form-control" id="recipient-cidade" name="cidade" maxlength="13" autocomplete="off">

                    </div>

            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-warning" value="ATUALIZAR_FOR" name="CHECK">Salvar Atualização do fornecedor</button>
                <button type="submit" class="btn btn-danger" value="APAGAR" name="CHECK" onClick="return confirm('Deseja Realmente Apagar o fornecedor?')">Apagar fornecedor</button>
            </div>
            </form>
        </div>
    </div>
</div>


<!-- MODAL SCRIPT -->
<script>
    $('#fornecedorModal').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget) // Button that triggered the modal
        var recipient_id = button.data('id') // Extract info from data-* attributes
        var recipient_fornecedor = button.data('fornecedor')
        var recipient_cidade = button.data('cidade')
        
        // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
        // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
        var modal = $(this)
        //modal.find('.modal-title').text('Editar fornecedor')
        modal.find('#recipient-id').val(recipient_id)
        modal.find('#recipient-fornecedor').val(recipient_fornecedor)
        modal.find('#recipient-cidade').val(recipient_cidade)
    })
</script>