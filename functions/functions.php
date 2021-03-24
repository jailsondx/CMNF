<?php
session_start();

/* CLASSES */

class produto
{
    public $item;
    public $cod_barras;
    public $fornecedor;
    public $valor_compra;
    public $valor_venda;
    public $quantidade;
    public $embalagem;
    public $data;
}

class fornecedor
{
    public $fornecedor;
    public $cidade;
}

/* FUNÇÕES */

function valida_login($user, $pass, $conn)
{
    $login = "SELECT * FROM users WHERE usuario LIKE '$user' LIMIT 1";
    $resultado = $conn->prepare($login);
    $resultado->execute();

    $row_result = $resultado->fetch(PDO::FETCH_ASSOC);

    if (($row_result['usuario'] == $user) && ($row_result['senha'] == $pass)) {
        //echo $row_result['usuario'];
        //echo $row_result['senha'];
        $url = '../pages/select_screen.php';
        $_SESSION['log'] = 'LOGIN REALIZADO';
        header('location: ' . $url);
    } else {
        $_SESSION['msg'] = 'ACESSO NÃO AUTORIZADO<br>ERRO L0G1N';
        header('Location: ../pages/index.php');
    }
}

function cadastra_produto($prd, $conn)
{
    $cad_produto = "INSERT INTO produtos (item, cod_barras, fornecedor, valor_compra, valor_venda, quantidade, embalagem, data_compra) VALUE (:item, :cod_barras, :fornecedor, :valor_compra, :valor_venda, :quantidade, :embalagem, :data_compra)"; //função inserir do mysql

    $inserir = $conn->prepare($cad_produto);
    $inserir->bindParam(':item', $prd->item);
    $inserir->bindParam(':cod_barras', $prd->cod_barras);
    $inserir->bindParam(':fornecedor', $prd->fornecedor);
    $inserir->bindParam(':valor_compra', $prd->valor_compra);
    $inserir->bindParam(':valor_venda', $prd->valor_venda);
    $inserir->bindParam(':quantidade', $prd->quantidade);
    $inserir->bindParam(':embalagem', $prd->embalagem);
    $inserir->bindParam(':data_compra', $prd->data_compra);

    if ($inserir->execute()) {
        $_SESSION['msg'] = "<p style = 'color: #e67e22;'> CADASTRO REALIZADO </p>"; //Gera mensagem de cadastro OK
        header("Location: ../pages/produto_cadastro.php"); //direciona a mensagem para a pagina: produto_cadastro.php
    } else {
        $_SESSION['msg'] = "<p style = 'color: RED;'> ERRO NA TENTATIVA DE CADASTRO<br>VERIFIQUE OS DADOS </p>"; //Gera mensagem de erro no cadastro
        header("Location: ../pages/produto_cadastro.php"); //direciona a mensagem para a pagina: produto_cadastro.php
        
    }
}

function verifica_codbarras($cod_barras, $conn)
{
    $inf_produto = "SELECT cod_barras FROM produtos WHERE cod_barras LIKE '$cod_barras' LIMIT 1";
    //$inf_produto = "SELECT * FROM produtos WHERE cod_barras LIKE '$busca' LIMIT 5";  
    //$inf_produto = "SELECT * FROM produtos WHERE item LIKE '%$busca%' LIMIT 5"; 
    $resultado = $conn->prepare($inf_produto);
    $resultado->execute();
    $row_result = $resultado->fetch(PDO::FETCH_ASSOC);

    if ($row_result['cod_barras'] == $cod_barras) {
        //$_SESSION['msg'] = "<p style = 'color: #e67e22;'> PRODUTO JÁ EXISTE </p>"; //Gera mensagem de produto já existente
        $_SESSION['msg'] = "<script>alert('PRODUTO JÁ EXISTE! Verifique na Busca de Produtos');</script>"; //Gera mensagem ALERT de produto já existente
        header("Location: ../pages/produto_cadastro.php"); //direciona a mensagem para a pagina produto_cadastro.php
        return TRUE;
    } else {
        return FALSE;
    }
}

function verifica_fornecedor($fornecedor, $conn)
{
    $inf_produto = "SELECT fornecedor FROM fornecedor WHERE fornecedor LIKE '$fornecedor' LIMIT 1";
    $resultado = $conn->prepare($inf_produto);
    $resultado->execute();
    $row_result = $resultado->fetch(PDO::FETCH_ASSOC);

    if ($row_result['fornecedor'] == $fornecedor) {
        //$_SESSION['msg'] = "<p style = 'color: #e67e22;'> PRODUTO JÁ EXISTE </p>"; //Gera mensagem de produto já existente
        $_SESSION['msg'] = "<script>alert('FORNECEDOR JÁ CADASTRADO!');</script>"; //Gera mensagem ALERT de fornecedor já existente
        header("Location: ../pages/fornecedor_cadastro.php"); //direciona a mensagem para a pagina cornecedor_cadastro.php
        return TRUE;
    } else {
        return FALSE;
    }
}

function cadastra_fornecedor($for, $conn)
{
    $cad_fornecedor = "INSERT INTO fornecedor (fornecedor, cidade) VALUE (:fornecedor, :cidade)"; //função inserir do mysql

    $inserir = $conn->prepare($cad_fornecedor);
    $inserir->bindParam(':fornecedor', $for->fornecedor);
    $inserir->bindParam(':cidade', $for->cidade);
    
    if ($inserir->execute()) {
        $_SESSION['msg'] = "<p style = 'color: #e67e22;'> FORNECEDOR REGISTRADO </p>"; //Gera mensagem de cadastro OK
        header("Location: ../pages/fornecedor_cadastro.php"); //direciona a mensagem para a pagina cadastropet.php
    } else {
        $_SESSION['msg'] = "<p style = 'color: RED;'> ERRO NA TENTATIVA DE REGISTRO<br>VERIFIQUE OS DADOS </p>"; //Gera mensagem de erro no cadastro
        header("Location: ../pages/fornecedor_cadastro.php"); //direciona a mensagem para a pagina cadastropet.php
    }
}

function busca_produto($busca, $conn)
{
    $inf_produto = "SELECT * FROM produtos WHERE item LIKE '%".$busca."%' OR cod_barras LIKE '$busca' LIMIT 5";
    //$inf_produto = "SELECT * FROM produtos WHERE cod_barras LIKE '$busca' LIMIT 5";  
    //$inf_produto = "SELECT * FROM produtos WHERE item LIKE '%$busca%' LIMIT 5"; 
    $resultado = $conn->prepare($inf_produto);
    $resultado->execute();

        while($row_result = $resultado->fetch(PDO::FETCH_ASSOC)){
            echo "<div class='resultados-box'>";
            echo "<h1>".$row_result['item']."</h1>";
            echo "<p style = 'color: #d2dae2;'>Preço de compra: R$ ".number_format($row_result['valor_compra']/100,2,",",".")."<br>";
            echo "Preço de venda: R$ ".number_format($row_result['valor_venda']/100,2,",",".")."<br>";
            echo "<br>Vendido por: ".$row_result['fornecedor']."<br></p>";
            //echo "<input type='button' class='btn btn-warning' id='btn-edit' value='EDITAR' name='EDITAR' data-toggle='modal' data-target='#produtoModal' data-whatever='".$row_result['item']."' >";
            editar_produto($row_result);
            echo "</div><br>";
        }
}

function editar_produto($row_result)
{
    echo "<input type='button' class='btn btn-warning' id='btn-edit' value='EDITAR' name='EDITAR' 
    data-toggle='modal' data-target='#produtoModal'
    data-id='".$row_result['id']."' 
    data-item='".$row_result['item']."' 
    data-codbarras='".$row_result['cod_barras']."'
    data-fornecedor='".$row_result['fornecedor']."'
    data-compra='".number_format($row_result['valor_compra']/100,2,",",".")."'
    data-venda='".number_format($row_result['valor_venda']/100,2,",",".")."'
    data-quantidade='".$row_result['quantidade']."'
    data-embalagem='".$row_result['embalagem']."'
    data-datacompra='".$row_result['data_compra']."'
    >";
}

function editar_fornecedor($row_result)
{
    echo "<input type='button' class='btn btn-warning' id='btn-edit' value='EDITAR' name='EDITAR' 
    data-toggle='modal' data-target='#fornecedorModal'
    data-id='".$row_result['id']."' 
    data-fornecedor='".$row_result['fornecedor']."' 
    data-cidade='".$row_result['cidade']."'
    >";
}

function atualiza_produto($prd, $conn)
{
    $atualiza_produto = "UPDATE produtos SET item=:item, cod_barras=:cod_barras, fornecedor=:fornecedor, 
                        valor_compra=:valor_compra, valor_venda=:valor_venda, quantidade=:quantidade, 
                        embalagem=:embalagem, data_compra=:data_compra WHERE id=:id"; //função inserir do mysql

    $atualizar = $conn->prepare($atualiza_produto);
    $atualizar->bindParam(':id', $prd->id);
    $atualizar->bindParam(':item', $prd->item);
    $atualizar->bindParam(':cod_barras', $prd->cod_barras);
    $atualizar->bindParam(':fornecedor', $prd->fornecedor);
    $atualizar->bindParam(':valor_compra', $prd->valor_compra);
    $atualizar->bindParam(':valor_venda', $prd->valor_venda);
    $atualizar->bindParam(':quantidade', $prd->quantidade);
    $atualizar->bindParam(':embalagem', $prd->embalagem);
    $atualizar->bindParam(':data_compra', $prd->data_compra);
    

    if ($atualizar->execute()) {
        $_SESSION['msg'] = "<p style = 'color: #e67e22;'> ATUALIZAÇÃO REALIZADA </p>"; //Gera mensagem de cadastro OK
        header("Location: ../pages/produto_busca.php"); //direciona a mensagem para a pagina produto_busca.php
    } else {
        $_SESSION['msg'] = "<p style = 'color: RED;'> ERRO NA TENTATIVA DE ATUALIZAÇÃO<br>VERIFIQUE OS DADOS </p>"; //Gera mensagem de erro no cadastro
        header("Location: ../pages/produto_busca.php"); //direciona a mensagem para a pagina produto_busca.php
    }
}

function atualiza_fornecedor($for, $conn)
{
    $atualiza_fornecedor = "UPDATE fornecedor SET fornecedor=:fornecedor, cidade=:cidade WHERE id=:id"; //função inserir do mysql

    $atualizar = $conn->prepare($atualiza_fornecedor);
    $atualizar->bindParam(':id', $for->id);
    $atualizar->bindParam(':fornecedor', $for->fornecedor);
    $atualizar->bindParam(':cidade', $for->cidade);
    

    if ($atualizar->execute()) {
        $_SESSION['msg'] = "<p style = 'color: #e67e22;'> ATUALIZAÇÃO REALIZADA </p>"; //Gera mensagem de cadastro OK
        header("Location: ../pages/fornecedor_busca.php"); //direciona a mensagem para a pagina produto_busca.php
    } else {
        $_SESSION['msg'] = "<p style = 'color: RED;'> ERRO NA TENTATIVA DE ATUALIZAÇÃO<br>VERIFIQUE OS DADOS </p>"; //Gera mensagem de erro no cadastro
        header("Location: ../pages/fornecedor_busca.php"); //direciona a mensagem para a pagina produto_busca.php
    }
}

function apaga_produto($prd, $conn)
{
    $apagar_produto = "DELETE FROM produtos WHERE id = $prd"; //função deletar do mysql

    $apagar = $conn->prepare($apagar_produto);
    $apagar->bindParam(':id', $prd->id);
    

    if ($apagar->execute()) {
        $_SESSION['msg'] = "<p style = 'color: #e67e22;'> PRODUTO APAGADO COM SUCESSO</p>"; //Gera mensagem de cadastro OK
        header("Location: ../pages/produto_busca.php"); //direciona a mensagem para a pagina produto_busca.php
    } else {
        $_SESSION['msg'] = "<p style = 'color: RED;'> ERRO NA TENTATIVA DE EXCLUSÃO<br>ERRO PR0DUCT</p>"; //Gera mensagem de erro no cadastro
        header("Location: ../pages/produto_busca.php"); //direciona a mensagem para a pagina produto_busca.php
    }
}

function apaga_fornecedor($for, $conn)
{
    $apagar_fornecedor = "DELETE FROM fornecedor WHERE id = $for"; //função deletar do mysql

    $apagar = $conn->prepare($apagar_fornecedor);
    $apagar->bindParam(':id', $for->id);
    

    if ($apagar->execute()) {
        $_SESSION['msg'] = "<p style = 'color: #e67e22;'> FORNECEDOR APAGADO COM SUCESSO</p>"; //Gera mensagem de cadastro OK
        header("Location: ../pages/fornecedor_del.php"); //direciona a mensagem para a pagina produto_busca.php
    } else {
        $_SESSION['msg'] = "<p style = 'color: RED;'> ERRO NA TENTATIVA DE EXCLUSÃO<br>ERRO F0N3C3D0R</p>"; //Gera mensagem de erro no cadastro
        header("Location: ../pages/fornecedor_del.php"); //direciona a mensagem para a pagina produto_busca.php
    }
}


function allproducts($conn){
    $sql = "SELECT * FROM produto ORDER BY item";
    $resultado = $conn->prepare($sql);
    $resultado->execute();

        while($row_result = $resultado->fetch(PDO::FETCH_ASSOC)){
            $grupo = $row_result['item'];
        }
    return $grupo;
}

function allfornecedor($conn){
    //LISTA TODOS OS FORNECEDORES DO BD
    $sql = "SELECT * FROM fornecedor ORDER BY fornecedor";
    $resultado = $conn->prepare($sql);
    $resultado->execute();

    while($row_result = $resultado->fetch(PDO::FETCH_ASSOC)){
        echo "<div class='resultados-box'>";
        echo "<form method='POST' action='../functions/valida.php' name='ATUALIZA'>";
        echo "<h1>".$row_result['fornecedor']."</h1>";
        echo "<p style = 'color: #d2dae2;'>Cidade: ".$row_result['cidade']."</p>";
        echo "<input type='hidden' class='form-control' id='recipient-id' name='id' value='".$row_result['id']."'>";
        //echo "<input type='submit' class='btn btn-warning' id='btn-edit' value='APAGAR' name='CHECK'>";
        //echo "<div class='modal-footer'> <button type='submit' class='btn btn-danger' value='APAGAR' name='CHECK' onClick='return confirm('Deseja Realmente Apagar o Fornecedor?')'>Apagar Fornecedor</button> </div>";
        
        echo "ID: ".$row_result['id']."";
        editar_fornecedor($row_result);
        echo "</div><br>";
    }
}