<?php
	include 'dau-trang.php';
?>
<?php 
if (isset($_POST['btnxoa'])) {
	$ma_kh = $_GET['ma_kh'];
	mysqli_query($conn,"DELETE FROM khach_hang where ma_kh='$ma_kh'");
	header('location:khach_hang.php');
}
if (isset($_POST['btnkhongxoa'])) {
	header('location:khach_hang.php');
}
?>
<div class="container" style="margin-top: 50px; ">
		<div class="row">
			<div class="col-sm-12">
				<div class="alert alert-danger" role="alert">
					<form action="" method="POST" enctype="multipart/form-data">
						<button type="submit" class="btn btn-sm  btn-outline-success" name="btnkhongxoa">Không xóa</button>
						<button type="submit" class="btn btn-sm  btn-success" name="btnxoa">Bạn có chắc chắn xóa???</button>
					</form>
				</div>
			</div>
		</div>
	</div>
<?php
	include 'chan-trang.php';
?>