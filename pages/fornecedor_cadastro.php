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
        <h1>REGISTRO DE FORNECEDORES</h1>
        <form method="POST" action="../functions/valida.php" name="Login">
            <div class="form-group">

                <label for="item">Fornecedor</label>
                <input type="text" class="form-control" name="fornecedor" maxlength="250" autocomplete="off" required>

                <label for="fornecedor">Cidade</label>
                <input type="text" class="form-control" name="cidade" maxlength="250" autocomplete="off">

                <a href="select_screen.php"> <input type="button" class="btn btn-warning" id="btn-return" value="VOLTAR" name="VOLTAR"> </a>
                <input type="submit" class="btn btn-warning" id="btn" value="REGISTRAR" name="CHECK">
          
            </div>
        </form>
    </div>
   
</div>