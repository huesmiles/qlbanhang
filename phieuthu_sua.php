<?php include 'dau-trang.php' ?>


		<?php 
			if (isset($_GET['ma_phieuthu'])) {
				$ma_phieuthu = $_GET['ma_phieuthu'];
				$dm = mysqli_query($conn,"SELECT ma_phieuthu,ngay_thu,tien_thu,noi_dung,ma_kh,phanloaithuchi FROM phieu_thu where ma_phieuthu='$ma_phieuthu'");
				$dm_hienthi = mysqli_fetch_assoc($dm);
				if (isset($_POST['tien_thu'])) {
					$tien_thu = str_replace(',','',$_POST['tien_thu']);
					$noi_dung = $_POST['noi_dung'];
					$phanloaithuchi = $_POST['phanloaithuchi'];
					if ($tien_thu!='') {
						$them_moi = mysqli_query($conn,"UPDATE phieu_thu set tien_thu ='$tien_thu',noi_dung ='$noi_dung',phanloaithuchi ='$phanloaithuchi' where ma_phieuthu='$ma_phieuthu'");
						if ($them_moi) {								
							header('location:phieu_thu.php');
						}else{
							echo "Sửa thất bại";
						}
					}
				}
			}
		?>
<div class="container-fluid"  style="margin-top: 20px">
<div class="card text-dark" style="max-width: 100%;">
  <div class="card-header bg-dark"  style="color: white">SỬA PHIẾU THU</div>
  	<div class="card-body">
		<form action="" method="POST">
		<div class="form-group">
		
				<label>Ngày thu</label>	
				<input type="date" class="text-right" name="ngay_thu" value="<?php echo $dm_hienthi['ngay_thu'];?>">
			</div>
			<div class="form-group">
				<label>Tiền thu</label>	
				<input class="form-control price" name="tien_thu" value="<?php echo $dm_hienthi['tien_thu'] ?>">	
			</div>
			<div class="form-group">
				<label>Ghi chú</label>	
				<input class="form-control" name="noi_dung" value="<?php echo $dm_hienthi['noi_dung'] ?>">	
			</div>
			<div class="form-group">
				<label for="">Phân loại:</label>
				<select name="phanloaithuchi"  class="form-control">
					<option value="<?php echo $dm_hienthi['phanloaithuchi'] ?>"><?php echo $dm_hienthi['phanloaithuchi'] ?></option>
					<option value="Phiếu thu">Phiếu thu</option>
					<option value="Phiếu chi">Phiếu chi</option>
				</select>
			</div>
			<button type="submit" class="btn btn-sm btn-dark">Chỉnh sửa</button>
			<a href="phieu_thu.php" class="btn btn-sm btn-outline-dark">Không sửa</a>
		</form>
	</div>
</div>
</div>
<?php include 'chan-trang.php' ?>