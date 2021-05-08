<?php
include 'dau-trang.php';
?>
<?php
$bangdsnv = mysqli_query($conn, "SELECT ma_hh,anh_hh,ten_hh,nhacc,dongia_ban,dongia_nhap from hang_hoa");
$erors = '';
if (isset($_POST['ten_hh'])) {
	$ten_hh = $_POST['ten_hh'];
	$ma_hh = $_POST['ma_hh'];
	if ($ma_hh == '') {
		$ma_hh = random_int(10, 100000);
	}

	$anh_hh = '';
	if (!empty($_FILES['anh_hh']['name'])) {
		$file = $_FILES['anh_hh']; // gan thong tin anh vào biến cho gọn

		$up = move_uploaded_file($file['tmp_name'], 'public/uploads/' . $file['name']);
		if ($up) {
			$anh_hh = $file['name'];
		}
	}
	$nhacc = $_POST['nhacc'];
	$dongia_ban =  str_replace(',', '', $_POST['dongia_ban']);
	$dongia_nhap =  str_replace(',', '', $_POST['dongia_nhap']);

	$sql = "INSERT INTO hang_hoa(ma_hh,ten_hh,nhacc,dongia_ban,dongia_nhap,anh_hh) VALUES('$ma_hh','$ten_hh','$nhacc','$dongia_ban','$dongia_nhap','$anh_hh')";
	if (mysqli_query($conn, $sql)) {
		header('location: hang_hoa.php');
	} else {
		$erors = 'Thêm mới không thành công';
	}
}
?>
<?php if ($erors != '') : ?>
	<div class="container-fluid">
		<div class="row">
			<div class="col-sm-12">
				<div class="alert alert-danger" role="alert">
					<strong>Trùng mã!!! / <?php echo $erors ?> </strong>
					<hr>
					<a href="hang_hoa.php" class="btn btn-sm btn-primary" target="_blank"> Vào lại hàng hóa</a>
				</div>
			</div>
		</div>
	</div>
<?php endif ?>
<div class="container-fluid" style="margin-top: 20px">
	<div class="card text-dark" style="max-width: 100%;">
		<div class="card-header bg-dark" style="color: white;">
			CẬP NHẬT SẢN PHẨM

		</div>
		<div class="card-body">
			<form action="" method="POST" enctype="multipart/form-data">
				<div class="row">
					<div class="col-sm-2">
						<label for="">Mã hàng</label>
						<input type="text" class="form-control" name="ma_hh" placeholder="Mã hàng hóa">
					</div>

					<div class="col-sm-4">
						<label for="">Tên hàng</label>
						<input type="text" class="form-control" name="ten_hh" placeholder="Tên hàng hóa" required>
					</div>
					<div class="col-sm-3">
						<label for="">Giá bán</label>
						<input type="text" class="form-control price" name="dongia_ban" placeholder="Đơn giá bán">
					</div>
					<div class="col-sm-3">
						<label for="">Giá nhập</label>
						<input type="text" class="form-control price" name="dongia_nhap" placeholder="Giá nhập">
					</div>

				</div>
				<div class="row">
					<div class="col-sm-6">
						<label for="">Nhà cung cấp</label>
						<input type="text" class="form-control" name="nhacc">
					</div>
					<div class="col-sm-6">
						<label for="">Ảnh hàng hóa</label>
						<input type="file" class="form-control" name="anh_hh">
					</div>
					<!-- <div class="col-sm-4">
				<label for="">Mã hàng hóa</label>
				<input type="text" class="form-control" name="ma_hh" placeholder="Mã hàng hóa" required>
			</div> -->

				</div>
				<br>
				<button type="submit" class="btn btn-sm  btn-success">Cập nhật</button>

			</form>
		</div>
	</div>
</div>
<div class="container-fluid" style="margin-top: 20px">
	<div class="card text-dark" style="max-width: 100%;">
		<div class="card-header">DANH SÁCH SẢN PHẨM</div>
		<div class="card-body">

			<div class="table-responsive">
				<!-- Table -->

				<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
					<thead>
						<tr>
							<th>Sửa</th>
							<th>Xóa</th>
							<th>Mã sản phẩm</th>
							<th>Ảnh</th>
							<th style="text-align: center;">Tên sản phẩm</th>
							<th style="text-align: center;">Nhà cung cấp</th>
							<th style="text-align: center;">Giá bán</th>
							<th style="text-align: center;">Giá nhập</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach ($bangdsnv as $key => $dsnv) : ?>
							<tr>
								<td style="text-align: center;">
									<a href="hanghoa_sua.php?ma_hh=<?php echo $dsnv['ma_hh'] ?>" title="Sửa">
										<i class="far fa-edit" style="color: green"></i></a>
								</td>
								<td style="text-align: center;">
									<a href="hanghoa_xoa.php?ma_hh=<?php echo $dsnv['ma_hh'] ?>" title="Xóa">
										<i class="far fa-trash-alt" style="color: red"></i></a>
								</td>
								<td><?php echo ($dsnv['ma_hh']) ?></td>
								<td><img src="public/uploads/<?php echo $dsnv['anh_hh'] ?>" width="100px" height="100px"></td>
								<td><?php echo ($dsnv['ten_hh']) ?></td>
								<td style="text-align: center;"><?php echo ($dsnv['nhacc']) ?></td>
								<td style="text-align: right;"><?php echo number_format($dsnv['dongia_ban']) ?></td>
								<td style="text-align: right;"><?php echo number_format($dsnv['dongia_nhap']) ?></td>
							</tr>
						<?php endforeach; ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
<?php include 'chan-trang.php' ?>