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
        <?php
            allfornecedor($conn);
        ?>
    </div>
    <a href="select_screen.php"> <input type="button" class="btn btn-warning" id="btn-return-xl" value="VOLTAR" name="VOLTAR"> </a>
</div>