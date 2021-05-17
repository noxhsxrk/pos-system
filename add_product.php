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

    if(isset($_POST['add_product'])){
        $code = $_POST['product_code'];
        $product = $_POST['product_name'];
        $category = $_POST['category'];
        $purchase = $_POST['purchase_price'];
        $sell = $_POST['sell_price'];
        $stock = $_POST['stock'];
        $min_stock = $_POST['min_stock'];
        $satuan = $_POST['satuan'];
        $desc = $_POST['description'];


        if(isset($_POST['product_code'])){
            $select = $pdo->prepare("SELECT product_code FROM tbl_product WHERE product_code='$code'");
            $select->execute();

            if($select->rowCount() > 0 ){
                echo'<script type="text/javascript">
                    jQuery(function validation(){
                    swal("คำเตือน", "มีรหัสสินค้านี้แล้ว", "warning", {
                    button: "ต่อไป",
                        });
                    });
                    </script>';
            }elseif (strlen($code)>6 || strlen($code)<6) {
                    echo'<script type="text/javascript">
                    jQuery(function validation(){
                    swal("คำเตือน", "รหัสต้องมี 6 ตัวอักษร", "warning", {
                    button: "ต่อไป",
                        });
                    });
                    </script>';
            }else{
            $img = $_FILES['product_img']['name'];
            $img_tmp = $_FILES['product_img']['tmp_name'];
            $img_size = $_FILES['product_img']['size'];
            $img_ext = explode('.', $img);
            $img_ext = strtolower(end($img_ext));

            $img_new = uniqid().'.'. $img_ext;

            $store = "upload/".$img_new;

            if($img_ext == 'jpg' || $img_ext == 'jpeg' || $img_ext == 'png' || $img_ext == 'gif'){
                if($img_size>= 1000000){
                    $error ='<script type="text/javascript">
                            jQuery(function validation(){
                            swal("ผิดพลาด", "ไฟล์ควรมีขนาด 1MB", "error", {
                            button: "ต่อไป",
                                });
                            });
                            </script>';
                    echo $error;
                }else{
                    if(move_uploaded_file($img_tmp,$store)){
                        $product_img = $img_new;
                        if(!isset($error)){

                            $insert = $pdo->prepare("INSERT INTO tbl_product(product_code,product_name,product_category,purchase_price,sell_price,stock,min_stock,product_satuan,description,img)
                            values(:product_code,:product_name,:product_category,:purchase_price,:sell_price,:stock,:min_stock,:satuan,:desc,:img)");

                            $insert->bindParam(':product_code', $code);
                            $insert->bindParam(':product_name', $product);
                            $insert->bindParam(':product_category', $category);
                            $insert->bindParam(':purchase_price', $purchase);
                            $insert->bindParam(':sell_price', $sell);
                            $insert->bindParam(':stock', $stock);
                            $insert->bindParam(':min_stock', $min_stock);
                            $insert->bindParam(':satuan', $satuan);
                            $insert->bindParam(':desc', $desc);
                            $insert->bindParam(':img', $product_img);

                            if($insert->execute()){
                                echo'<script type="text/javascript">
                                        jQuery(function validation(){
                                        swal("สำเร็จ", "บันทึกสินค้าสำเร็จแล้ว", "success", {
                                        button: "ต่อไป",
                                            });
                                        });
                                        </script>';
                            }else{
                                echo '<script type="text/javascript">
                                        jQuery(function validation(){
                                        swal("ผิดพลาด", "มีข้อผิดพลาด", "error", {
                                        button: "ต่อไป",
                                            });
                                        });
                                        </script>';;
                            }

                        }else{
                            echo '<script type="text/javascript">
                                        jQuery(function validation(){
                                        swal("ผิดพลาด", "มีข้อผิดพลาด", "error", {
                                        button: "ต่อไป",
                                            });
                                        });
                                        </script>';;;
                        }
                    }

                }
            }else{
                $error = '<script type="text/javascript">
                jQuery(function validation(){
                swal("ผิดพลาด", "กรุณาอัพโหลดรูปแบบรูปภาพ: jpg, jpeg, png, gif", "error", {
                button: "ต่อไป",
                    });
                });
                </script>';
                echo $error;

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
        สินค้า
      </h1>
      <hr>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">
        <div class="box box-success">
            <div class="box-header with-border">
                <h3 class="box-title">เพิ่มสินค้าใหม่</h3>
            </div>
            <form action="" method="POST" name="form_product"
                enctype="multipart/form-data" autocomplete="off">
                <div class="box-body">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="">รหัสสินค้า</label><br>
                            <span class="text-muted">*ตรวจสอบให้แน่ใจว่ารหัสสินค้าตรงกัน</span>
                            <input type="text" class="form-control"
                            name="product_code">
                        </div>
                        <div class="form-group">
                            <label for="">ชื่อสินค้า</label>
                            <input type="text" class="form-control"
                            name="product_name">
                        </div>
                        <div class="form-group">
                            <label for="">หมวดหมู่</label>
                            <select class="form-control" name="category" required>
                                <?php
                                $select = $pdo->prepare("SELECT * FROM tbl_category");
                                $select->execute();
                                while($row = $select->fetch(PDO::FETCH_ASSOC)){
                                    extract($row)
                                ?>
                                    <option><?php echo $row['cat_name']; ?></option>
                                <?php
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="">ราคาทุน</label>
                            <input type="number" class="form-control"
                            name="purchase_price" required>
                        </div>
                        <div class="form-group">
                            <label for="">ราคาขาย</label>
                            <input type="number" class="form-control"
                            name="sell_price" required>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="">คลังสินค้า</label><br>
                            <span class="text-muted">*หน่วยตามสินค้า</span>
                            <input type="number" min="1" step="1"
                            class="form-control" name="stock" required>
                        </div>
                        <div class="form-group">
                            <label for="">สินค้าคงคลังขั้นต่ำ</label><br>
                            <input type="number" min="1" step="1"
                            class="form-control" name="min_stock" required>
                        </div>
                        <div class="form-group">
                            <label for="">หน่วย</label>
                            <select class="form-control" name="satuan" required>
                                <?php
                                $select = $pdo->prepare("SELECT * FROM tbl_satuan");
                                $select->execute();
                                while($row = $select->fetch(PDO::FETCH_ASSOC)){
                                    extract($row)
                                ?>
                                    <option><?php echo $row['nm_satuan']; ?></option>
                                <?php
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="">คำอธิบายโดยย่อของสินค้า</label>
                            <textarea name="description" id="description"
                            cols="30" rows="10" class="form-control" required></textarea>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="">รูปภาพสินค้า</label><br>
                            <br>
                            <input type="file" class="input-group"
                            name="product_img" onchange="readURL(this);" required> <br>
                            <img id="img_preview" src="upload/<?php echo $row->img?>" alt="Preview" class="img-responsive" />
                        </div>
                    </div>
                </div>

                <div class="box-footer">
                    <button type="submit" class="btn btn-primary"
                    name="add_product">เพิ่มสินค้า</button>
                    <a href="product.php" class="btn btn-warning">กลับ</a>
                </div>
            </form>
        </div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

<script type="text/javascript">
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#img_preview').attr('src', e.target.result)
                .width(250)
                .height(200);
            }

            reader.readAsDataURL(input.files[0]);
        }
    }
</script>

 <?php
    include_once'inc/footer_all.php';
 ?>
