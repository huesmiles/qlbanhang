<?php
include 'dau-trang.php';
?>
<?php 
$ngaynow = date('Y-m-d');
$hanghoa = [];
$bangdsnv = mysqli_query($conn,"SELECT ma_kh,ten_kh,mobile,dia_chi,cap_bac from khach_hang");
$bangnv = mysqli_query($conn,"SELECT ma_nv,ten_nv,mobile,dia_chi from nhan_vien ");
if(isset($_SESSION['xuat_hh_ma_vach'])) {
	$hanghoa = $_SESSION['xuat_hh_ma_vach'];
}
if (isset($_POST['tien_kh_thanh_toan'])) {
	$ma_kh = 1;
	$ma_nv = $ad['ma_nv'];
	$ngay_xuat = $ngaynow;
	$ma_phieuxuat = random_int(0,10000000);
	$tien_km_don_hang = str_replace(',', '', $_POST['tien_km_don_hang']);
	$tien_kh_thanh_toan = str_replace(',','',$_POST['tien_kh_thanh_toan']);
	$sql = mysqli_query($conn,"INSERT INTO phieu_xuat(ma_phieuxuat,ma_kh,ma_nv,ngay_xuat,tien_thu_truoc,tien_km_don_hang,tien_ship_dh,tien_tra_shipper,ghi_chu_dh) VALUES('$ma_phieuxuat','$ma_kh','$ma_nv','$ngay_xuat','0','$tien_km_don_hang','0','0','Ghi chú đơn hàng')");
	if ($sql) {
		foreach ($hanghoa as $key => $hhx) {
			$ma_hh = $hhx['ma_hh'];
			$slctx = $hhx['sl'];
			$don_giactx = str_replace(',','', $hhx['don_gia']);
			$sql1 = mysqli_query($conn,"INSERT INTO chitiet_px(ma_phieuxuat,ma_hh,sl,don_gia) VALUES('$ma_phieuxuat','$ma_hh','$slctx','$don_giactx')");					
		}
		if ($sql1) {
			// tính tiền trả lại khách tiền thừa
			// 1- tính tổng tiền hàng
			$bang_ct = mysqli_query($conn,"SELECT sum(sl*don_gia) as tongtienhang FROM chitiet_px where ma_phieuxuat = '$ma_phieuxuat'");
			$tv = mysqli_fetch_assoc($bang_ct);
			$tien_hang =  $tv['tongtienhang'];
			$update_px = mysqli_query($conn,"UPDATE phieu_xuat set tien_thu_truoc = $tien_hang where ma_phieuxuat = '$ma_phieuxuat'");
			// 2- Tính tiền thừa = tổng tiền hàng - tiền khuyến mại - tiền trả trước
			$conlai = $tien_kh_thanh_toan - $tien_hang + $tien_km_don_hang ;
		}else{
			echo "thất bại";
		}
	}
}
if (isset($_POST['btnnew'])) {
	unset($_SESSION['xuat_hh_ma_vach']);
	header('location: phieu_xuat_ma_vach.php');
}	
?>
<br>
<div class="container-fluid">
<div class="row">
	<div class="col-sm-8">
				<div class="card text-dark" style="max-width: 100%;">
					<div class="card-header bg-secondary"  style="color: white">HÀNG HÓA</div>
					<div class="card-body">	
					<form action="chon_hh_xk_ma_vach.php" method="POST">
            <div class="input-group">
                    <input class="form-control" type="text" name="ma_hh[]" placeholder="Nhập mã sản phẩm" aria-label="Search" aria-describedby="basic-addon2" autofocus="" />
                    <div class="input-group-append">
                        <button class="btn btn-primary" type="submit"><i class="fas fa-search"></i></button>
                    </div>
                </div>
          </form>
					
					<hr>
						<form method="POST" class="form-inline" action="chon_hh_xk_ma_vach.php">
							<div class="table-responsive">
								<table class="table table-bordered table-inverse table-hover">
									<thead>
										<tr>
											<th>Tên hàng</th>
											<th>Số lượng</th>
											<th>Đơn giá</th>
											<th class="text-right">Thành tiền</th>
											<th></th>
										</tr>
									</thead>
									<tbody>
										<?php 
										$tonghoadon = 0;
										foreach ($hanghoa as $key => $hh) : 
											?>
											<tr>
												<td><?php echo $hh['ten_hh'] ?>
												<input type="hidden" name="ma_hh_1[<?php echo $hh['ma_hh']; ?>]" value="<?php echo $hh['ma_hh'] ?>">
											</td>
											<td><input type="text" class="text-right"  name="sl[<?php echo $hh['ma_hh'];?>]" value="<?php echo $hh['sl'];?>" size='6'></td>
											<td><input type="text" class="price text-right"  name="don_gia[<?php echo $hh['ma_hh'];?>]" value="<?php echo $hh['don_gia'];?>" size='8'></td>
											<td class="text-right">
												<?php 
												$dongia123 = str_replace(',','', $hh['don_gia']);
												$thanhtien = $hh['sl']*$dongia123;
												$tonghoadon += $thanhtien;

												echo number_format($thanhtien);
												?>
											</td>
											<td>
												<a href="chon_hh_xk_ma_vach.php?ma_hh=<?php echo $hh['ma_hh'] ?>&hd=xoa" class="">(-)</a>
											</td>
										</tr>
									<?php endforeach; ?>
								</tbody>
							</table>
							<h4>Tổng hóa đơn: <?php echo number_format($tonghoadon) ?></h4>

						</div>
						<button type="submit" class="btn btn-lg btn-outline-danger btn-block">Xác nhận</button>
					</form>
				</div>
			</div>
		</div>

	<div class="col-sm-4">
			<div class="card text-dark" style="max-width: 100%;">
				<div class="card-header bg-secondary"  style="color: white">THANH TOÁN</div>
				<div class="card-body">	
					<form action="" method="POST" class="form-group">
						<div class="form-group">
							Khuyến mại
							<input  type="text"   class="form-control price" name="tien_km_don_hang" value="0">
						</div>
						<div class="form-group">
							Khách hàng thanh toán:
							<input type="text"   class="form-control price" name="tien_kh_thanh_toan" value="0">
						</div>
						<button type="submit" name="btnsubmit" class="btn btn-lg btn-danger btn-block">TÍNH TIỀN</button>
					</form>
					<hr>
					<form action="" method="POST" class="form-group">
						<div class="form-group">
							<h4><label>TRẢ LẠI KHÁCH : </label>
								<label>
									<?php 
									if (isset($_POST['btnsubmit'])) {
										echo '  '.number_format($conlai); 
									}

									?>
								</label></h4>
								<br>
								Tiền hàng :

								<?php 
								if (isset($_POST['btnsubmit'])) {
									echo '  '.number_format($tv['tongtienhang']); 
								}
								?>
								<br>
								Tiền khuyến mại : 
								<?php 
								if (isset($_POST['btnsubmit'])) {
									echo '  '.number_format($tien_km_don_hang); 
								}
								?>
								<br>
								Tiền khách trả :
								<?php 
								if (isset($_POST['btnsubmit'])) {
									echo '  '.number_format($tien_kh_thanh_toan); 
								}
								?>
							</div>
							<button type="submit" name="btnnew" class="btn btn-sm btn-outline-dark">Làm phiếu mới</button>
							<a href="inphieupdf_mavach.php?ma_phieuxuat=<?php echo $ma_phieuxuat ?>" target="top" name="btninhoadon" class="btn btn-sm btn-dark">In hóa đơn</a>
						</form>
						Lưu ý: Mặc định xuất cho khách hàng có Mã khách hàng là 1
					</div>
			</div>
		</div>
		
		
</div>
</div>
<?php include 'chan-trang.php' ?>