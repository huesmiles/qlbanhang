
		


<?php
	include 'dau-trang.php';
?>
<?php 


if (isset($_POST['btnxoa'])) {
if (isset($_GET['ma_phieuxuat'])) {
		$sopx = $_GET['ma_phieuxuat'];
		mysqli_query($conn,"DELETE  FROM chitiet_px WHERE ma_phieuxuat =  $sopx");
		mysqli_query($conn,"DELETE  FROM phieu_xuat WHERE ma_phieuxuat =  $sopx");
	header('location: bao_cao_xuat_hang.php');
	}
}
if (isset($_POST['btnkhongxoa'])) {
	header('location:bao_cao_xuat_hang.php');
}
?>
<div class="container" style="margin-top: 50px; ">
		<div class="row">
			<div class="col-sm-12">
				<div class="alert alert-danger" role="alert">
					<form action="" method="POST" enctype="multipart/form-data">
						<button type="submit" class="btn btn-sm  btn-outline-success" name="btnkhongxoa">Không xóa</button>
						<button type="submit" class="btn btn-sm  btn-success" name="btnxoa">Xóa </button>
					</form>
				</div>
			</div>
		</div>
	</div>
<?php
	include 'chan-trang.php';
?>
