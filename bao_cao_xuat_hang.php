<?php include 'dau-trang.php';
$ngayfabc = date('Y-m-d');
	$bang_px = mysqli_query($conn,"SELECT px.ma_phieuxuat,px.nhanvien,px.ma_kh,px.ngay_xuat,px.ma_nv,kh.ten_kh,nv.ten_nv,sum(ctx1.sl*ctx1.don_gia) as tong_mh,px.phanloai,px.tien_km_don_hang,px.tien_ship_dh FROM phieu_xuat px 
		join nhan_vien nv on px.ma_nv = nv.ma_nv
		join khach_hang kh on px.ma_kh = kh.ma_kh 
		join chitiet_px ctx1 on ctx1.ma_phieuxuat = px.ma_phieuxuat 
		where px.phanloai ='Phiếu xuất'
		GROUP BY px.ma_phieuxuat order by px.ma_phieuxuat desc");
	$tongtienhang=0;
	//mục này là tìm kiếm thôi
	if (isset($_POST['tu_ngay'])) {	
		$tu_ngay =  $_POST['tu_ngay'];
		$den_ngay =  $_POST['den_ngay'];
		if ($tu_ngay != '' & $den_ngay !='' ) {
			$bang_px = mysqli_query($conn,"SELECT px.ma_phieuxuat,px.nhanvien,px.ma_kh,px.phanloai,px.tien_km_don_hang,px.tien_ship_dh,px.ngay_xuat,px.ma_nv,kh.ten_kh as ten_kh,nv.ten_nv,sum(ctx1.sl*ctx1.don_gia) as tong_mh FROM phieu_xuat px 
		join nhan_vien nv on px.ma_nv = nv.ma_nv
		join khach_hang kh on px.ma_kh = kh.ma_kh 
		join chitiet_px ctx1 on ctx1.ma_phieuxuat = px.ma_phieuxuat  
				Where px.ngay_xuat >= '$tu_ngay' and px.ngay_xuat <= '$den_ngay' and px.phanloai ='Phiếu xuất'
				GROUP BY px.ma_phieuxuat order by px.ngay_xuat desc");
			foreach ($bang_px as $key => $px){

				$tongtienhang +=$px['tong_mh'];
			} 
		}else if ($tu_ngay != '' & $den_ngay =='' ) {
			$bang_px = mysqli_query($conn,"SELECT px.ma_phieuxuat,px.nhanvien,px.ma_kh,px.phanloai,px.tien_km_don_hang,px.tien_ship_dh,px.ngay_xuat,px.ma_nv,kh.ten_kh as ten_kh,nv.ten_nv,sum(ctx1.sl*ctx1.don_gia) as tong_mh FROM phieu_xuat px 
		join nhan_vien nv on px.ma_nv = nv.ma_nv
		join khach_hang kh on px.ma_kh = kh.ma_kh 
		join chitiet_px ctx1 on ctx1.ma_phieuxuat = px.ma_phieuxuat  
				Where px.ngay_xuat >= '$tu_ngay' and px.phanloai ='Phiếu xuất'
				GROUP BY px.ma_phieuxuat order by px.ngay_xuat desc");
			foreach ($bang_px as $key => $px){
				$tongtienhang +=$px['tong_mh'];
			} 
		}
	}
	// Hết mục tìm kiếm
?>

<!-- Bảng phiếu xuất -->
<div class="container-fluid"  style="margin-top: 20px">
<div class="card text-dark" style="max-width: 100%;">
  <div class="card-header bg-dark"  style="color: white">CHI TIẾT BÁN HÀNG</div>
  <div class="card-body">
			<form action="" method="POST">
				<!-- <legend>Tìm kiếm thông tin</legend> -->
					<input type="date" name="tu_ngay" placeholder="Ngày mua">
					<input type="date" name="den_ngay" placeholder="Ngày mua">
				<button type="submit">Tìm kiếm</button>
				
			</form>
			<hr>
<h3><font color="red"><?php echo 'TỔNG TIỀN HÀNG: '.number_format($tongtienhang); ?></font></h3>
<hr>			
  <div class="table-responsive">			
			<!-- Table -->

			<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
				<thead>
					<tr style="text-align: center;">
						<th>Ngày xuất</th>
						<th>Khách hàng</th>
						<th>Nhân viên</th>
						<th>Tiền hàng</th>
						<th>Tiền KM %</th>
						<th>Thành tiền</th>
						<th>Chi tiết</th>
						<th>Sửa</th>
					
						<th>Xóa</th>
						
					</tr>
				</thead>
				<tbody>
					<?php 
						foreach ($bang_px as $key => $px): 
					?>
					<tr>
						<td><?php echo $px['ngay_xuat'] ?></td>
						<td><?php echo $px['ten_kh'] ?></td>
						<td><?php echo $px['nhanvien'] ?></td>
						<td style="text-align: right;"><?php echo number_format($px['tong_mh']) ?></td>
						<td style="text-align: right;"><?php echo number_format($px['tien_km_don_hang']) ?></td>
						<td style="text-align: right;"><?php echo number_format($px['tong_mh']*(1-$px['tien_km_don_hang']*0.01)) ?></td>

					<!-- Modal Chi tiết xuất -->
						<td style="text-align: center;">
							<a data-toggle="modal" href='#modal-<?php echo $px['ma_phieuxuat'] ?>'> <i class="fa fa-address-book" aria-hidden="true" style="color: orange"></i></a>
						</td>
						<td style="text-align: center;">
							<a href="phieu_xuat_sua.php?ma_phieuxuat=<?php echo $px['ma_phieuxuat'] ?>"> <i class="fa fa-pencil-square-o fa-1x" aria-hidden="true"style="color: black"></i></a>
							</td>
							
						<td style="text-align: center;">
							<a href="xoa_phieu_xuat.php?ma_phieuxuat=<?php echo $px['ma_phieuxuat'] ?>"> <i class="fa fa-times fa-1x" aria-hidden="true" style="color: red"> </i></a>
						</td>
						<div class="modal fade" id="modal-<?php echo $px['ma_phieuxuat'] ?>">
							<div class="modal-dialog modal-lg">
								<div class="modal-content">
									<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
									</div>
									<div class="modal-body">
										<?php 
											$ma_phieuxuat = $px['ma_phieuxuat'];
											$bang_ctx1 = mysqli_query($conn,"SELECT ctx.ma_hh,ctx.ma_phieuxuat,ctx.sl,ctx.don_gia,hh.ten_hh as tenhh,hh.dvt FROM chitiet_px ctx 
												left join hang_hoa hh on hh.ma_hh = ctx.ma_hh where ctx.ma_phieuxuat = $ma_phieuxuat");
										?>
										<div class="row">
											<div class="col-md-6"><b>TÊN HÀNG HÓA</b></div>
											<div class="col-md-3" style="text-align: right"><b>SỐ LƯỢNG</b></div>
											<div class="col-md-3" style="text-align: right"><b>ĐƠN GIÁ</b></div>
										</div>
										<hr>
										<div class="row">
											<?php foreach ($bang_ctx1 as $key => $ctx) : ?>
												<div class="col-md-6"><?php echo $ctx['tenhh'] ?></div>
												
												<div class="col-md-3" style="text-align: right"><?php echo $ctx['sl'] ?></div>
												<div class="col-md-3" style="text-align: right"><?php echo number_format($ctx['don_gia']) ?></div>						
											<?php endforeach; ?>
										</div>
									</div>
								</div>
							</div>
						</div>
					<!-- Hết Modal -->
					</tr>
					<?php endforeach ?>
				</tbody>
			</table>
			</div>
		</div>
	</div>
</div> 		
<?php include 'chan-trang.php' ?>



