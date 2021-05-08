<?php include 'dau-trang.php' ?>


		<?php 
			if (isset($_GET['ma_kh'])) {
				$ma_kh = $_GET['ma_kh'];
				$dm = mysqli_query($conn,"SELECT ten_kh,mobile,dia_chi,email,sinhnhat FROM khach_hang where ma_kh='$ma_kh'");
				$dm_hienthi = mysqli_fetch_assoc($dm);
				if (isset($_POST['mobile'])) {
					$mobile = $_POST['mobile'];
					$dia_chi = $_POST['dia_chi'];
					$ten_kh = $_POST['ten_kh'];

					$email = $_POST['email'];

					if ($mobile!='') {
						$them_moi = mysqli_query($conn,"UPDATE khach_hang set mobile ='$mobile',dia_chi ='$dia_chi',ten_kh ='$ten_kh',email ='$email' where ma_kh='$ma_kh'");
						if ($them_moi) {								
							header('location:nhacungcap.php');
						}else{
							echo "Sửa thất bại";
						}
					}
				}
			}
		?>

<div class="container-fluid"  style="margin-top: 20px">
	<div class="card text-dark" style="max-width: 100%;">
  <div class="card-header bg-dark"  style="color: white">Sửa thông tin</div>
	  <div class="card-body">
		<form action="" method="POST">
				<label for="">Họ và tên</label>
				<input class="form-control" name="ten_kh" value="<?php echo $dm_hienthi['ten_kh'] ?>">
				<label for="">Điện thoại</label>
				<input class="form-control" name="mobile" value="<?php echo $dm_hienthi['mobile'] ?>">	
				<label for="">Địa chỉ</label>
				<input class="form-control" name="dia_chi" value="<?php echo $dm_hienthi['dia_chi'] ?>">
				<label for="">Email</label>
				<input class="form-control" name="email" value="<?php echo $dm_hienthi['email'] ?>">
				
			<button type="submit" class="btn btn-sm btn-dark" style="padding-left: 30px;padding-right: 30px; margin-top: 20px;">Chỉnh sửa</button>
			<a href="nhacungcap.php" class="btn btn-sm btn-outline-dark"  style="padding-left: 30px;padding-right: 30px; margin-top: 20px;">Không sửa</a>
		</form>
	</div>
</div>
</div>
<?php include 'chan-trang.php' ?>

