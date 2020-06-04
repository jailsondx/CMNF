<?php
//REQUER O MPDF DO COMPOSER 
require '../composer/vendor/autoload.php';

define('HOST', 'localhost');
define('USER', 'root');
define('PASS', 'mortadela1@');
define('DBNAME', 'cmnf');

$conn = new PDO('mysql:host=' . HOST . ';dbname=' . DBNAME . ';', USER, PASS);
//Check Conexão
if (!$conn) {
    die("ERRO AO CONECTAR COM O BD MYSQLi ");
} else {
    //echo "CONEXÃO COM BD MYSQLi REALIZADA COM SUCESSO";
}

$inf_produto = "SELECT * FROM produtos ORDER BY item";
$resultado = $conn->prepare($inf_produto);
    $resultado->execute();
    $pagina .= "<h1 style='text-align: center'>RELATÓRIO DE DE PRODUTOS</h1>";
    $pagina .= "<h2 style='text-align: center'>Sistema CMNF</h2>";
    $pagina .= "<h3 style='text-align: center'>Cliente: Mercadinho Menino Deus</h3><hr>";
        while($row_result = $resultado->fetch(PDO::FETCH_ASSOC)){
            //VARIAVEL $PAGINA RECEBE TODOS OS ITENS DO BANCO DE DADOS
            $pagina .= "<h2>".$row_result['item']."</h2>";
            $pagina .= "Codigo de Barras: ".$row_result['cod_barras']."<br>";
            $pagina .= "Fornecedor: ".$row_result['fornecedor']."<br>";
            $pagina .= "Preço de Compra: R$".number_format($row_result['valor_compra']/100,2,",",".")."<br>";
            $pagina .= "Preço de Venda: R$".number_format($row_result['valor_venda']/100,2,",",".")."<br>";
            $pagina .= "Quantidade Cadastrada: ".$row_result['quantidade']."<br>";
            $pagina .= "Tipo de Embalagem: ".$row_result['embalagem']."<br>";
            $pagina .= "Data da Ultima Compra: ".implode("/",array_reverse(explode("-",$row_result['data_compra'])))."<br>"; //converte data em formato Brasileiro para Exibição
            $pagina .= "<hr>";
        }


$mpdf = new \Mpdf\Mpdf();
$css = file_get_contents('../css/css/style_pdf.css');
$mpdf->WriteHTML($css, \Mpdf\HTMLParserMode::HEADER_CSS);
$mpdf->WriteHTML($pagina, \Mpdf\HTMLParserMode::HTML_BODY);
$mpdf->Output();

?>