<?php include 'dau-trang.php';
	// Chỗ này phải tính riêng công nợ mua hàng và công nợ bán hàng vì nhà cung cấp cũng có thể mua hàng của mình, khách hàng cũng có thể là nhà cung cấp
	$bang_kh = mysqli_query($conn,"SELECT kh.ma_kh,kh.ten_kh,kh.mobile,kh.dia_chi,px1.tien_px,pn1.tien_pn,pt.tienthu,pc.tienchi,px.tienhangpx,pn.tienhangpn FROM khach_hang kh
		LEFT JOIN (
			SELECT sum(tien_thu) as tienthu,ma_kh FROM phieu_thu 
			where phanloaithuchi ='Phiếu thu'
			GROUP BY ma_kh
		) pt ON kh.ma_kh = pt.ma_kh
		LEFT JOIN (
			SELECT sum(tien_thu) as tienchi,ma_kh FROM phieu_thu 
			where phanloaithuchi ='Phiếu chi'
			GROUP BY ma_kh
		) pc ON kh.ma_kh = pc.ma_kh
		LEFT JOIN (
			SELECT sum(tien_km_don_hang - tien_ship_dh) as tien_px,ma_kh FROM  phieu_xuat
			where phanloai = 'Phiếu xuất'
			 GROUP BY ma_kh
		) px1 ON kh.ma_kh = px1.ma_kh
		LEFT JOIN (
			SELECT sum(tien_km_don_hang - tien_ship_dh) as tien_pn,ma_kh FROM  phieu_xuat
			where phanloai = 'Phiếu nhập'
			 GROUP BY ma_kh
		) pn1 ON kh.ma_kh = px1.ma_kh
		LEFT JOIN (
			SELECT sum(ctx.don_gia*ctx.sl) as tienhangpx,px121.ma_kh FROM chitiet_px ctx  
			left join phieu_xuat px121 on ctx.ma_phieuxuat = px121.ma_phieuxuat
			where px121.phanloai ='Phiếu xuất'
			GROUP BY px121.ma_kh
		) px ON kh.ma_kh = px.ma_kh
		LEFT JOIN (
			SELECT sum(ctx.don_gia*ctx.sl) as tienhangpn,px12.ma_kh FROM chitiet_px ctx  
			left join phieu_xuat px12 on ctx.ma_phieuxuat = px12.ma_phieuxuat
			where px12.phanloai ='Phiếu nhập'
			GROUP BY px12.ma_kh
		) pn ON kh.ma_kh = pn.ma_kh
		group by kh.ma_kh ");
?>
<div class="container-fluid"  style="margin-top: 20px">
<div class="card text-dark" style="max-width: 100%;">
  <div class="card-header bg-dark"  style="color: white">CÔNG NỢ KHÁCH HÀNG</div>
  <div class="card-body">
  <div class="table-responsive">			
			<!-- Table -->

			<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
		<thead>
			<tr>
				<th></th>
				<th>Tên khách hàng</th>
				<th>Mobile</th>
				<th>Địa chỉ</th>
				<th>Tiền thu</th>
				<th>KM,ship PX</th>
				<th>Tiền hàng xuất</th>
				<th class="text-right" style="color: red">Công nợ KH </th>
				
				<th>Tiền chi</th>
				
				
				<th>KM,ship PN</th>
				
				<th>Tiền hàng nhập</th>
				
				<th class="text-right"  style="color: red">Công nợ NCC</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach ($bang_kh as $key => $kh): ?>
				<tr>
					<td style="text-align: center;"><a href="cong_no_kh.php?ma_kh=<?php echo $kh['ma_kh'] ?>"><i class="fa fa-address-book" aria-hidden="true" style="color: orange"></i></a></td>
					<td><?php echo $kh['ten_kh'] ?></td>
					<td><?php echo $kh['mobile'] ?></td>
					<td><?php echo $kh['dia_chi'] ?></td>
					<td class="text-right"><?php echo number_format($kh['tienthu']) ;?></td>
					<td class="text-right"><?php echo number_format($kh['tien_px']) ?></td>
					<td class="text-right"><?php echo number_format($kh['tienhangpx']) ?></td>
					<td class="text-right"  style="color: red"><?php echo number_format($kh['tienhangpx']-$kh['tien_px']-$kh['tienthu']); ?>
					</td>
					<td class="text-right"><?php echo number_format($kh['tienchi']) ;?></td>
					
					
					<td class="text-right"><?php echo number_format($kh['tien_pn']) ?></td>
					
					<td class="text-right"><?php echo number_format($kh['tienhangpn']) ?></td>
					
					<td class="text-right" style="color: red"><?php echo number_format($kh['tienhangpn']-$kh['tien_pn']-$kh['tienchi']) ?></td>
				</tr>
			<?php endforeach ?>
			
		</tbody>
	</table>
</div>
</div>
</div>
</div> 		
<?php include 'chan-trang.php' ?>