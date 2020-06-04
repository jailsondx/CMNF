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
        $_SESSION['msg'] = 'ACESSO NÃO AUTORIZADO';
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
            //echo "<input type='button' class='btn btn-warning' id='btn-edit' value='EDITAR' name='EDITAR' data-toggle='modal' data-target='#exampleModal' data-whatever='".$row_result['item']."' >";
            editar_produto($row_result);
            echo "</div><br>";
        }
}

function editar_produto($row_result)
{
    echo "<input type='button' class='btn btn-warning' id='btn-edit' value='EDITAR' name='EDITAR' 
    data-toggle='modal' data-target='#exampleModal'
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

function apaga_produto($prd, $conn)
{
    $apagar_produto = "DELETE FROM produtos WHERE id = $prd"; //função deletar do mysql

    $apagar = $conn->prepare($apagar_produto);
    $apagar->bindParam(':id', $prd->id);
    

    if ($apagar->execute()) {
        $_SESSION['msg'] = "<p style = 'color: #e67e22;'> PRODUTO APAGADO COM SUCESSO</p>"; //Gera mensagem de cadastro OK
        header("Location: ../pages/produto_busca.php"); //direciona a mensagem para a pagina produto_busca.php
    } else {
        $_SESSION['msg'] = "<p style = 'color: RED;'> ERRO NA TENTATIVA DE EXCLUSÃO<br>VERIFIQUE OS DADOS </p>"; //Gera mensagem de erro no cadastro
        header("Location: ../pages/produto_busca.php"); //direciona a mensagem para a pagina produto_busca.php
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