<?php
require('../fpdf/fpdf.php');
include_once'../db/connect_db.php';

$id = $_GET['id'];
$select = $pdo->prepare("SELECT * FROM tbl_invoice WHERE invoice_id=$id");
$select->execute();
$row = $select->fetch(PDO::FETCH_OBJ);

$store = $pdo->prepare("SELECT * FROM tbl_storedetail");
$store->execute();
$row_store = $store->fetch(PDO::FETCH_OBJ);

$pdf = new FPDF('P','mm', array(80,200));

$pdf->AddPage();
$pdf->AddFont('deep','','Deep.php');
$pdf->SetFont('deep','',16);
$pdf->Cell(60,10,iconv( 'UTF-8','TIS-620',$row_store->name),0,1,"C");
//$pdf->Cell('UTF-8',60,10,'ร้านภูมิภักดิ์ช็อป',0,1,'C');

$pdf->Line(10,18,72,18);
$pdf->Line(10,19,72,19);

$pdf->SetFont('deep','',8);
$pdf->Cell(60,3,iconv( 'UTF-8','TIS-620','ที่อยู่: '.$row_store->address),0,1,"C");

$pdf->SetFont('deep','',8);
$pdf->Cell(60,3,iconv( 'UTF-8','TIS-620',$row_store->detail),0,1,"C");

$pdf->SetFont('deep','',8);
$pdf->Cell(63,4,iconv( 'UTF-8','TIS-620','โทร: '.$row_store->tel),0,1,"C");

$pdf->Line(10,30,72,30);
$pdf->Line(10,31,72,31);

$pdf->SetY(31);
$pdf->SetFont('deep','',10);
$pdf->Cell(60,6,iconv( 'UTF-8','TIS-620','หมายเหตุคำสั่งซื้อ'),0,1,"C");

$pdf->SetFont('deep','',8);
$pdf->Cell(20,4,iconv( 'UTF-8','TIS-620','หมายเลขคำสั่งซื้อ'),0,0,"C");

$pdf->SetFont('deep','',8);
$pdf->Cell(10,4 ,$row->invoice_id,0,1,'C');

$pdf->SetFont('deep','',8);
$pdf->Cell(20,4,iconv( 'UTF-8','TIS-620','ชื่อพนักงาน'),0,0,"C");

$pdf->SetFont('deep','',8);
$pdf->Cell(10,4,iconv( 'UTF-8','TIS-620',$row->cashier_name),0,1,"C");

$pdf->SetFont('deep','',8);
$pdf->Cell(20,4,iconv( 'UTF-8','TIS-620','วันที่ & ชั่วโมง'),0,0,"C");

$pdf->SetFont('deep','',8);
$pdf->Cell(21,4 ,$row->order_date,0,0,'C');

$pdf->SetFont('deep','',8);
$pdf->Cell(10,4 ,$row->time_order,0,1,'C');
//////////////////////////////////////////////
$pdf->SetY(55);

$pdf->SetX(6);
$pdf->SetFont('deep','',8);
$pdf->Cell(27,8,iconv( 'UTF-8','TIS-620','สินค้า'),1,0,"C");
$pdf->SetFont('deep','',8);
$pdf->Cell(7,8,iconv( 'UTF-8','TIS-620','จำนวน'),1,0,"C");
$pdf->SetFont('deep','',8);
$pdf->Cell(18,8,iconv( 'UTF-8','TIS-620','ราคา'),1,0,"C");
$pdf->SetFont('deep','',8);
$pdf->Cell(18,8,iconv( 'UTF-8','TIS-620','รวม'),1,1,"C");

$select = $pdo->prepare("SELECT * FROM tbl_invoice_detail WHERE invoice_id=$id");
$select->execute();
while($item = $select->fetch(PDO::FETCH_OBJ)){
    $pdf->SetX(6);
    $pdf->SetFont('deep','',8);
    $pdf->Cell(27,5,$item->product_name,1,0,'L');
    $pdf->Cell(7,5,$item->qty,1,0,'C');
    $pdf->SetFont('deep','',7);
    $pdf->Cell(18,5,iconv( 'UTF-8','TIS-620',number_format($item->price).' บาท'),1,0,"R");
    $pdf->Cell(18,5,iconv( 'UTF-8','TIS-620',number_format($item->total).' บาท'),1,1,"R");
}

//////////////////////////////////////////////
$pdf->SetX(43);
$pdf->SetFont('deep','',8);
$pdf->Cell(25,8,iconv( 'UTF-8','TIS-620','รวม  :'),0,0,"C");

$pdf->SetFont('deep','',7);
$pdf->Cell(1,8,iconv( 'UTF-8','TIS-620',number_format($row->total).' บาท'),0,1,"C");

$pdf->SetX(43);
$pdf->SetFont('deep','',7);
$pdf->Cell(25,4,iconv( 'UTF-8','TIS-620','จ่าย  :'),0,0,"C");

$pdf->SetFont('deep','',7);
$pdf->Cell(1,4,iconv( 'UTF-8','TIS-620',number_format($row->paid).' บาท'),0,1,"C");

$pdf->SetX(43);
$pdf->SetFont('deep','',8);
$pdf->Cell(25,8,iconv( 'UTF-8','TIS-620','ได้รับ  :'),0,0,"C");

$pdf->SetFont('deep','',7);
$pdf->Cell(1,8,iconv( 'UTF-8','TIS-620',number_format($row->due).' บาท'),0,1,"C");

//////////////////////////////////////////////
$pdf->SetY(120);
$pdf->SetX(7);
$pdf->SetFont('deep','',5);
$pdf->Cell(75,4,iconv( 'UTF-8','TIS-620','ไม่รับคืนสินค้าหากไม่มีบันทึกการซื้อ'),0,1,"L");

$pdf->SetFont('deep','',5);
$pdf->Cell(45,4,iconv( 'UTF-8','TIS-620','รับคืนสินค้าได้สูงสุด 3 วันหลังการซื้อ'),0,1,"L");




$pdf->Output();
