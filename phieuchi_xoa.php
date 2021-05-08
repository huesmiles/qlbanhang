
<?php
	include 'dau-trang.php';
?>
<?php 
if (isset($_POST['btnxoa'])) {
	$ma_phieuthu= $_GET['ma_phieuthu'];
	mysqli_query($conn,"DELETE FROM phieu_thu where ma_phieuthu='$ma_phieuthu'");
	header('location:phieu_chi.php');
}
if (isset($_POST['btnkhongxoa'])) {
	header('location:phieu_chi.php');
}
?>
<div class="container" style="margin-top: 50px; ">
		<div class="row">
			<div class="col-sm-12">
				<div class="alert alert-danger" role="alert">
					<form action="" method="POST" enctype="multipart/form-data">
						<button type="submit" class="btn btn-sm  btn-outline-success" name="btnkhongxoa">Không xóa</button>
						<button type="submit" class="btn btn-sm  btn-success" name="btnxoa">Xóa phiếu chi</button>
					</form>
				</div>
			</div>
		</div>
	</div>
<?php
	include 'chan-trang.php';
?>