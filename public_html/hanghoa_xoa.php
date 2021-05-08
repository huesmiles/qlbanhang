<?php
	include 'dau-trang.php';
?>
<?php 
if (isset($_POST['btnxoa'])) {
	$ma_hh = $_GET['ma_hh'];
	mysqli_query($conn,"DELETE FROM hang_hoa where ma_hh='$ma_hh'");
	header('location:hang_hoa.php');
}
if (isset($_POST['btnkhongxoa'])) {
	header('location:hang_hoa.php');
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