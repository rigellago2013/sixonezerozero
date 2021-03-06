<?php 
require('../../../fpdf/fpdf.php');
require ('../../../library/db.php');
//include 'function.php';

if(isset($_GET["start"]) && isset($_GET["end"])){
class PDF extends FPDF{
	function header(){
	$start = $_GET['start'];
	$end = $_GET['end'];
	$this->Image('../../../img/logo.png',10,6, 30);
    $this->SetFont('Arial','',14);
    $this->Cell(200,15,'Disposed Equipment',0,0,'C');
    $this->Ln();
     $this->SetFont('Arial','',11);
    $this->Cell(200,0, date('F d, Y', strtotime($start)).' - '.date('F d, Y', strtotime($end)), 0, 0, 'C');
    $this->Ln(15);	
	}
	function footer(){
		$this->SetY(-15);
		$this->SetFont('Arial', '', 8);
		$this->Cell(0, 10, 'Page'.$this->PageNo().'/{nb}',0,0,'C');
	}
	function headerTable(){
		$this->SetFont('Arial','', 11);
		$this->Cell(66,10,'Serial',1,0,'C');
		$this->Cell(66,10,'Date disposed',1,0,'C');
		$this->Cell(66,10,'Name',1,0,'C');

		$this->Ln();
	}
	function viewTable($connection){
		$this->setFont('Arial', '', 11);
		$start = $_GET['start'];
		$end = $_GET['end'];
		$q = $connection->prepare('SELECT * FROM tbl_equipment WHERE eqp_status = "DISPOSED" AND eqp_date_update BETWEEN :start AND :end ORDER BY eqp_name');
		$q->bindValue(':start', $start, PDO::PARAM_STR);
		$q->bindValue(':end', $end, PDO::PARAM_STR);
		$q->execute();
		while($data = $q->fetch(PDO::FETCH_OBJ)){

			$this->SetFont('Arial','', 11);
			$this->Cell(66,10,$data->eqp_serial,1,0,'L');
			$this->Cell(66,10,date('F d, Y', strtotime($data->eqp_date_update)),1,0,'L');
			$this->Cell(66,10,$data->eqp_name,1,0,'L');	
			$this->Ln();
		}
		}
}

$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage('P','Letter',0);
$pdf->headerTable();
$pdf->viewTable($connection);
$pdf->Output();
}

?>