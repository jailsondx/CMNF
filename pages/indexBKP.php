<?php
require 'require.php';
?>
<div class="login">

</div>
<img src="../css/images/gif-load.gif" width="200px" height="200px">
<form method="POST" action="../functions/valida_login.php" name="Login">
  <div class="form-group">
    <label for="Login">Usuario</label><br>
    <input type="text" class="form-control" name="user">
    <br><br>
    <label for="password">senha</label><br>
    <input type="password" class="form-control" name="password">
    <br><br>
    <input type="submit" class="btn btn-warning" value="ENTRAR" name="ENTRAR">
  </div>
</form>