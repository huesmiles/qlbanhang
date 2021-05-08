<?php include 'dau-trang.php' ?>
<?php 
if (isset($_GET['ma_nv'])) {
	$ma_nv = $_GET['ma_nv'];
	$dm = mysqli_query($conn,"SELECT ten_nv,mat_khau,mobile,email,cap_bac,username FROM nhan_vien where ma_nv='$ma_nv'");
	$dm_hienthi = mysqli_fetch_assoc($dm);

	if (isset($_POST['cap_bac'])) {
		$ten_nv = $_POST['ten_nv'];
		$mobile = $_POST['mobile'];
		$email = $_POST['email'];
		$cap_bac = $_POST['cap_bac'];
		$mat_khau = $_POST['mat_khau'];
		$username = $_POST['username'];
		if ($cap_bac!='') {
			$them_moi = mysqli_query($conn,"UPDATE nhan_vien set mobile ='$mobile',email ='$email',cap_bac ='$cap_bac',ten_nv ='$ten_nv',mat_khau ='$mat_khau',username ='$username' where ma_nv='$ma_nv'");
			
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
					<label>Tên đăng nhập</label>
					<input class="form-control" name="username" value="<?php echo $dm_hienthi['username'] ?>">	
					
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
					<label>Email</label>
					<input class="form-control" name="email" value="<?php echo $dm_hienthi['email'] ?>">	
					
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