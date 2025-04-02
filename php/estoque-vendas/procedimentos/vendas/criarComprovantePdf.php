<?php
// Carregar dompdf
require_once '../../lib/dompdf/autoload.inc.php';

use Dompdf\Dompdf;

$id=$_GET['idvenda']; // eh por get pq o id foi passado na url atraves do href em vendasrelatorios.php



 $html=file_get_contents("http://localhost/projetos/Sistema_Estoque_Vendas/view/vendas/comprovanteVendaPdf.php?idvenda=".$id);
 	// enviando o id e os conteúdos para esse documento

 
// Instanciamos um objeto da classe DOMPDF.
$pdf = new DOMPDF();
 
// Definimos o tamanho do papel e orientação.
$pdf->set_paper(array(0,0,125,250));
 
// Carregar o conteúdo html.
$pdf->load_html(utf8_decode($html));
 
// Renderizar PDF.
$pdf->render();
 
// Enviamos pdf para navegador. NOme q sera utilizado no arquivo
$pdf->stream('relatorioVenda.pdf');



