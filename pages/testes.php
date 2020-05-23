<!DOCTYPE html>
<html lang="pt">

<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- JAVASCRIPT -->

  <script type="text/javascript" src="../js/jquery-3.5.1.min.js"></script>
  <script type="text/javascript" src="../js/jquery-ui.min.js"></script>
  <script type="text/javascript" src="../js/jquery.mask.min.js"></script>
  <script type="text/javascript" src="../css/bootstrap-4.4.1/js/bootstrap.js"></script>

  <!-- CSS -->
  <link rel="stylesheet" type="text/css" href="../css/bootstrap-4.4.1/css/bootstrap.css">
  <link rel="stylesheet" href="../css/font-awesome/css/all.css">
  <link rel="stylesheet" type="text/css" href="../css/css/style.css">
  <link rel="stylesheet" type="text/css" href="../css/jquery/jquery-ui.css">
</head>

<body>
  <h1>CADASTRO DE PRODUTOS</h1>


  <label for="fornecedor">Fornecedor</label>
  <input type="text" class="form-control" name="fornecedor" id="fornecedor" maxlength="250" autocomplete="off">

  <a href="select_screen.php"> <input type="button" class="btn btn-warning" id="btn-return" value="VOLTAR" name="VOLTAR"> </a>
  <input type="submit" class="btn btn-warning" id="btn" value="CADASTRAR" name="CHECK">

  </div>
  </form>

  <script>
            $(function () {
                $("#fornecedor").autocomplete({
                    source: 'proc_busca_fornecedor.php'
                });
            });
        </script>
