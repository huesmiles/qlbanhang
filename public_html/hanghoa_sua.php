<?php include 'dau-trang.php' ?>
<?php 
	if (isset($_GET['ma_hh'])) {
		$ma_hh = $_GET['ma_hh'];
		$dm = mysqli_query($conn,"SELECT ten_hh,anh_hh,nhacc,dongia_ban,dongia_nhap FROM hang_hoa where ma_hh='$ma_hh'");
		$dm_hienthi = mysqli_fetch_assoc($dm);
		if (isset($_POST['ten_hh'])) {
			$ten_hh = $_POST['ten_hh'];
			$nhacc = $_POST['nhacc'];
			$anh_hh = '';
				if (!empty($_FILES['anh_hh']['name'])) {
					$file = $_FILES['anh_hh']; // gan thong tin anh vào biến cho gọn
					
					$up = move_uploaded_file($file['tmp_name'], 'public/uploads/'.$file['name']);
					if ($up) {
						$anh_hh = $file['name'];
					}
				}
			$dongia_ban = str_replace(',', '', $_POST['dongia_ban']);
			$dongia_nhap = str_replace(',', '', $_POST['dongia_nhap']);
			if ($ten_hh!='') {
				$them_moi = mysqli_query($conn,"UPDATE hang_hoa set ten_hh ='$ten_hh',nhacc ='$nhacc',dongia_ban ='$dongia_ban',dongia_nhap ='$dongia_nhap',anh_hh ='$anh_hh' where ma_hh='$ma_hh'");
				if ($them_moi) {								
					header('location:hang_hoa.php');
				}else{
					echo "Sửa thất bại";
				}
			}
		}
	}
?>
<div class="container-fluid"  style="margin-top: 20px">
	<div class="card text-dark" style="max-width: 100%;">
  <div class="card-header bg-dark"  style="color: white">CHỈNH SỬA SẢN PHẨM</div>
  <div class="card-body">

  	<form action="" method="POST" enctype="multipart/form-data">
		<div class="row">

			<div class="col-sm-6">
				<label>Tên hàng:</label>
				<input class="form-control" name="ten_hh" value="<?php echo $dm_hienthi['ten_hh'] ?>">	
			</div>
			<div class="col-sm-4">
				<label>Nhà cung cấp</label>
				<input class="form-control" name="nhacc" value="<?php echo $dm_hienthi['nhacc'] ?>">
				
			</div>
			<div class="col-sm-2">
				<label for="">Ảnh</label>
				<input type="file" class="form-control" name="anh_hh">
			</div>
		</div>
		<div class="row">
			<div class="col-sm-6">
				<label>Giá bán</label>
				<input class="form-control price" name="dongia_ban" value="<?php echo number_format($dm_hienthi['dongia_ban']) ?>">	
			</div>
			<div class="col-sm-6">
				<label>Giá nhập</label>	
				<input class="form-control price" name="dongia_nhap" value="<?php echo number_format($dm_hienthi['dongia_nhap']) ?>">	
			</div>
		</div>		
		
			
		<button type="submit" class="btn btn-sm btn-dark" style="padding-left: 30px;padding-right: 30px; margin-top: 30px;">Chỉnh sửa</button>
		<a href="hang_hoa.php" class="btn btn-sm btn-outline-dark" style="padding-left: 30px;padding-right: 30px; margin-top: 30px;">Không sửa</a>
		
	</form>
		
</div>
<?php include 'chan-trang.php' ?>


