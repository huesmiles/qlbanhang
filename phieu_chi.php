<?php
include 'dau-trang.php';
$ngay_hientai = date('Y-m-d');
$thanhcong = '';
if (isset($_POST['tien_thu'])) {
	$tien_thu = str_replace(',', '', $_POST['tien_thu']);
	$ngay_thu = $_POST['ngay_thu'];
	$noi_dung = $_POST['noi_dung'];
	$ma_kh = $_POST['ma_kh'];
	$phanloaithuchi = 'Phiếu chi';
	$sql = "INSERT INTO phieu_thu(tien_thu,ngay_thu,noi_dung,ma_kh,phanloaithuchi) VALUES('$tien_thu','$ngay_thu','$noi_dung','$ma_kh','$phanloaithuchi')";
	if (mysqli_query($conn, $sql)) {
		$thanhcong = 'LƯU ĐƠN THÀNH CÔNG';
	} else {
		echo 'Thêm mới không thành công';
	}
}
if (isset($_POST['btnin'])) {
	header('location: phieu_chi.php');
}
?>
<br>
<?php if ($thanhcong != '') : ?>
	<div class="container-fluid">
		<div class="row">
			<div class="col-sm-12">
				<div class="alert alert-danger" role="alert">
					<strong>Good!</strong> <?php echo $thanhcong; ?>
					<hr>
					<form action="" method="POST">
						<button class="btn btn-sm btn-danger" name="btnin">Làm Phiếu Mới</button>
						<!-- <a href="inphieupdf_nhap.php?ma_phieunhap=<?php echo $ma_phieunhap ?>" class="btn btn-sm btn-primary" target="_blank"> In đơn hàng</a> -->
					</form>
				</div>
			</div>
		</div>
	</div>
<?php endif ?>
<div class="container-fluid" style="margin-top: 20px">
	<div class="card text-dark" style="max-width: 100%;">
		<div class="card-header bg-dark" style="color: white">Phiếu chi</div>
		<div class="card-body">

			<form action="" method="POST">
				<div class="row">

					<div class="col-sm-6" ng-show="mncc">
						<H3>
							<FONT color="red">{{ncc_da_chon.ten_kh}}</FONT>
						</H3>
						<label for="">Mã phiếu:</label>
						<input type="text" class="form-control" name="ma_kh" ng-model="mncc" readonly="">
						<div class="form-group">
							<label for="">Ngày chi:</label>
							<input type="date" class="form-control" name="ngay_thu" value="<?php echo $ngay_hientai ?>">
						</div>
						<div class="form-group">
							<label for="">Số tiền chi:</label>
							<input type="text" class="form-control price" name="tien_thu" placeholder="Tiền chi" required>
						</div>
						<div class="form-group">
							<label for="">Ghi chú:</label>
							<textarea rows="3" class="form-control" name="noi_dung" placeholder="Nội dung"></textarea>
						</div>
						<button type="submit" class="btn btn-success notify">Cập nhật</button>

					</div>
					<div class="col-sm-6">
						<div class="form-group">
							<label for="">Nhập tên nhà cung cấp</label>
							<input type="text" class="form-control" ng-model="tenncc" ng-keyup="get_ncc()">
						</div>
						<div style="max-height: auto; overflow-y: auto">
							<table class="table table-bordered table-inverse table-hover">
								<thead>
									<tr>
										<th>Tên nhà cung cấp</th>
										<th>Mobile</th>
										<th>Địa chỉ</th>
									</tr>
								</thead>
								<tbody>
									<tr ng-repeat="ncc in nccs" ng-click="chon_ncc(ncc)">
										<td>{{ncc.ten_kh}}</td>
										<td>{{ncc.mobile}}</td>
										<td>{{ncc.dia_chi}}</td>
									</tr>
								</tbody>
							</table>
						</div>
					</div>
				</div>



			</form>
		</div>
	</div>
</div>



<?php

$bangdsnv = mysqli_query($conn, "SELECT pt.ma_phieuthu,pt.ngay_thu,pt.tien_thu,pt.noi_dung,pt.ma_kh,pt.phanloaithuchi,kh.ten_kh from phieu_thu pt join khach_hang kh on kh.ma_kh = pt.ma_kh where pt.phanloaithuchi = 'Phiếu chi'");
?>
<div class="container-fluid" style="margin-top: 20px">
	<div class="card text-dark" style="max-width: 100%;">
		<div class="card-header bg-gray" style="color: black">BẢNG CHI</div>
		<div class="card-body">

			<div class="table-responsive">
				<!-- Table -->

				<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
					<thead>
						<tr>

							<th>Ngày chi</th>
							<th>Nhà cung cấp</th>
							<th>Ghi chú</th>
							<th class="text-right">Tiền chi</th>
							<th></th>
						</tr>
					</thead>
					<tbody>
						<?php foreach ($bangdsnv as $key => $dsnv) : ?>
							<tr>

								<td><?php echo $dsnv['ngay_thu'] ?></td>
								<td><?php echo $dsnv['ten_kh'] ?></td>
								<td><?php echo $dsnv['noi_dung'] ?></td>
								<td class="text-right"><?php echo number_format($dsnv['tien_thu']) ?></td>
								<td style="text-align: center;">
									<a href="phieuchi_sua.php?ma_phieuthu=<?php echo $dsnv['ma_phieuthu'] ?>" title="Sửa">
										<i class="far fa-edit" style="color: green"></i> | </a>
									<a href="phieuchi_xoa.php?ma_phieuthu=<?php echo $dsnv['ma_phieuthu'] ?>" title="Xóa">
										<i class="far fa-trash-alt" style="color: red"></i></a>
								</td>

							</tr>
						<?php endforeach; ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>


<?php include 'chan-trang.php' ?>