<?php
  include_once'db/connect_db.php';
  session_start();
  if($_SESSION['role']!=="Admin"){
    header('location:index.php');
  }
  include_once'inc/header_all.php';

  if(isset($_POST['submit'])){

    $category = $_POST['category'];
    if(isset($_POST['category'])){

      $select = $pdo->prepare("SELECT cat_name FROM tbl_category WHERE cat_name='$category'");
      $select->execute();

      if($select->rowCount() > 0 ){
          echo'<script type="text/javascript">
              jQuery(function validation(){
              swal("คำเตือน", "มีหมวดหมู่อยู่แล้ว", "warning", {
              button: "ต่อไป",
                  });
              });
              </script>';
          }else{
            $insert = $pdo->prepare("INSERT INTO tbl_category(cat_name) VALUES(:category)");

            $insert->bindParam(':category', $category);

            if($insert->execute()){
              echo '<script type="text/javascript">
              jQuery(function validation(){
              swal("สำเร็จ", "เพิ่มหมวดหมู่ใหม่สำเร็จ", "success", {
              button: "Continue",
                  });
              });
              </script>';
            }
          }
    }
  }
  error_reporting(0);
?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
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
                      <label for="category">เพิ่มหมวดหมู่</label>
                      <input type="text" class="form-control" name="category" placeholder="ใส่ชื่อหมวดหมู่">
                    </div>
                  </div><!-- /.box-body -->
                  <div class="box-footer">
                      <button type="submit" class="btn btn-primary" name="submit">เพิ่ม</button>
                  </div>
                </form>
            </div>
      </div>
        <!-- Category Table -->
      <div class="col-md-8">
        <div class="box">
          <div class="box-header with-border">
            <h3 class="box-title">รายการหมวดหมู่</h3>
          </div>
          <!-- /.box-header -->
          <div class="box-body" style="overflow-x:auto;">
            <table class="table table-striped" id="myCategory">
                <thead>
                    <tr>
                        <th>หมายเลข</th>
                        <th>ชื่อหมวดหมู่</th>
                        <th>เพิ่มเติม</th>
                    </tr>

                </thead>
                <tbody>
                <?php
                $select = $pdo->prepare('SELECT * FROM tbl_category');
                $select->execute();
                while($row=$select->fetch(PDO::FETCH_OBJ)){ ?>
                  <tr>
                    <td><?php echo $row->cat_id; ?></td>
                    <td><?php echo $row->cat_name; ?></td>
                    <td>
                        <a href="edit_category.php?id=<?php echo $row->cat_id; ?>"
                        class="btn btn-info btn-sm" name="btn_edit"><i class="fa fa-pencil"></i></a>
                        <a href="delete_category.php?id=<?php echo $row->cat_id; ?>"
                        onclick="return confirm('ต้องการลบไหม?')"
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
      $('#myCategory').DataTable();
  } );
  </script>

<?php
  include_once'inc/footer_all.php';
?>
