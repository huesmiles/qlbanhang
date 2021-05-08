<?php 
include 'dau-trang.php';
$bang_ctx = mysqli_query($conn,"SELECT pt.ma_phieuthu,pt.ngay_thu,pt.tien_thu,pt.phanloaithuchi,pt.noi_dung,pt.ma_kh,kh.ten_kh FROM phieu_thu pt left join khach_hang kh on kh.ma_kh = pt.ma_kh where pt.phanloaithuchi='Phiếu chi'");
$tongthu = 0;
if (isset($_POST['tu_ngay'])) {
	$tu_ngay = $_POST['tu_ngay'];
	$den_ngay = $_POST['den_ngay'];
	if ($tu_ngay !='' && $den_ngay !='') {
		$bang_ctx = mysqli_query($conn,"SELECT pt.ma_phieuthu,pt.ngay_thu,pt.tien_thu,pt.phanloaithuchi,pt.noi_dung,pt.ma_kh,kh.ten_kh FROM phieu_thu pt left join khach_hang kh on kh.ma_kh = pt.ma_kh 
			where pt.ngay_thu>= '$tu_ngay' and pt.ngay_thu<= '$den_ngay' and pt.phanloaithuchi='Phiếu chi'");
		foreach ($bang_ctx as $key => $px){
			$tongthu += $px['tien_thu'];
		} 
	}elseif ($tu_ngay !='' && $den_ngay =='') {
		$bang_ctx = mysqli_query($conn,"SELECT pt.ma_phieuthu,pt.ngay_thu,pt.phanloaithuchi,pt.tien_thu,pt.noi_dung,pt.ma_kh,kh.ten_kh FROM phieu_thu pt left join khach_hang kh on kh.ma_kh = pt.ma_kh 
			where pt.ngay_thu>= '$tu_ngay'  and pt.phanloaithuchi='Phiếu chi'");
		foreach ($bang_ctx as $key => $px){
			$tongthu += $px['tien_thu'];
		} 
	}elseif ($tu_ngay =='' && $den_ngay !='') {
		$bang_ctx = mysqli_query($conn,"SELECT pt.ma_phieuthu,pt.phanloaithuchi,pt.ngay_thu,pt.tien_thu,pt.noi_dung,pt.ma_kh,kh.ten_kh FROM phieu_thu pt left join khach_hang kh on kh.ma_kh = pt.ma_kh 
			where pt.ngay_thu<= '$den_ngay'  and pt.phanloaithuchi='Phiếu chi'");
		foreach ($bang_ctx as $key => $px){
			$tongthu += $px['tien_thu'];
		} 
	}
}
?>
<div class="container-fluid"  style="margin-top: 20px">
	<div class="card text-dark" style="max-width: 100%;">
		<div class="card-header bg-dark"  style="color: white">BÁO CÁO THU</div>
		<div class="card-body">
			<form action="" method="POST">
				<input type="date" name="tu_ngay">
				<input type="date"  name="den_ngay">
				<button type="submit">Tìm kiếm</button>
			</form>
			<hr>
			<div class="table-responsive">			
				<!-- Table -->
				<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
					<thead>
						<tr>
							<th>Ngày</th>
							<th>Phân loại</th>
							<th>Khách hàng</th>
							<th>Nội dung</th>
							<th style="text-align: right;">Tiền thu</th>
							<th></th>
						</tr>
					</thead>
					<tbody>
						<?php foreach ($bang_ctx as $key => $ct) : ?>
							<tr>
								<td><?php echo $ct['ngay_thu'] ?></td>
								<td><?php echo $ct['phanloaithuchi'] ?></td>
								<td><?php echo $ct['ten_kh'] ?></td>
								<td><?php echo $ct['noi_dung'] ?></td>
								<td style="text-align: right;"><?php echo number_format($ct['tien_thu']) ?></td>
								<td style="text-align: center;">
									<a href="phieuthu_sua.php?ma_phieuthu=<?php echo $ct['ma_phieuthu'] ?>" class="btn btn-sm btn-dark">Sửa</a>
									<a href="phieuthu_xoa.php?ma_phieuthu=<?php echo $ct['ma_phieuthu'] ?>" class="btn btn-sm btn-outline-dark">Xóa</a>
								</td>
								</tr><?php endforeach; ?>
							</tbody>

						</table>
					</div>
					<h4>TỔNG TIỀN THU: <?php echo number_format($tongthu); ?></h4>

				</div>
			</div>
		</div>
		<?php include 'chan-trang.php' ?>

