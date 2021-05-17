<?php
    include_once'db/connect_db.php';
    session_start();
    if(!isset($_SESSION['role'])){
        header('location:index.php');
    }
   if($_SESSION['role']!=="Admin"){
     header('location:index.php');
   }else{
       include_once'inc/header_all.php';
   }

    error_reporting(0);

    $id = $_GET['id'];

    $delete_query = "DELETE tbl_invoice , tbl_invoice_detail FROM tbl_invoice INNER JOIN tbl_invoice_detail ON tbl_invoice.invoice_id =
    tbl_invoice_detail.invoice_id WHERE tbl_invoice.invoice_id=$id";
    $delete = $pdo->prepare($delete_query);
    if($delete->execute()){
        echo'<script type="text/javascript">
            jQuery(function validation(){
            swal("Info", "ลบคำสั่งซื้อแล้ว", "info", {
            button: "ต่อไป",
                });
            });
            </script>';
    }

?>

<html>
<head>
<meta http-equiv="refresh" content="60">
</head>
</html>
  <div class="content-wrapper">
    <section class="content-header">
      <h1>
        คำสั่งซื้อสินค้า
      </h1>
      <hr>
    </section>
    <section class="content container-fluid">
        <div class="box box-success">
            <div class="box-header with-border">
                <h3 class="box-title">รายการคำสั่งสินค้า</h3>
                <a href="create_order.php" class="btn btn-success btn-sm pull-right">เพิ่มคำสั่งสินค้า</a>
            </div>
            <div class="box-body">
                <div style="overflow-x:auto;">
                    <table class="table table-striped" id="myOrder">
                        <thead>
                            <tr>
                                <th style="width:20px;">หมายเลข</th>
                                <th style="width:100px;">พนักงาน</th>
                                <th style="width:100px;">วันที่</th>
                                <th style="width:100px;">เวลา</th>
                                <th style="width:100px;">ค่าบริการ</th>
                                <th style="width:50px;">ตัวเลือก</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            if(isset($_GET['id'])){
                                $currDate = date("Y-m-d");
                                $select = $pdo->prepare("SELECT * FROM tbl_invoice WHERE order_date BETWEEN :fromdate AND :todate");
                                $select->bindParam(':fromdate', $currDate);
                                $select->bindParam(':todate', $currDate);
                                $select->execute();
                            }
                            else{
                            $select = $pdo->prepare("SELECT * FROM tbl_invoice ORDER BY invoice_id DESC");
                            $select->execute();
                          }
                            while($row=$select->fetch(PDO::FETCH_OBJ)){
                            ?>

                                <tr>
                                <td><?php echo $no++ ; ?></td>
                                <td class="text-uppercase"><?php echo $row->cashier_name; ?></td>
                                <td><?php echo $row->order_date; ?></td>
                                <td><?php echo $row->time_order; ?></td>
                                <td><?php echo number_format($row->total); ?> บาท</td>
                                <td>
                                    <?php if($_SESSION['role']=="Admin"){ ?>
                                    <a href="order.php?id=<?php echo $row->invoice_id; ?>" onclick="return confirm('ต้องการลบคำสั่งซื้อไหม?')" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>
                                    <?php } ?>
                                    <a href="misc/nota.php?id=<?php echo $row->invoice_id; ?>" target="_blank" class="btn btn-info btn-sm"><i class="fa fa-print"></i></a>
                                </td>
                                </tr>
                            <?php
                            }
                            ?>

                        </tbody>

                    </table>
                    <?php if(isset($_GET['id'])){ ?>
                      <a href="order.php" class="btn btn-info btn-sm"><i class="fa fa-flag"></i> Refresh</a>
                    <?php } ?>
                </div>

            </div>

        </div>


    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <script>
  //$(document).ready( function () {
  //    $('#myOrder').DataTable();
//  } );

  $(document).ready(function() {
    var min = new Date()
    var max = new Date()
      var table = $('#myOrder').DataTable();


      $('#min').keyup( function() { table.draw(); } );
      $('#max').keyup( function() { table.draw(); } );
  } );



  </script>

 <?php
    include_once'inc/footer_all.php';
 ?>
