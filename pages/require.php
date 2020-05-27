<?php
//require "app/functions/pages.php"; 
require '../functions/functions.php';
require '../functions/database.php';

?>
<!DOCTYPE html>

<HTML lang="pt-br">

<HEAD>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <!-- JAVASCRIPT -->
  <script type="text/javascript" src="../js/jquery-3.5.1.min.js"></script>
  <script type="text/javascript" src="../js/jquery-ui.min.js"></script>
  <script type="text/javascript" src="../js/jquery.mask.min.js"></script>
  <script type="text/javascript" src="../js/bootstrap-datepicker.min.js"></script>
  <script type="text/javascript" src="../js/bootstrap-datepicker.pt-BR.min.js"></script>
  <script type="text/javascript" src="../css/bootstrap-4.4.1/js/bootstrap.js"></script>

  <!-- CSS -->
  <link rel="stylesheet" type="text/css" href="../css/bootstrap-4.4.1/css/bootstrap.css">
  <link rel="stylesheet" href="../css/font-awesome/css/all.css">
  <link rel="stylesheet" type="text/css" href="../css/css/style.css">
  <link rel="stylesheet" type="text/css" href="../css/jquery/jquery-ui.css">
  <link rel="stylesheet" type="text/css" href="../css/bootstrap-datepicker/bootstrap-datepicker.css">

  <!-- MATERIALIZE CSS
  <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link type="text/css" rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.98.0/css/materialize.min.css"/>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.98.0/js/materialize.min.js"></script>
  -->

  <!-- FAVICON -->
  <link rel="shortcut icon" href="../css/images/favicon.png" type="image/x-icon" />

  <!-- SCRIPTS DE MASCARA DE DINHEIRO E DE QUANTIDADE -->
  <script>
    $(document).ready(function() {
      $valor_compra = document.getElementsByName("valor_compra");
      $valor_venda = document.getElementsByName("valor_venda");
      $quantidade = document.getElementsByName("quantidade");
      $($valor_compra).mask("000.000,00", {
        reverse: true
      });
      $($valor_venda).mask("000.000,00", {
        reverse: true
      });
      $($quantidade).mask("000.000.000", {
        reverse: true
      });
    })
  </script>

  <!--  -->
  <TITLE>CMNF - Controle de Produto Não Fiscal</TITLE>
</HEAD>

<BODY>

<!-- MENU NAVBAR PARA MATERIALIZE
  <nav>
    <div class="nav-wrapper">
      <a href="#" class="brand-logo">Logo</a>
      <ul class="right hide-on-med-and-down">
        <li><a href="#">Angular</a></li>
        <li><a href="#">Ionic</a></li>
        <li><a href="#">TypeScript</a></li>
        <li><a href="#">Cordova</a></li>
      </ul>
    </div>
  </nav>
-->

  <div class="sessao">
    <?php
    if (isset($_SESSION['msg'])) {
      echo $_SESSION['msg'];
      unset($_SESSION['msg']);
    }
    ?>
  </div>