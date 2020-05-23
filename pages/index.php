<?php
require 'require.php';
?>
<div class="login-box">
  <h1>Login</h1>
  <div class="form-group">
    <form method="POST" action="../functions/valida.php" name="Login">
      <div class="textbox">
      <img src="../css/font-awesome/svgs/regular/user.svg" id="icon_user">
        <input type="text" class="form-control" placeholder="USUARIO" name="user" autocomplete="off">
      </div>
      <div class="textbox">
      <img src="../css/font-awesome/svgs/regular/eye-slash.svg" id="icon_pass">
        <input type="password" class="form-control" placeholder="SENHA" name="password" autocomplete="off">
      </div>
      <input type="submit" class="btn btn-warning" value="LOGAR" id="btn" name="CHECK">
  </div>
</div>
</form>