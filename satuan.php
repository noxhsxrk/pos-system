<?php
include_once'db/connect_db.php';
session_start();
if(!isset($_SESSION['role'])){
  header('location:index.php');
}
if($_SESSION['role']!=="Admin"){
header('location:index.php');
}
include_once'inc/header_all.php';
error_reporting(0);
if(isset($_POST['submit'])){
    $satuan = $_POST['satuan'];
    if(isset($_POST['satuan'])){

            $select = $pdo->prepare("SELECT nm_satuan FROM tbl_satuan WHERE nm_satuan='$satuan'");
            $select->execute();

            if($select->rowCount() > 0 ){
                echo'<script type="text/javascript">
                    jQuery(function validation(){
                    swal("คำเตืนอ", "หน่วยมีอยู่แล้ว", "warning", {
                    button: "ต่อไป",
                        });
                    });
                    </script>';
                }else{
                    $insert = $pdo->prepare("INSERT INTO tbl_satuan(nm_satuan) VALUES(:satuan)");

                    $insert->bindParam(':satuan', $satuan);

                    if($insert->execute()){
                        echo '<script type="text/javascript">
                        jQuery(function validation(){
                        swal("สำเร็จ", "สร้างหน่วยใหม่สำเร็จ", "success", {
                        button: "ต่อไป",
                            });
                        });
                        </script>';
                        }
                }
    }
}

?>

<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        หน่วยสินค้า
      </h1>
      <hr>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">
       <!-- Category Form-->
      <div class="col-md-4">
            <div class="box box-success">
                <!-- /.box-header -->
                <!-- form start -->
                <form action="" method="POST">
                  <div class="box-body">
                    <div class="form-group">
                      <label for="category">ชื่อหน่วย</label>
                      <input type="text" class="form-control" name="satuan" placeholder="ชื่อหน่วย">
                    </div>
                  </div><!-- /.box-body -->
                  <div class="box-footer">
                      <button type="submit" class="btn btn-primary" name="submit">ตกลง</button>
                  </div>
                </form>
            </div>
      </div>
        <!-- Category Table -->
      <div class="col-md-8">
        <div class="box">
          <div class="box-header with-border">
            <h3 class="box-title">รายการหน่วย</h3>
          </div>
          <!-- /.box-header -->
          <div class="box-body" style="overflow-x:auto;">
            <table class="table table-striped" id="mySatuan">
                <thead>
                    <tr>
                        <th>หมายเลข</th>
                        <th>ชื่อหน่วย</th>
                        <th>เพิ่มเติ่ม</th>
                    </tr>

                </thead>
                <tbody>
                <?php
                $no = 1;
                $select = $pdo->prepare('SELECT * FROM tbl_satuan');
                $select->execute();
                while($row=$select->fetch(PDO::FETCH_OBJ)){ ?>
                  <tr>
                    <td><?php echo $no ++ ?></td>
                    <td><?php echo $row->nm_satuan; ?></td>
                    <td>
                        <a href="edit_satuan.php?id=<?php echo $row->kd_satuan; ?>"
                        class="btn btn-info btn-sm" name="btn_edit"><i class="fa fa-pencil"></i></a>
                        <a href="delete_satuan.php?id=<?php echo $row->kd_satuan; ?>"
                        onclick="return confirm('Hapus Satuan?')"
                        class="btn btn-danger btn-sm" name="btn_delete"><i class="fa fa-trash"></i></a>
                    </td>
                  </tr>
                <?php
                }
                ?>

                </tbody>
            </table>
          </div>
          <!-- /.box-body -->
        </div>
        <!-- /.box -->
      </div>


    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- DataTables Function -->
  <script>
  $(document).ready( function () {
      $('#mySatuan').DataTable();
  } );
  </script>
  <scrpit>


  </scrpit>
<?php
  include_once'inc/footer_all.php';
?>
