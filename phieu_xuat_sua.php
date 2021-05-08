<?php 
include 'dau-trang.php';
?>
<?php 
if (isset($_GET['ma_phieuxuat'])) {
	$ma_phieuxuat = $_GET['ma_phieuxuat'];
	
	$bang_px = mysqli_query($conn,"SELECT pn.ma_phieuxuat,pn.ma_kh,pn.ngay_xuat,pn.ghi_chu_dh,ncc.ten_kh,pn.tien_km_don_hang,pn.tien_ship_dh FROM phieu_xuat pn join khach_hang ncc on ncc.ma_kh = pn.ma_kh where pn.ma_phieuxuat =  '$ma_phieuxuat'");
	$thongtin_pn = mysqli_fetch_assoc($bang_px);	
	
	$bang_ctn = mysqli_query($conn,"SELECT  ctn.ma_hh,ctn.sl,ctn.don_gia,ctn.ma_phieuxuat,hh.ten_hh FROM chitiet_px ctn join hang_hoa hh on ctn.ma_hh = hh.ma_hh where ma_phieuxuat =  $ma_phieuxuat");
	if (isset($_POST['ma_hh'])) {
		$ma_hh = $_POST['ma_hh'];
		$sl = $_POST['soluong'];
		$don_gia = str_replace(',', '',$_POST['dongia']);
		$sql_pn = mysqli_query($conn,"UPDATE chitiet_px SET ma_phieuxuat='$ma_phieuxuat',ma_hh='$ma_hh',sl='$sl',don_gia='$don_gia' where ma_phieuxuat =  $ma_phieuxuat");
		if ($sql_pn) {
			echo "thành công";
		}
	}
	
	if (isset($_POST['ngay_xuat'])) {
		$ngay_xuat = $_POST['ngay_xuat'];
		$sql_nx = mysqli_query($conn,"UPDATE phieu_xuat SET ngay_xuat = '$ngay_xuat'where ma_phieuxuat =  $ma_phieuxuat");
		if ($sql_nx) {
			header('location: phieu_xuat_sua.php?ma_phieuxuat='.$ma_phieuxuat);
		}
	}
	
	if (isset($_POST['tien_km_don_hang'])) {
		$tien_km_don_hang = str_replace(',', '',$_POST['tien_km_don_hang']);
		$sql_nx = mysqli_query($conn,"UPDATE phieu_xuat SET tien_km_don_hang = '$tien_km_don_hang'where ma_phieuxuat =  $ma_phieuxuat");
		if ($sql_nx) {
			header('location: phieu_xuat_sua.php?ma_phieuxuat='.$ma_phieuxuat);
		}
	}
	
	if (isset($_POST['ghi_chu_dh'])) {
		$ghi_chu_dh = $_POST['ghi_chu_dh'];
		$sql_nx = mysqli_query($conn,"UPDATE phieu_xuat SET ghi_chu_dh = '$ghi_chu_dh'where ma_phieuxuat =  $ma_phieuxuat");
		if ($sql_nx) {
			header('location: phieu_xuat_sua.php?ma_phieuxuat='.$ma_phieuxuat);
		}
	}
	}

?>

<div class="container-fluid"  style="margin-top: 20px">
<div class="card text-dark" style="max-width: 100%;">
  <div class="card-header bg-info"  style="color: white">PHIẾU XUẤT</div>
  <div class="card-body">
  	<div class="row">
  		<div class="col-sm-4">
  		  	
  	
	<table class="table table-hover">
		<tbody>
			<tr>
				<td>
					Ngày xuất
					
				</td>
				<td class="text-right">
					<form class="navbar-form pull-right" method="POST">
						<input type="date" class="text-right" name="ngay_xuat" value="<?php echo $thongtin_pn['ngay_xuat'];?>">
						<button type="submit">Sửa</button>
					</form>
				</td>
			</tr>
			


			<tr>
				<td>
					Chiết khấu %
					
				</td>
				<td class="text-right">
					<form class="navbar-form pull-right" method="POST">
						<input type="text" class="text-right price" name="tien_km_don_hang" value="<?php echo number_format($thongtin_pn['tien_km_don_hang']);?>">
						<button type="submit">Sửa</button>
					</form>
				</td>
			</tr>
			
			<tr>
				<td>
					Ghi chú
					
				</td>
				<td class="text-right">
					<form class="navbar-form pull-right" method="POST">
						<input type="text" class="text-right" name="ghi_chu_dh" value="<?php echo $thongtin_pn['ghi_chu_dh'];?>">
						<button type="submit">Sửa</button>
					</form>
				</td>
			</tr>
			<tr>
				<td>
					Số phiếu
					
				</td>
				<td class="text-right">
				
				
					<?php echo $thongtin_pn['ma_phieuxuat'] ?>
					
				</td>
				
			</tr>
			<tr>
				<td>
					Khách hàng
					
				</td>
				<td class="text-right">
					
					<?php echo $thongtin_pn['ten_kh'] ?>
				</td>
				
			</tr>
		</tbody>
	</table>
		</div>
  	

<div class="col-sm-8">

					<table class="table table-bordered table-inverse table-hover">
						<thead>
							<tr style="text-align: center;">
								<th>Hàng hóa</th>
								<th>Số lượng</th>
								<th>Đơn giá</th>
								<th></th>
							</tr>
						</thead>
						<tbody>
							
						<?php foreach ($bang_ctn as $key => $ctn): ?>
						<form action="phieu_xuat_capnhatchitiexuat.php?ma_phieuxuat=<?php echo $ctn['ma_phieuxuat'] ?>&ma_hh=<?php echo $ctn['ma_hh'] ?>" method="POST" class="form-group">
							<tr>
								<td>
									<?php echo $ctn['ten_hh']?>
								</td>
								<td style="text-align: center;">
									<input type="hidden" class="text" name="ma_hh" value="<?php echo $ctn['ma_hh']?>">
									<input type="text"  name="soluong"  style="text-align: right;" value="<?php echo number_format($ctn['sl'],2)?>">
								</td>
								<td style="text-align: center;">
									<input type="text" name="dongia" class="price" style="text-align: right;" value="<?php echo number_format($ctn['don_gia'])?>">
								</td>
								<td style="text-align: center;">
									<button type="submit" class="btn btn-sm btn-dark">Cập nhật</button>
									<a href="phieu_xuat_xoa_ctx.php?ma_phieuxuat=<?php echo $ctn['ma_phieuxuat'] ?>&ma_hh=<?php echo $ctn['ma_hh'] ?>" class="btn btn-sm btn-outline-dark">Xóa</a>
								</td>
							</tr>				
						</form>
			
						<?php endforeach ?>
						</tbody>
					</table>
					<a href="bao_cao_xuat_hang.php" class="btn btn-info">Đã sửa xong</a>
			<a href="phieu_xuat_them_ctx.php?ma_phieuxuat=<?php echo $ctn['ma_phieuxuat'] ?>" class="btn btn-outline-info">Thêm</a>
				</div>
				</div>
			
	
			</div>
		</div>
	</div>
</div>

