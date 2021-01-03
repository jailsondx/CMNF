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

//CABEÇALHO DO PDF
$pagina .= "<h1 style='text-align: center'>RELATÓRIO DE FORNECEDORES</h1>";
$pagina .= "<h2 style='text-align: center'>Sistema CMNF</h2>";
$pagina .= "<h3 style='text-align: center'>Cliente: Mercadinho Menino Deus</h3><hr>";

//VARIAVEL $PAGINA RECEBE TODOS OS ITENS DO BANCO DE DADOS

$inf_for = "SELECT fornecedor FROM fornecedor ORDER BY fornecedor";
$fornecedor = $conn->prepare($inf_for);
$fornecedor->execute();

$title = 'null';

while ($cont_fornecedor = $fornecedor->fetch(PDO::FETCH_ASSOC)){
    $inf_produto = "SELECT * FROM produtos INNER JOIN fornecedor ON produtos.fornecedor = fornecedor.fornecedor WHERE fornecedor.fornecedor LIKE '$cont_fornecedor[fornecedor]'  ORDER BY item";
    $resultado = $conn->prepare($inf_produto);
    $resultado->execute();
    
        foreach ($resultado as $row_result) {
            if($title == 'null'){
                $title = "<h2 style='background-color:powderblue;'>FORNECEDOR: ".$cont_fornecedor['fornecedor']."</h2>";
                $pagina .=  $title;
                $pagina .= "<table border=0 >
                                <tr style='background-color: #ecf0f1;'>
                                    <td width=810px> ITEM </td>
                                    <td width=100px style='text-align: center;'> COMPRA </td>
                                    <td width=100px style='text-align: center;'> VENDA </td>
                                </tr>
                            </table>";
            }
            
            if ($cont_fornecedor['fornecedor'] == $row_result['fornecedor']) {
                $pagina .= "<table border=0 >
                                <tr>
                                    <td width=810px>" . $row_result['item'] . "</td>
                                    <td width=100px style='text-align: center;'>R$ " . number_format($row_result['valor_compra'] / 100, 2, ",", ".") .  "</td>
                                    <td width=100px style='text-align: center;'>R$ " . number_format($row_result['valor_venda'] / 100, 2, ",", ".") . "</td>
                                </tr>
                            </table>";
            } //FIM IF
        } //FIM FOREACH
        $title = 'null';
    }//FIM WHILE




$mpdf = new \Mpdf\Mpdf(['orientation' => 'L']);
$css = file_get_contents('../css/css/style_pdf.css');
$mpdf->WriteHTML($css, \Mpdf\HTMLParserMode::HEADER_CSS);
$mpdf->WriteHTML($pagina, \Mpdf\HTMLParserMode::HTML_BODY);
$mpdf->Output();



