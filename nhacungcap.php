<?php
include 'dau-trang.php';
?>
<?php
$phieuthu = mysqli_query($conn, "SELECT tien_thu,ngay_thu,noi_dung,ma_kh,phanloaithuchi from phieu_thu");
$tien_thu = 0;
$ngay_thu = date('Y/m/d');
$noi_dung = "Số ban đầu";
$phanloaithuchi = "Phiếu thu";
if (isset($_POST['ten_kh'])) {
	$ten_kh = $_POST['ten_kh'];
	$mobile = $_POST['mobile'];
	$dia_chi = $_POST['dia_chi'];
	$facebook = 0;
	$zalo = 0;
	$email = $_POST['email'];
	$sinhnhat = 0;
	$phanloai = 'Nhà cung cấp';
	$sql = "INSERT INTO khach_hang(ten_kh,mobile,dia_chi,email,facebook,zalo,sinhnhat,phanloai) VALUES('$ten_kh','$mobile','$dia_chi','$email','$facebook','$zalo','$sinhnhat','$phanloai')";

	if (mysqli_query($conn, $sql)) {
		//Chèn vào phiếu thu ban đầu
		$bangdsnv = mysqli_query($conn, "SELECT ma_kh,ten_kh,mobile,dia_chi from khach_hang");
		foreach ($bangdsnv as $ggg) {
			$ma_kh = $ggg['ma_kh'];
			$n = 0;
			foreach ($phieuthu as $pt) {
				$ma_khpt = $pt['ma_kh'];
				if ($ma_kh == $ma_khpt) {
					$n += 1;
				}
			}

			if ($n  == 0) {
				$sql = mysqli_query($conn, "INSERT INTO phieu_thu(tien_thu,ngay_thu,noi_dung,ma_kh,phanloaithuchi) VALUES('$tien_thu','$ngay_thu','$noi_dung','$ma_kh','$phanloaithuchi')");
			}
		}
		// Hết chèn vào phiếu thu ban đầu
		header('location: nhacungcap.php');
	} else {
		echo 'Thêm mới không thành công';
	}
}
?>
<div class="container-fluid" style="margin-top: 20px">
	<div class="card text-dark" style="max-width: 100%;">
		<div class="card-header bg-dark" style="color: white">CẬP NHẬT NHÀ CUNG CẤP</div>
		<div class="card-body">
			<form action="" method="POST" enctype="multipart/form-data">
				<div class="row">
					<div class="col-sm-6">
						<label for="">Họ và tên</label>
						<input type="text" class="form-control" name="ten_kh" placeholder="Họ và tên" required>
					</div>
					<div class="col-sm-6">
						<label for="">Điện thoại</label>
						<input type="text" class="form-control" name="mobile" placeholder="Điện thoại">
					</div>

				</div>
				<div class="row">

					<div class="col-sm-4">
						<label for="">Email</label>
						<input type="text" class="form-control" name="email" placeholder="Email">
					</div>

					<div class="col-sm-8">
						<label for="">Địa chỉ</label>
						<input type="text" class="form-control" name="dia_chi" placeholder="Địa chỉ">
					</div>
				</div>
				<br>
				<button type="submit" class="btn btn-sm btn-dark">Cập nhật</button>
				<a href="phieu_nhap.php" class="btn btn-sm btn-success">Làm phiếu nhập</a>

			</form>
		</div>
	</div>
</div>

<?php

$bangdsnv = mysqli_query($conn, "SELECT ma_kh,ten_kh,mobile,dia_chi,email,facebook,zalo,sinhnhat,phanloai from khach_hang where phanloai= 'Nhà cung cấp'  order by ma_kh desc");

?>

<div class="container-fluid" style="margin-top: 20px">
	<div class="card text-dark" style="max-width: 100%;">
		<div class="card-header bg-gray" style="color: black">
			DANH SÁCH NHÀ CUNG CẤP

		</div>
		<div class="card-body">
			<div class="table-responsive">

				<!-- Table -->
				<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
					<thead>
						<tr>
							<th style="text-align: center;">Sửa</th>
							<th style="text-align: center;">Xóa</th>
							<th>Họ và tên</th>
							<th>Điện thoại</th>
							<th>Địa chỉ</th>

							<th>Email</th>


						</tr>
					</thead>
					<tbody>
						<?php foreach ($bangdsnv as $key => $dsnv) : ?>
							<tr>
								<td style="text-align: center;">
									<a href="nhacc_sua.php?ma_kh=<?php echo $dsnv['ma_kh'] ?>" title="Sửa">
										<i class="far fa-edit" style="color: green"></i></a>
								</td>
								<td style="text-align: center;">
									<a href="nhacc_xoa.php?ma_kh=<?php echo $dsnv['ma_kh'] ?>" title="Xóa">
										<i class="far fa-trash-alt" style="color: red"></i></a>
								</td>
								<td><?php echo $dsnv['ten_kh'] ?></td>
								<td><?php echo $dsnv['mobile'] ?></td>
								<td><?php echo $dsnv['dia_chi'] ?></td>


								<td><?php echo $dsnv['email'] ?></td>


							</tr>
						<?php endforeach; ?>
					</tbody>
				</table>

			</div>
		</div>
	</div>
</div>


<?php include 'chan-trang.php' ?>