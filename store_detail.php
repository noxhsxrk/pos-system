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

    $id = $_GET['id'];

    $delete = $pdo->prepare("DELETE FROM tbl_user WHERE user_id=".$id);

    if($delete->execute()){
        echo'<script type="text/javascript">
            jQuery(function validation(){
            swal("Info", "ผู้ใช้งานถูกลบแล้ว", "info", {
            button: "ต่อไป",
                });
            });
            </script>';
    }

    if(isset($_POST['submit'])){

        $name = $_POST['name'];
        $address = $_POST['address'];
        $detail = $_POST['detail'];
        $tel = $_POST['tel'];
                $update = $pdo->prepare("UPDATE tbl_storedetail SET name = :name,
                                                                 address = :address,
                                                                  detail = :detail,
                                                                     tel = :tel");
                //binding the values parameter with input from user
                $update->bindParam(':name',$name);
                $update->bindParam(':address',$address);
                $update->bindParam(':detail',$detail);
                $update->bindParam(':tel',$tel);

                //if execution $insert
                if($update->execute()){
                    echo'<script type="text/javascript">
                        jQuery(function validation(){
                        swal("สำเร็จ", "เพิ่มรายละเอียดร้านแล้ว", "success", {
                        button: "ต่อไป",
                            });
                        });
                        </script>';
                }
            }

?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Main content -->
    <section class="content container-fluid">
        <form id="store_edit" action="" method="POST">
            <!-- Registration Form -->
            <div class="col-md-5">
                <div class="box box-success">
                    <div class="box-header with-border">
                        <h3 class="box-title">แก้ไขรายละเอียดร้านค้า</h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                        <div class="box-body">
                                <div class="form-group">
                                    <label for="name">ชื่อร้านค้า</label>
                                    <input type="text" class="form-control" id="name" name="name" placeholder="ชื่อร้านค้า" required>
                                </div>
                                <div class="form-group">
                                    <label for="address">ที่อยู่ร้านค้า</label>
                                    <input type="text" class="form-control" id="address" name="address" placeholder="ที่อยู่ร้านค้า" required>
                                </div>
                                <div class="form-group">
                                    <label for="detail">รายละเอียดร้านค้า</label>
                                    <input type="text" class="form-control" id="detail" name="detail" placeholder="รายละเอียดร้านค้า เช่น จำหน่ายอุปกรณ์การเรียน ฯลฯ " required>
                                </div>
                                <div class="form-group">
                                    <label for="tel">เบอร์โทรร้าน</label>
                                    <input type="text" class="form-control" id="tel" name="tel" placeholder="เบอร์โทร 08x-xxx-xxxx " required>
                                </div>
                        </div>

                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary" name="submit">เพิ่มรายละเอียดร้าน</button>
                        </div>
                    </form>
                </div>
            </div>
            <!-- Registered Table -->
            <?php
              $id = $_GET['id'];
              $select = $pdo->prepare("SELECT * FROM tbl_storedetail");
              $select->execute();
              while($row = $select->fetch(PDO::FETCH_OBJ)){
                  $store_name = $row->name;
                  $store_address = $row->address;
                  $store_detail = $row->detail;
                  $store_tel = $row->tel;
                }
                ?>
            <div class="col-md-7">
              <ul class="list-group">
                <center><p class="list-group-item list-group-item-success">รายละเอียดร้านค้า</p></center>
                <li class="list-group-item"> <b>ชื่อร้านค้า</b>     :<span class="label badge pull-right"><?php echo $store_name; ?></span></li>
                <li class="list-group-item"><b>ที่อยู่ร้านค้า</b>    :<span class="label label-info pull-right"><?php echo $store_address; ?></span></li>
                <li class="list-group-item"><b>คำอธิบายร้านค้า</b>        :<span class="label label-primary pull-right"><?php echo $store_detail; ?></span></li>
                <li class="list-group-item"><b>เบอร์โทรร้านค้า</b>  :<span class="label label-warning pull-right"><?php echo $store_tel; ?></span></li>

              </ul>
                <button onclick="edit()" type="submit" class="btn btn-primary" name="edit">แก้ไข/เพิ่มรายละเอียดร้าน</button>
            </div>

            </div>
            <!-- /.box -->
            </div>
        </form>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <script>
  $(document).ready( function () {
      $('#myRegister').DataTable();
  } );
  </script>


  <script>
  document.getElementById("store_edit").style.display="none";
  function edit(){
      document.getElementById("store_edit").style.display="block";
  }
  </script>

  <script>
    var name = "<?php echo $store_name; ?>";
    var address = "<?php echo $store_address; ?>";
    var detail = "<?php echo $store_detail; ?>";
    var tel = "<?php echo $store_tel; ?>";
    document.getElementById("name").value = name;
    document.getElementById("address").value = address;
    document.getElementById("detail").value = detail;
    document.getElementById("tel").value = tel;
  </script>
 <?php
    include_once'inc/footer_all.php';
 ?>
