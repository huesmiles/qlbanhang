<?php include 'dau-trang.php' ?>

<?php 
	
	$bang_ctx = mysqli_query($conn,"SELECT ctx.ma_hh,sum(ctx.sl) as slx,hh.ten_hh FROM chitiet_px ctx 
		left join hang_hoa hh on hh.ma_hh = ctx.ma_hh 
		left join phieu_xuat px on px.ma_phieuxuat = ctx.ma_phieuxuat where px.phanloai = 'Phiếu nhập'
		group by ctx.ma_hh ");

?>
<div class="container"  style="margin-top: 20px">
<div class="card text-dark" style="max-width: 100%;">
  <div class="card-header bg-dark"  style="color: white">SẢN PHẨM NHẬP</div>
  <div class="card-body">
			
		
  <div class="table-responsive">			
			<!-- Table -->

			<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
			<thead>
				<tr>	
					<th>Tên hàng</th>
					<th style="text-align: right;">Số lượng</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach ($bang_ctx as $key => $ct) : ?>					
				<tr>			
					<td><?php echo $ct['ten_hh'] ?></td>
					<td style="text-align: right;color: red"><?php echo $ct['slx'] ?></td>
				</tr>
				<?php endforeach; ?>
			</tbody>
		
		</table>
</div>
	</div>
</div>
</div>
<?php include 'chan-trang.php' ?>

