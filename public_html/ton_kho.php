<?php include 'dau-trang.php' ?>
<?php 
$sqlslx = mysqli_query($conn,"SELECT h.ma_hh,h.ten_hh,h.dvt, sum(ctx.slx) as sumslx, sum(ctn.sln) as sumsln,(ctn.t_don_gia_nhap/ctn.sln) as don_gia_nhap FROM hang_hoa h
LEFT JOIN (
	SELECT ctpx.ma_hh,SUM(ctpx.sl) as 'slx' FROM chitiet_px ctpx
	left join phieu_xuat px on ctpx.ma_phieuxuat = px.ma_phieuxuat 
	WHERE px.phanloai = 'Phiếu xuất' 
	GROUP BY ma_hh
) ctx ON ctx.ma_hh = h.ma_hh
LEFT JOIN (
	SELECT ctpn.ma_hh,SUM(ctpn.sl) as 'sln', sum(ctpn.don_gia*ctpn.sl) as t_don_gia_nhap FROM chitiet_px ctpn
	left join phieu_xuat pn on ctpn.ma_phieuxuat = pn.ma_phieuxuat 
	WHERE pn.phanloai = 'Phiếu nhập' 
	GROUP BY ma_hh
) ctn ON ctn.ma_hh = h.ma_hh
group by h.ma_hh");

?>
<div class="container-fluid"  style="margin-top: 20px">
<div class="card text-dark" style="max-width: 100%;">
  <div class="card-header bg-dark"  style="color: white">BÁO CÁO TỒN KHO</div>
  <div class="card-body">

  <div class="table-responsive">			
			<!-- Table -->

			<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
		<thead>
			<tr>
				<th>Mã hàng</th>
				<th>Tên hàng</th>
				<th>SL nhập</th>
				<th>SL xuất</th>
				<th style="text-align: right">Tồn kho</th>
				<th style="text-align: right">Đơn giá TB</th>
				<th style="text-align: right">Giá trị</th>
			</tr>
		</thead>
		<tbody>
		<?php 
			$gttk = 0;
			foreach($sqlslx as $slx) : 
				$gttk += ($slx['sumsln'] - $slx['sumslx'])*$slx['don_gia_nhap'];
		?>
			<tr>
				<td style="text-align: right"><?php echo $slx['ma_hh'] ?></td>
				<td><?php echo $slx['ten_hh'] ?></td>
				<td style="text-align: right">
					<?php 
						if ($slx['sumsln'] =='') {
							$slx['sumsln'] =0;
							echo $slx['sumsln'];
						}else{
							echo $slx['sumsln'];	
						}
					?>		
				</td>
				<td style="text-align: right">
					<?php 
						if ($slx['sumslx'] =='') {
							$slx['sumslx'] =0;
							echo $slx['sumslx'];
						}else{
							echo $slx['sumslx'];	
						}
					?>			
				</td>
				<td style="text-align: right"><?php echo ($slx['sumsln'] - $slx['sumslx']); ?></td>
				<td style="text-align: right"><?php echo number_format($slx['don_gia_nhap']); ?></td>
				<td style="text-align: right"><?php echo number_format(($slx['sumsln'] - $slx['sumslx'])*$slx['don_gia_nhap']); ?></td>
			</tr>
		<?php endforeach; ?>
		</tbody>
	</table>
</div>
	<hr>
	<h4 style="text-align: right;color: red">GIÁ TRỊ TỒN KHO = 
		<?php 
	 		echo number_format($gttk); 
	 	?></h4>

	</div>
</div>
</div>

<?php include 'chan-trang.php' ?>
