<?php
include 'dau-trang.php';
$ngay_hientai = date('Y-m-d');
$thanhcong = '';
if (isset($_POST['tien_thu'])) {
	$tien_thu = str_replace(',','',$_POST['tien_thu']);
	$ngay_thu = $_POST['ngay_thu'];
	$noi_dung = $_POST['noi_dung'];
	$ma_kh = $_POST['ma_kh'];
	$phanloaithuchi = $_POST['phanloaithuchi'];
	$sql = "INSERT INTO phieu_thu(tien_thu,ngay_thu,noi_dung,ma_kh,phanloaithuchi) VALUES('$tien_thu','$ngay_thu','$noi_dung','$ma_kh','$phanloaithuchi')";
	if(mysqli_query($conn,$sql)){
		$thanhcong = 'LƯU ĐƠN THÀNH CÔNG';	
	}else{
		echo 'Thêm mới không thành công';
	}
	
}
if (isset($_POST['btnin'])) {
	header('location: phieu_thu.php');
}
?>
<br>
<?php if ($thanhcong !=''): ?>
	<div class="container-fluid">
		<div class="row">
			<div class="col-sm-12">
				<div class="alert alert-danger" role="alert">
					<strong>Good!</strong> <?php echo $thanhcong ;?>
					<hr>
					<form action="" method="POST">	
						<button class="btn btn-sm btn-danger" name="btnin" >Làm Phiếu Mới</button>
						<!-- <a href="inphieupdf_nhap.php?ma_phieunhap=<?php echo $ma_phieunhap ?>" class="btn btn-sm btn-primary" target="_blank"> In đơn hàng</a> -->
					</form>
				</div>
			</div>
		</div>
	</div>
<?php endif ?>
<div class="container-fluid"  style="margin-top: 20px">
	<div class="card text-dark" style="max-width: 100%;">
		<div class="card-header bg-dark"  style="color: white">PHIẾU THU</div>
		<div class="card-body">

			<form action="" method="POST">
				<div class="row">
					
						<div class="col-sm-6" ng-show="mkh">
							<H3><FONT color="red">{{kh_da_chon.ten_kh}}</FONT></H3>
							<input type="text"  class="form-control" name="ma_kh" ng-model="mkh" readonly="">
							<div class="form-group">
								<label for="">Phân loại:</label>
								<select name="phanloaithuchi"  class="form-control">
									<option value="Phiếu thu">Phiếu thu</option>
									<option value="Phiếu chi">Phiếu chi</option>
								</select>
							</div>
							<div class="form-group">
								<label for="">Ngày thu:</label>
								<input type="date" class="form-control" name="ngay_thu"  value="<?php echo $ngay_hientai ?>">
							</div>
							<div class="form-group">
								<label for="">Số tiền thu:</label>
								<input type="text" class="form-control price" name="tien_thu" placeholder="Tiền thu" required>
							</div>
							<div class="form-group">
								<label for="">Nội dung:</label>
								<textarea rows="3" class="form-control" name="noi_dung" placeholder="Nội dung"></textarea>	
							</div>
							<button type="submit" class="btn btn-success notify">Cập nhật</button>

						</div>
						<div class="col-sm-6">
						<div class="form-group">
							<label for="">Nhập tên khách hàng</label>
							<input type="text" class="form-control" ng-model="tenkh" ng-keyup="get_khach_hang()">
						</div>
						<div style="max-height: auto; overflow-y: auto">
							<table class="table table-bordered table-inverse table-hover">
								<thead>
									<tr>
										<th>Tên khách hàng</th>
										<th>Mobile</th>
										<th>Địa chỉ</th>
									</tr>
								</thead>
								<tbody>
									<tr ng-repeat="kh in khs" ng-click="chon_kh(kh)">
										<td>{{kh.ten_kh}}</td>
										<td>{{kh.mobile}}</td>
										<td>{{kh.dia_chi}}</td>
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
	
	$bangdsnv = mysqli_query($conn,"SELECT pt.ma_phieuthu,pt.ngay_thu,pt.tien_thu,pt.noi_dung,pt.ma_kh,pt.phanloaithuchi,kh.ten_kh from phieu_thu pt join khach_hang kh on kh.ma_kh = pt.ma_kh");
		?>
	<div class="container-fluid"  style="margin-top: 20px">
		<div class="card text-dark" style="max-width: 100%;">
			<div class="card-header bg-gray"  style="color: black">BẢNG THU</div>
			<div class="card-body">
				  	
  <div class="table-responsive">			
			<!-- Table -->

			<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
					<thead>
						<tr>
							<th></th>
							<th>Ngày thu</th>
							<th>Khách hàng</th>
							<th>Nội dung</th>
							<th class="text-right">Tiền thu</th>
							<th>Phân loại</th>
							<th></th>
						</tr>
					</thead>
					<tbody>
						<?php foreach ($bangdsnv as $key => $dsnv): ?>
							<tr>
								<td><a href="inphieu_thu.php?ma_phieuthu=<?php echo $dsnv['ma_phieuthu'] ?>" class="btn btn-sm btn-success">In phiếu</a></td>
								<td><?php echo $dsnv['ngay_thu'] ?></td>
								<td><?php echo $dsnv['ten_kh'] ?></td>
								<td><?php echo $dsnv['noi_dung'] ?></td>
								<td class="text-right"><?php echo number_format($dsnv['tien_thu']) ?></td>
								<td><?php echo $dsnv['phanloaithuchi'] ?></td>
								<td style="text-align: center;">
									<a href="phieuthu_sua.php?ma_phieuthu=<?php echo $dsnv['ma_phieuthu'] ?>" title="Sửa"> <i class="fa fa-pencil-square-o fa-1x" aria-hidden="true"style="color: black"></i> | </a>
									<a href="phieuthu_xoa.php?ma_phieuthu=<?php echo $dsnv['ma_phieuthu'] ?>" title="Xóa"> <i class="fa fa-times fa-1x" aria-hidden="true" style="color: red"></i></a></td>

								</tr>
							<?php endforeach; ?>
						</tbody>
					</table>
</div>
				</div>
			</div>
		</div>


		<?php include 'chan-trang.php' ?>