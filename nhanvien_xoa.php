
<?php
	include 'dau-trang.php';
?>
<?php 
if (isset($_POST['btnxoa'])) {
	$ma_nv = $_GET['ma_nv'];
	mysqli_query($conn,"DELETE FROM nhan_vien where ma_nv='$ma_nv'");
	header('location:nhan_vien.php');
}
if (isset($_POST['btnkhongxoa'])) {
	header('location:nhan_vien.php');
}
?>
<div class="container" style="margin-top: 50px; ">
		<div class="row">
			<div class="col-sm-12">
				<div class="alert alert-danger" role="alert">
					<form action="" method="POST" enctype="multipart/form-data">
						<button type="submit" class="btn btn-sm  btn-outline-success" name="btnkhongxoa">Không xóa</button>
						<button type="submit" class="btn btn-sm  btn-success" name="btnxoa">Xóa nhân viên</button>
					</form>
				</div>
			</div>
		</div>
	</div>
<?php
	include 'chan-trang.php';
?>