<?php
    include_once'db/connect_db.php';
    session_start();
    if(!isset($_SESSION['role'])){
      header('location:index.php');
  }
  if($_SESSION['role']=="Admin"){
    include_once'inc/header_all.php';
  }else{
      include_once'inc/header_all_operator.php';
  }
    error_reporting(0);
?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Main content -->
    <section class="content container-fluid">
      <div class="row">
        <!-- get alert stock -->
        <?php
        $select = $pdo->prepare("SELECT count(product_code) as total FROM tbl_product WHERE stock <= min_stock");
        $select->execute();
        $row=$select->fetch(PDO::FETCH_OBJ);
        $total1 = $row->total;
        ?>
        <!-- get alert notification -->
        <div class="col-md-3 col-sm-6 col-xs-12">
          <?php if($total1==true){ ?>
            <a href="" id="myBtn" data-toggle="modal" data-target="#myModal">
          <div class="info-box">
            <span class="info-box-icon bg-aqua"><i class="fa fa-archive"></i></span>
            <div class="info-box-content"> </a> <?php
          }else{?>
            <div class="info-box">
              <span class="info-box-icon bg-aqua"><i class="fa fa-archive"></i></span>
              <div class="info-box-content">
            <?php } ?>
              <span class="info-box-text">สินค้าใกล้หมด</span>
              <?php if($total1==true){ ?>
              <span class="info-box-number"><small><?php echo $row->total;?></small></span>
              <?php }else{?>
              <span class="info-box-text"><strong>ไม่มี</strong></span>
              <?php }?>
            </div>

            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>


        <!-- get total products-->
        <?php
        $select = $pdo->prepare("SELECT count(product_code) as t FROM tbl_product");
        $select->execute();
        $row=$select->fetch(PDO::FETCH_OBJ);
        $total = $row->t;
        ?>

        <!-- get total products notification -->
        <div class="col-md-3 col-sm-6 col-xs-12">
          <a href="product.php">
          <div class="info-box">
            <span class="info-box-icon bg-aqua"><i class="fa fa-cubes"></i></span>
            <div class="info-box-content"></a>
              <span class="info-box-text">สินค้าทั้งหมด</span>
              <span class="info-box-number"><small><?php echo $row->t ?></small></span>
            </div>
            <!-- /.info-box-content -->
          </div>

          <!-- /.info-box -->
        </div>
        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                         <h4 class="modal-title" id="myModalLabel">สินค้าใกล้หมด</h4>

                    </div>
                    <div class="modal-body"><table class="table table-striped" id="myProduct">
                        <thead>
                            <tr>
                                <th>หมายเลข</th>
                                <th>สินค้า</th>
                                <th>รหัส</th>
                                <th>มีในคลัง</th>
                            </tr>

                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            $select = $pdo->prepare("SELECT * FROM tbl_product WHERE stock<=min_stock" );
                            $select->execute();
                            while($row=$select->fetch(PDO::FETCH_OBJ)){
                            ?>
                                <tr>
                                <td><?php echo $no++ ;?></td>
                                <td><?php echo $row->product_name; ?></td>
                                <td><?php echo $row->product_code; ?></td>
                                <td> <?php echo $row->stock; ?>
                                <?php echo $row->product_satuan; ?>
                                </td>
                                </tr>
                            <?php
                            }
                            ?>
                        </tbody>
                    </table></div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- get today transactions -->
        <?php
        $select = $pdo->prepare("SELECT count(invoice_id) as i FROM tbl_invoice WHERE order_date = CURDATE()");
        $select->execute();
        $row=$select->fetch(PDO::FETCH_OBJ);
        $invoice = $row->i ;
        ?>
         <!-- get today transactions notification -->
        <div class="col-md-3 col-sm-6 col-xs-12">
          <a href="order.php?id=today">
          <div class="info-box">
            <span class="info-box-icon bg-aqua"><i class="fa fa-shopping-cart"></i></span>
            <div class="info-box-content"></a>
              <span class="info-box-text">คำสั่งซื้อวันนี้</span>
              <span class="info-box-number"><small><?php echo $row->i ?></small></span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>



        <!-- get today income -->
        <?php
        $select = $pdo->prepare("SELECT sum(total) as total FROM tbl_invoice WHERE order_date = CURDATE()");
        $select->execute();
        $row=$select->fetch(PDO::FETCH_OBJ);
        $total = $row->total ;
        ?>
         <!-- get today income -->
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-aqua"><i class="fa fa-money"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">รายได้วันนี้</span>
              <span class="info-box-number"><small> <?php echo number_format($total,0); ?> บาท</small></span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>

      </div>

      <div class="col-md-offset-1 col-md-10">
        <div class="box box-success">
          <div class="box-header with-border">
              <h3 class="box-title">รายการสินค้าที่ขาย</h3>
          </div>
          <div class="box-body">
            <div class="col-md-offset-1 col-md-10">
              <div style="overflow-x:auto;">
                  <table class="table table-striped" id="myBestProduct">
                      <thead>
                          <tr>
                              <th>หมายเลข</th>
                              <th>สินค้า</th>
                              <th>รหัสสินค้า</th>
                              <th>ขายแล้ว(ทั้งหมด)</th>
                              <th>ราคา(ต่อ 1 หน่วย)</th>
                              <th>รายได้</th>
                          </tr>

                      </thead>
                      <tbody>
                          <?php
                          $no = 1;
                          $select = $pdo->prepare("SELECT product_code,product_name,price,sum(qty) as q, sum(qty*price) as total FROM
                          tbl_invoice_detail GROUP BY product_id ORDER BY sum(qty) DESC LIMIT 30");
                          $select->execute();
                          while($row=$select->fetch(PDO::FETCH_OBJ)){
                          ?>
                              <tr>
                              <td><?php echo $no++ ;?></td> <!-- หมายเลข -->
                              <td><?php echo $row->product_name; ?></td> <!-- ชื่อ -->
                              <td><?php echo $row->product_code; ?></td> <!-- รหัส -->
                              <td><?php echo $row->q; ?> <!-- รวม -->
                              </td>
                              <td><?php echo number_format($row->price);?> บาท</td>
                              <td><?php echo number_format($row->total);?> บาท</td>
                              </tr>

                        <?php
                          }
                        ?>
                      </tbody>
                  </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <script>
  $(document).ready( function () {
      $('#myBestProduct').DataTable();
  } );

  $(document).ready(function () {

    $("#myBtn").click(function(){
         $('#myModal').modal('show');
    });
});
  </script>


 <?php
    include_once'inc/footer_all.php';
 ?>
