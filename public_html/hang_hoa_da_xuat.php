<?php include 'dau-trang.php' ?>

<?php 
	$stt = 0;
	$bang_ctx = mysqli_query($conn,"SELECT ctx.ma_hh,ctx.sl,ctx.don_gia,hh.ten_hh,px.ngay_xuat,px.ma_kh FROM chitiet_px ctx 
		left join hang_hoa hh on hh.ma_hh = ctx.ma_hh 
		left join phieu_xuat px on px.ma_phieuxuat = ctx.ma_phieuxuat 
		where px.phanloai = 'Phiếu xuất'
		order by px.ngay_xuat desc");


	if (isset($_POST['tu_ngay'])) {
		$tu_ngay = $_POST['tu_ngay'];
		if ($tu_ngay !='') {
			$bang_ctx = mysqli_query($conn,"SELECT ctx.ma_hh,ctx.sl,ctx.don_gia,hh.ten_hh,px.ngay_xuat,px.ma_kh FROM chitiet_px ctx 
		left join hang_hoa hh on hh.ma_hh = ctx.ma_hh 
		left join phieu_xuat px on px.ma_phieuxuat = ctx.ma_phieuxuat 
			where px.ngay_xuat >= '$tu_ngay' and px.phanloai = 'Phiếu xuất' order by px.ngay_xuat desc ");
		}
		
	}

?>
<div class="container-fluid">
<div class="card text-dark" style="max-width: 100%;">
  <div class="card-header bg-dark"  style="color: white">SẢN PHẨM BÁN RA</div>
  <div class="card-body">
			
	<form action="" method="POST">
			<input type="date" name="tu_ngay">
		<button type="submit" class="btn btn-dark btn-sm" style="margin-bottom: 4px ">Tìm kiếm</button>
	</form>
	<hr>
	
<div class="table-responsive">			
			<!-- Table -->
			<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
			<thead>
				<tr>	
					<th>STT</th>
					<th>Ngày</th>
					<th>Tên khách hàng</th>
					<th>Tên hàng</th>
					<th style="text-align: right;">Số lượng</th>
				</tr>
			</thead>
			<tbody>
				<?php 
					$tongsltk = 0;
					foreach ($bang_ctx as $key => $ct) : 
					$tongsltk += $ct['sl'];
					$stt +=1;
				?>					
				<tr>			
					<td><?php echo $stt ?></td>
					<td><?php echo $ct['ngay_xuat'] ?></td>
					<td>
						<?php 
							$makhhhh = $ct['ma_kh'] ;
							$bang_kh = mysqli_query($conn,"SELECT * FROM khach_hang where ma_kh = '$makhhhh' limit 1");
							$tenkhhh = mysqli_fetch_assoc($bang_kh);
							$tenkhachhang = $tenkhhh['ten_kh'];
							echo $tenkhachhang;
						?>							
					</td>
					<td><?php echo $ct['ten_hh'] ?></td>
					<td style="text-align: right;color: red"><?php echo $ct['sl'] ?></td>
				</tr>
				<?php endforeach; ?>
			</tbody>
		
		</table>
		<h4>TỔNG SỐ LƯỢNG = <?php echo $tongsltk ?></h4>
</div>
	</div>
</div>
</div>
<?php include 'chan-trang.php' ?>

