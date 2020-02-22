<?php
//http://www.v-espino.com/~chema/daw2/factura_en_pdf.html
ob_start();
error_reporting(1);
ini_set("session.auto_start", 0);
$this->load->library('fpdf');
define('FPDF_FONTPATH', 'application/libraries/font/');
ob_end_clean();
//inicializa pagina pdf
$this->fpdf->Open();
//$pdf = new FPDF('L','cm',array(29.700,21));
$pdf = new FPDF('L', 'mm', 'A4');
$pdf->SetTextColor(0, 0, 0);
$pdf->AddPage();
//$pdf->Image('img/Certificado_semana_saber2019.png', 0, 0, 297, 210, 'JPG');
//$pdf = new FPDF('L','cm',array(29.700,21));

// escaping, additionally removing everything that could be (html/javascript-) code
$evento = 'hola';
setlocale(LC_TIME, "spanish");
$pdf->SetFont('helvetica', '', 10);
$linea = $i * 5 + 117;

$pdf->Text(30, $linea, "# " . $evento);
$e = $i * 4;
$linea2 = $linea + 10;

$fecha = date(y - m - d);
$dia = date('d', strtotime($fecha));
$mes = date('F', strtotime($fecha));
$mes = strftime("%B", strtotime($fecha));
$anio = date('Y', strtotime($fecha));

$pdf->SetFont('times', 'I', 26);
//$pdf->Text(85, 100, $nombre . " " . $apellido);

// texxto participacion
$linea1 = 'Por haber asistido a la "4ta Edición de la SEMANA DEL SABER" con una carga horaria de ' . $e . 'h. y participado en la/s ';
$linea2 = ' siguiente/s charla/s: ';
$pdf->SetFont('helvetica', 'I', 13);
$pdf->Text(30, 110, $linea1);
$pdf->Text(30, 116, $linea2);


// fecha evento
$lugar = 'Itauguá';
$pdf->SetFont('helvetica', '', 13);
//$pdf->Text(205,142,$lugar.",  ".$mes." de ".$anio);
$pdf->Text(193, 142, $lugar . ",  " . $dia . " de " . $mes . " de " . $anio);

//salida archivo pdf
$pdf->Output($lugar . '_certificado_SemSaber_2019.pdf', 'I');


ob_end_flush();
