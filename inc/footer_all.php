<?php
    include_once'db/connect_db.php';
    session_start();
?>
  <footer class="main-footer">
    <!-- To the right -->
    <div class="pull-right hidden-xs">
    </div>
    <!-- Default to the left --><?php
    $select = $pdo->prepare("SELECT * FROM tbl_storedetail");
    $select->execute();
    while($row = $select->fetch(PDO::FETCH_OBJ)){
      ?>
    <strong><?php echo $row->name; ?></a>.</strong> <?php echo $row->address; ?>

  <?php } ?>
  </footer>
</div>
<!-- ./wrapper -->

<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
<!-- jQuery 3 -->
<script src="bower_components/jquery/dist/jquery.min.js"></script>
<!-- DataTables -->
<script src="bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>

</body>
</html>
