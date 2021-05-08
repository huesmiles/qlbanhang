<?php include 'dau-trang.php';
// include 'kiem_tra_cap_bac.php';
?>
<?php 
	if (isset($_GET['ma_kh'])) {
		$ma_kh = $_GET['ma_kh'];
		// Tổng số đơn hàng
		$tongsodonhang = mysqli_query($conn,"SELECT count(ma_phieuxuat) as n FROM phieu_xuat where ma_kh = '$ma_kh'");
		$count = mysqli_fetch_assoc($tongsodonhang);

		// tổng tiền ở phiếu xuất =tien_ship_dh - tien_km_don_hang - tien_thu_truoc
		$sql_px =  mysqli_query($conn,"SELECT ma_phieuxuat,ma_kh,ngay_xuat,sum(tien_thu_truoc + tien_km_don_hang - tien_ship_dh) as tien_px FROM phieu_xuat where ma_kh='$ma_kh'");
		$tong_tien_px = mysqli_fetch_assoc($sql_px);
		// Chi tiết bán hàng
		$bang_px = mysqli_query($conn, "SELECT px.ma_phieuxuat,px.ma_kh,px.ngay_xuat,px.tien_thu_truoc,px.tien_km_don_hang,px.tien_ship_dh,sum(ctx.don_gia*ctx.sl) as tienhang FROM phieu_xuat px 
			join chitiet_px ctx on ctx.ma_phieuxuat = px.ma_phieuxuat
			where px.ma_kh='$ma_kh' group by px.ma_phieuxuat ");
		
		// Tổng tiền hàng 
		$sql_ctx = "SELECT sum(ctx.don_gia*ctx.sl) as tongtienhang,ctx.ma_phieuxuat FROM chitiet_px ctx 
			join phieu_xuat px on ctx.ma_phieuxuat = px.ma_phieuxuat
			where px.ma_kh='$ma_kh'";
		$bang_ctx = mysqli_query($conn,$sql_ctx);
		$bang_ctx_tong = mysqli_fetch_assoc($bang_ctx);
		// Tổng tiền phiếu thu
		$sql_pt = mysqli_query($conn,"SELECT ma_kh,sum(tien_thu) as tong_thu FROM phieu_thu 
						where ma_kh='$ma_kh'");
		$tong_phieu_thu = mysqli_fetch_assoc($sql_pt);	
		// Hiển thị danh sách phiếu thu
		$bangphieuthu = mysqli_query($conn,"SELECT ma_phieuthu,ngay_thu,ma_kh,tien_thu,noi_dung FROM phieu_thu where ma_kh='$ma_kh'");		
	}
	
	// Tìm kiếm theo ngày theo phiếu chi tiết xuất
	if (isset($_POST['tu_ngay'])) {
		$tu_ngay = $_POST['tu_ngay'];
		$den_ngay = $_POST['den_ngay'];
		if ($tu_ngay !='' and $den_ngay =='') {
			$bang_px = mysqli_query($conn, "SELECT px.ma_phieuxuat,px.ma_kh,px.ngay_xuat,px.tien_thu_truoc,px.tien_km_don_hang,sum(ctx.don_gia*ctx.sl) as tienhang FROM phieu_xuat px 
			join chitiet_px ctx on ctx.ma_phieuxuat = px.ma_phieuxuat
			where px.ma_kh='$ma_kh' and px.ngay_xuat >= '$tu_ngay'  
			group by px.ma_phieuxuat");
		}else if ($tu_ngay !='' and $den_ngay !='') {
			$bang_px = mysqli_query($conn, "SELECT px.ma_phieuxuat,px.ma_kh,px.ngay_xuat,px.tien_thu_truoc,px.tien_km_don_hang,sum(ctx.don_gia*ctx.sl) as tienhang FROM phieu_xuat px 
			join chitiet_px ctx on ctx.ma_phieuxuat = px.ma_phieuxuat
			where px.ma_kh='$ma_kh' and px.ngay_xuat >= '$tu_ngay' and px.ngay_xuat<= '$den_ngay'
			group by px.ma_phieuxuat");
		}else if ($tu_ngay =='' and $den_ngay !='') {
			$bang_px = mysqli_query($conn, "SELECT px.ma_phieuxuat,px.ma_kh,px.ngay_xuat,px.tien_thu_truoc,px.tien_km_don_hang,sum(ctx.don_gia*ctx.sl) as tienhang FROM phieu_xuat px 
			join chitiet_px ctx on ctx.ma_phieuxuat = px.ma_phieuxuat
			where px.ma_kh='$ma_kh' and px.ngay_xuat<= '$den_ngay'
			group by px.ma_phieuxuat");
		}
	}

	// Tìm kiếm theo ngày theo phiếu thu
	if (isset($_POST['tu_ngay1'])) {
		$tu_ngay1 = $_POST['tu_ngay1'];
		$den_ngay1 = $_POST['den_ngay1'];
		if ($tu_ngay1 !='' and $den_ngay1 =='') {
			$bangphieuthu = mysqli_query($conn,"SELECT ma_phieuthu,ngay_thu,ma_kh,tien_thu,noi_dung FROM phieu_thu where ma_kh='$ma_kh' and ngay_thu >= '$tu_ngay1'");
		}else if ($tu_ngay1 !='' and $den_ngay1 !='') {
			$bangphieuthu = mysqli_query($conn,"SELECT ma_phieuthu,ngay_thu,ma_kh,tien_thu,noi_dung FROM phieu_thu where ma_kh='$ma_kh' and ngay_thu >= '$tu_ngay1' and ngay_thu<= '$den_ngay1'");
		}else if ($tu_ngay1 =='' and $den_ngay1 !='') {
			$bangphieuthu = mysqli_query($conn,"SELECT ma_phieuthu,ngay_thu,ma_kh,tien_thu,noi_dung FROM phieu_thu where ma_kh='$ma_kh' and ngay_thu<= '$den_ngay1'");
		}
	}
	
?>
<div class="container-fluid"  style="margin-top: 20px">
<div class="card text-dark" style="max-width: 100%;">
  <div class="card-header bg-gray"  style="color: black">CHI TIẾT CÔNG NỢ</div>
  <div class="card-body">
	<h3>TỔNG NỢ = <?php echo number_format($bang_ctx_tong['tongtienhang'] - ($tong_phieu_thu['tong_thu'] + $tong_tien_px['tien_px'])) ?> VNĐ</h3>
	<h4><i style="color: red"><?php echo "Tổng số đơn hàng : ".$count['n']; ?></i></h4>
	<hr>
<h5>Tổng hợp phiếu xuất</h5>
	
		<form action="" method="POST">
			<input type="date"  name="tu_ngay" >
			<input type="date"   name="den_ngay" >
		<button type="submit" class="btn btn-sm btn-dark" style="margin-bottom: 3px">Tìm kiếm</button>
		</form>
		
		<div style="max-height: 350px; overflow-y: auto">
		<table class="table table-bordered table-inverse table-hover">
			<thead>
				<tr>
					<th>Ngày xuất</th>
					<th class="text-right">Tiền trả trước</th>
					<th class="text-right">Tiền ship</th>


					<th class="text-right">Tiền khuyến mại đơn hàng</th>
					<th class="text-right">Tiền hàng</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach ($bang_px as $key => $kh): ?>
					<tr>
						<td><?php echo $kh['ngay_xuat'] ?></td>
						<td class="text-right"><?php echo number_format($kh['tien_thu_truoc']) ?></td>
						<td class="text-right"><?php echo number_format($kh['tien_ship_dh']) ?></td>


						<td class="text-right"><?php echo number_format($kh['tien_km_don_hang']) ?></td>
						<td class="text-right"><?php echo number_format($kh['tienhang']) ?></td>
					</tr>
				<?php endforeach ?>
			</tbody>
		</table>
		</div>
		<hr>
	<h5>Tổng hợp phiếu thu</h5>
	
		<form action="" method="POST">
			
				<input type="date" name="tu_ngay1" >
				<input type="date" name="den_ngay1" >
			
			<button type="submit" class="btn btn-dark btn-sm" style="margin-bottom: 3px">Tìm kiếm</button>
		</form>
		<div style="max-height: 350px; overflow-y: auto">
		<table class="table table-bordered table-inverse table-hover">
			<thead>
				<tr>
					<th>Ngày thu</th>
					<th class="text-right">Tiền thu</th>
					<th class="text-right">Nội dung</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach ($bangphieuthu as $key => $bpt): ?>
					<tr>
						<td><?php echo $bpt['ngay_thu'] ?></td>
						<td class="text-right"><?php echo number_format($bpt['tien_thu']) ?></td>
						<td class="text-right"><?php echo $bpt['noi_dung'] ?></td>
					</tr>
				<?php endforeach ?>
			</tbody>
		</table>
	</div>
</div>
</div>
</div>
 		
<?php include 'chan-trang.php' ?>



