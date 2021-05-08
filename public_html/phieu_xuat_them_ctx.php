<?php
include 'dau-trang.php';
?>
<?php 
	$ma_phieuxuat= isset($_GET['ma_phieuxuat']) ? $_GET['ma_phieuxuat'] : 0;
	if (isset($_POST['soluong'])) {
		$ma_hh = $_POST['ma_hh'];

		$sl = $_POST['soluong'];
		$don_gia =  str_replace(',','', $_POST['dongia']);
		$sql_pn = mysqli_query($conn,"INSERT INTO chitiet_px(ma_hh,sl,don_gia,ma_phieuxuat) VALUES ('$ma_hh','$sl','$don_gia','$ma_phieuxuat')");
		if ($sql_pn) {
			header('location: phieu_xuat_sua.php?ma_phieuxuat='.$ma_phieuxuat);

		}
	}
$bang_hh = mysqli_query($conn,"SELECT anh_hh,ma_hh,ten_hh,dongia_ban FROM hang_hoa");
if (isset($_POST['tentk'])) {
	$tentk = $_POST['tentk'];
	if ($tentk !='') {
		$bang_hh = mysqli_query($conn,"SELECT anh_hh,ma_hh,ten_hh,dongia_ban FROM hang_hoa where ten_hh like '%$tentk%' ");
	}
}
?>

<?php if (isset($_GET['ten_hh'])) :

if (isset($_GET['ma_hh'])) {
 	$ma_hh_chon = $_GET['ma_hh'];
 	$ten_hh_chon = $_GET['ten_hh'];
 	$giale = $_GET['dongia_ban'];
 } 
	
?>
<div class="container"  style="margin-top: 20px">
<div class="card text-dark" style="max-width: 100%;">
  <div class="card-header bg-dark"  style="color: white">SẢN PHẨM BẠN THÊM</div>
  <div class="card-body">
			<form action="" method="POST" class="form-group">
			
				<div class="form-group">
					
					<input type="hidden" class="form-control" name="ma_hh" value="<?php echo $ma_hh_chon?>">
					<label for="">Tên hàng hóa : <?php echo  $ten_hh_chon?></label>
				</div>
				<div class="form-group">
					<label for="">Số lượng</label>
					<input class="form-control" name="soluong" value="1">
				</div>
				<div class="form-group">
					<label for="">Đơn giá</label>
					<input class="form-control" name="dongia" class="price" value="<?php echo  number_format($giale)?>">
				</div>
				
			
				<button type="submit" class="btn btn-dark">Cập nhật</button>
			</form>
		
</div>
</div>
</div>
<?php endif; ?>
<div class="container"  style="margin-top: 20px">
<div class="card text-dark" style="max-width: 100%;">
  <div class="card-header bg-gray"  style="color: black">SẢN PHẨM BÁN RA</div>
  <div class="card-body">
			<div class="table-responsive">
				<form action="" method="POST">
					
						<input type="text" name="tentk" placeholder="Nhập tên hàng hóa">
					
					<button type="submit" class="btn btn-dark btn-sm" style="margin-bottom: 3px">Tìm kiếm</button>
				</form>
				<div style="max-height: 450px; overflow-y: auto">
				<table class="table table-bordered table-inverse table-hover">
					<thead>
						<tr>
							<th>Tên hàng</th>
							<th class="text-right">Giá bán</th>
							<th class="text-right"></th>
						</tr>
					</thead>
					<tbody>
						<?php foreach ($bang_hh as $key => $hg): ?>
							<tr>
								<td><?php echo $hg['ten_hh']; ?></td>
								<td class="text-right"><?php echo number_format($hg['dongia_ban']); ?></td>
								<td class="text-center">
									<a href="phieu_xuat_them_ctx.php?ma_phieuxuat=<?php echo $ma_phieuxuat ?>&ma_hh=<?php echo $hg['ma_hh'] ?>&ten_hh=<?php echo $hg['ten_hh'] ?>&dongia_ban=<?php echo $hg['dongia_ban'] ?>" class="btn btn-sm btn-dark">Chọn</a>
								</td>
								
							</tr>
						<?php endforeach ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>

<?php include 'chan-trang.php' ?>