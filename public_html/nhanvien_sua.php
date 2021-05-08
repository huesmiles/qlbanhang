<?php include 'dau-trang.php' ?>
<?php 
if (isset($_GET['ma_nv'])) {
	$ma_nv = $_GET['ma_nv'];
	$dm = mysqli_query($conn,"SELECT ten_nv,mat_khau,mobile,dia_chi,cap_bac,tencuahang FROM nhan_vien where ma_nv='$ma_nv'");
	$dm_hienthi = mysqli_fetch_assoc($dm);

	if (isset($_POST['cap_bac'])) {
		$ten_nv = $_POST['ten_nv'];
		$mobile = $_POST['mobile'];
		$dia_chi = $_POST['dia_chi'];
		$cap_bac = $_POST['cap_bac'];
		$mat_khau = $_POST['mat_khau'];
		$tencuahang = $_POST['tencuahang'];
		if ($cap_bac!='') {
			$them_moi = mysqli_query($conn,"UPDATE nhan_vien set mobile ='$mobile',dia_chi ='$dia_chi',cap_bac ='$cap_bac',ten_nv ='$ten_nv',mat_khau ='$mat_khau',tencuahang ='$tencuahang' where ma_nv='$ma_nv'");
			
			if ($them_moi) {								
				header('location:nhan_vien.php');
			}else{
				echo "Sửa thất bại";
			}
		}
	}
}
?>
<div class="container-fluid"  style="margin-top: 20px">
	<div class="card text-dark" style="max-width: 100%;">
		<div class="card-header bg-info"  style="color: white">SỬA THÔNG TIN</div>
		<div class="card-body">
			<form action="" method="POST" class="form-group">
				<div class="form-group">
					<label>Tên nhân viên</label>
					<input class="form-control" name="ten_nv" value="<?php echo $dm_hienthi['ten_nv'] ?>">	
					
				</div>
				<div class="form-group">
					<label>Mật khẩu</label>
					<input class="form-control" name="mat_khau" value="<?php echo $dm_hienthi['mat_khau'] ?>">	
					
				</div>
				<div class="form-group">
					<label>Mobile</label>
					<input class="form-control" name="mobile" value="<?php echo $dm_hienthi['mobile'] ?>">	
					
				</div>
				<div class="form-group">
					<label>Địa chỉ</label>
					<input class="form-control" name="dia_chi" value="<?php echo $dm_hienthi['dia_chi'] ?>">	
					
				</div>
				<div class="form-group">
					<label>Cửa hàng</label>
					<input class="form-control" name="tencuahang" value="<?php echo $dm_hienthi['tencuahang'] ?>">	
					
				</div>
				<div class="form-group">
					<input type="radio" name="cap_bac" value="quan_tri">
					Admin
					<input type="radio" name="cap_bac" value="nhan_vien" checked="">
					Nhân viên
				</div>
				
				<button type="submit" class="btn btn-info" style="padding-left: 30px;padding-right: 30px;">Chỉnh sửa</button>
				<a href="nhan_vien.php" class="btn btn-outline-info"  style="padding-left: 30px;padding-right: 30px;">Không sửa</a>
			</form>

		</div>
	</div>
</div>
<?php include 'chan-trang.php' ?>