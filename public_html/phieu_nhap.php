<?php
include 'dau-trang.php';
?>
<?php 
$chonkh='';
$thanhcong = '';
$ngaynow = date('Y-m-d');
$quaylai = 0;
if (isset($_SESSION['kh_pn'] )) {
	$chonkh = $_SESSION['kh_pn'];
}
$hanghoa =isset($_SESSION['hhnhapkho'])  ? $_SESSION['hhnhapkho'] : [] ;

if (isset($_POST['ma_kh'])) {
	$ma_kh = $_POST['ma_kh'];
	$ngay_xuat = $_POST['ngay_xuat'];
	$ma_nv = $ad['ma_nv'];
	$tien_km_don_hang = str_replace(',', '',$_POST['tien_km_don_hang']);
	$tien_ship_dh = 0;
	$ghi_chu_dh = $_POST['ghi_chu_don_hang'];
$hinhthuctt = $_POST['hinhthuctt'];
$nhanvien = $_POST['nhanvien'];
	$phanloai = 'Phiếu nhập';
	$ma_phieuxuat = random_int(1000, 100000);
	$sql = mysqli_query($conn,"INSERT INTO phieu_xuat(ma_phieuxuat,ma_kh,ma_nv,ngay_xuat,tien_km_don_hang,ghi_chu_dh,tien_ship_dh,phanloai,hinhthuctt,nhanvien) VALUES('$ma_phieuxuat','$ma_kh','$ma_nv','$ngay_xuat','$tien_km_don_hang','$ghi_chu_dh','$tien_ship_dh','$phanloai','$hinhthuctt','$nhanvien')");
	if ($sql) {
		foreach ($hanghoa as $key => $hhx) {
			$ma_hh = $hhx['ma_hh'];
			$slctx = $hhx['sl'];
			$don_giactx = str_replace(',','', $hhx['don_gia']);
			$sql1 = mysqli_query($conn,"INSERT INTO chitiet_px(ma_phieuxuat,ma_hh,sl,don_gia) VALUES('$ma_phieuxuat','$ma_hh','$slctx','$don_giactx')");
		}
		if ($sql1) {
			$thanhcong = 'LƯU ĐƠN THÀNH CÔNG';
		}
	}
}
if (isset($_POST['btnin'])) {
	unset($_SESSION['hhnhapkho']);	
	unset($_SESSION['kh_pn']);
	header('location: phieu_nhap.php');
}
$tongtienhang =0;
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
						<a href="inphieupdf.php?ma_phieuxuat=<?php echo $ma_phieuxuat ?>" class="btn btn-sm btn-primary" target="_blank"> In đơn hàng</a>
					</form>
				</div>
			</div>
		</div>
	</div>
<?php endif ?>
<div class="container-fluid"  style="margin-top: 20px">
	<div class="card text-dark" style="max-width: 100%;">
		<div class="card-header bg-dark"  style="color: white; padding-top: 10px">PHIẾU NHẬP HÀNG HÓA</div>
		<div class="card-body">
			<div class="row">
				<!-- Chọn hàng hóa và khách hàng -->
				<div class="col-sm-8" style="background-color: #F7F7F7; padding-top: 20px;">
					<div class="row">
						<div class="col-sm-12">
							<input type="text" class="form-control" ng-model="tenhh" ng-keyup="get_hh()" placeholder="Nhập MÃ/TÊN hàng hóa">
							<form action="chon_hh_nhapkho.php" method="POST">

								<table class="table table-bordered table-inverse table-hover">

									<!-- <button class="btn btn-sm btn-secondary btn-block">OK</button> -->
									<tbody>
										<tr ng-repeat="hh in hhs">
											<!-- <td><input type="checkbox" class="mhh" name="ma_hh[]" value="{{hh.ma_hh}}"></td> -->
											<td>{{hh.ma_hh}}</td>
											<td>{{hh.ten_hh}}</td>
											<td><button class="btn btn-sm btn-danger btn-block" name="ma_hh[]" value="{{hh.ma_hh}}">Chọn</button></td>
										</tr>
									</tbody>
								</table>
							</form>
						</div>
						<div class="col-sm-12">
							<form action="chon_hh_nhapkho.php" method="POST">
								<div style="max-height: 450px; overflow-y: auto">
									<table class="table table-bordered table-inverse table-hover">
										<thead>
											<tr>
												<th style="width: 5%">STT</th>
												<th style="width: 30%">Hàng hóa</th>
												<th style="width: 20%; text-align: right;">SL</th>
												<th style="width: 20%; text-align: right;">Đơn giá</th>
												<th style="width: 20%; text-align: right;">Thành tiền</th>
												<th></th>
											</tr>
										</thead>
										<tbody>
											<?php 
											$n = 0;
											foreach ($hanghoa as $key => $hh) : 
												$n +=1;
												?>
												<tr>
													<td>
														<?php echo $n ?>
														<input type="hidden" name="ma_hh_1[<?php echo $hh['ma_hh']; ?>]" value="<?php echo $hh['ma_hh'] ?>">
													</td>
													<td>
														<?php echo $hh['ten_hh'] ?>
													</td>
													
													<td class="text-right">
														<a href="chon_hh_nhapkho.php?ma_hh=<?php echo $hh['ma_hh']?>&hd2=del1">(-)</a>
														<input  name="sl[<?php echo $hh['ma_hh']; ?>]" value="<?php echo $hh['sl'] ?>" class="text-right" size="2">
														<a href="chon_hh_nhapkho.php?ma_hh=<?php echo $hh['ma_hh']?>&hd1=add1">(+)</a>
													</td>
													
													<td class="text-right">
														<input  name="don_gia[<?php echo $hh['ma_hh']; ?>]" value="<?php echo $hh['don_gia'] ?>" class="text-right price" size="7">
													</td>
													<td class="text-right">
														<?php 
														$giaxuat = str_replace(',','',$hh['don_gia']);
														$tongtienhang += $giaxuat*$hh['sl'];
														echo number_format($giaxuat*$hh['sl']);
														?>
													</td>
													
													<td>
														<a href="chon_hh_nhapkho.php?ma_hh=<?php echo $hh['ma_hh']?>&hd=xoa">(-)</a>
													</td>
												</tr>
											<?php endforeach; ?>
										</tbody>
									</table>
								</div>
								<?php if ($ad['cap_bac'] == 'quan_tri') : ?>
									<div style="text-align: right;"><h4>TỔNG TIỀN HÀNG = <?php echo number_format($tongtienhang).' VNĐ'; ?></h4></div>
								<?php endif ?>
								<button type="submit" class="btn btn-block btn-outline-dark"><i class="fa fa-hand-o-right" aria-hidden="true"></i> <b>Cập nhật số liệu</b></button>
							</form>		
						</div>
					</div>
				</div>
				<!-- Lưu đơn hàng -->
				<div class="col-sm-4" style="background-color: #F0F7FC; padding-top: 20px;">
					<div class="row">
						<div class="col-sm-12">
							<input type="text" class="form-control" ng-model="tenkh" ng-keyup="get_khach_hang()" placeholder="Nhập tên/mobile khách hàng">
							<table class="table table-bordered table-inverse table-hover">
								<!-- <a class="btn btn-sm btn-secondary btn-block" style="color: white">Là khách mới bạn bỏ qua ô này</a> -->
								<tbody>
									<tr ng-repeat="kh in khs">
										<td style="text-align: left;">
											<a href="chon_kh_pn.php?ma_kh={{kh.ma_kh}}" class="btn btn-sm btn-success">Chọn</a>
										</td>
										<td>{{kh.ten_kh}}</td>
										<td>{{kh.mobile}}</td>
										<td>{{kh.dia_chi}}</td>
									</tr>

								</tbody>
							</table>
						</div>
						<div class="col-sm-12">
							<?php if (($chonkh) !='') :?>
								<b>Bạn vừa chọn Khách hàng </b>
								<br>
								<b>Họ tên: </b><?php echo $chonkh['ten_kh']; ?>
								/
								<b>Mobile: </b><?php echo $chonkh['mobile']; ?>
								<br>
								<b>Địa chỉ:</b> <?php echo $chonkh['dia_chi']; ?>	
							<?php endif; ?>
							<hr>
							<form action="" method="POST" class="form-group">
								<?php if ($chonkh !='') : ?>
									<div class="row">
										<input type="hidden" name="ma_kh" value="<?php echo $chonkh['ma_kh'] ?>"> 
										<div class="col-sm-6">
											Ngày xuất
											<input  type="date"  name="ngay_xuat" class="form-control"  value="<?php echo $ngaynow ?>">
										</div>
										<div class="col-sm-6">
											Chiết khấu % :
											<input  type="text"  class="form-control price" name="tien_km_don_hang" value="0" size="5">
										</div>
<div class="col-sm-6">
											Ghi chú :
											<input  type="text" class="form-control"   name="ghi_chu_don_hang" value="" size="29">
										</div>
<div class="col-sm-6">
											Nhân viên :
											<select name="nhanvien" class="form-control">
    <option value="">--Chọn--</option>
    <option value="Nguyễn Văn A" selected="selected">Nguyễn Văn A</option>
    <option value="Đặng Văn B">Đặng Văn B</option>
</select>
										</div>
										<div class="col-sm-12">
											Hình thức thanh toán :
											<input type="radio" name="hinhthuctt" value="tienmat" checked="">
				Tiền mặt
				<input type="radio" name="hinhthuctt" value="the" >
				Thẻ
										</div>
									</div>
									<hr>
									<div class="row">
										<div class="col-sm-6">
											<button type="submit" class="btn btn-success btn-block" name="btnluudon"><i class="fa fa-floppy-o" aria-hidden="true"></i> Lưu đơn</button>
										</div>
										<div class="col-sm-6">
											<a href="https://www.youtube.com/watch?v=YPiookjDTK4" class="btn btn-outline-success  btn-block" target="_blank">Xem hướng dẫn</a>
										</div>
									</div>
								<?php endif ?>  
							</form>
						</div>
					</div>
					<!-- Hết lưu đơn hàng -->
				</div>
				<!-- Hết chọn hàng hóa và khách hàng -->
			</div>			
		</div>
		
	</div>
</div>


<?php include 'chan-trang.php' ?>
