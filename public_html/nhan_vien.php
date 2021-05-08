<?php
	include 'dau-trang.php';
?>
<?php if ($ad['cap_bac'] == 'quan_tri') : ?>
<?php 
$erors = [];
if (isset($_POST['ten_nv'])) {
	$ten_nv = $_POST['ten_nv'];
	 $length_user = strlen($_POST['ten_nv']);
 if ($length_user <=3) {
     echo "BẠN CẦN NHẬP USERNAME LỚN HƠN 3 CHỮ CÁI";
 } else{
	$mobile = $_POST['mobile'];
	$dia_chi = $_POST['dia_chi'];
	$cap_bac = $_POST['cap_bac'];
	$tencuahang = $_POST['tencuahang'];
	
	// echo password_hash($_POST['mat_khau'], PASSWORD_BCRYPT, $options);
	$mat_khau = $_POST['mat_khau'];
	$mat_khau_1 = $_POST['mat_khau_1'];
	if ($mat_khau != $mat_khau_1) {
		$erors['Nhap_lai_mat_khau'] = 'Mật khẩu không chính xác';
	}else{
		$mat_khau = $_POST['mat_khau'];
	}
	if (!$erors) {
		$sql = "INSERT INTO nhan_vien(ten_nv,mat_khau,mobile,dia_chi,cap_bac,tencuahang) VALUES('$ten_nv','$mat_khau','$mobile','$dia_chi','$cap_bac','$tencuahang')";
		if(mysqli_query($conn,$sql)){
			header('location: nhan_vien.php');
		}else{
			$erors['Loi_them_moi'] = 'Thêm mới không thành công';
		}
	}
} }
?>
<?php if($erors) : ?>
		<?php foreach ($erors as $key => $er): ?>
			<div class="alert alert-danger">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
				<?php echo $er; ?>
			</div>
		<?php endforeach ?>
	<?php endif; ?>
<div class="container-fluid"  style="margin-top: 20px">
<div class="card text-dark" style="max-width: 100%;">
  <div class="card-header bg-dark"  style="color: white">CẬP NHẬT NHÂN VIÊN</div>
  	<div class="card-body">
		<form action="" method="POST">
			<div class="form-group">
				<input type="radio" name="cap_bac" value="quan_tri">
				Admin
				<input type="radio" name="cap_bac" value="nhan_vien" checked="">
				Nhân viên
			</div>
			<div class="row">
				<div class="col-sm-6">
				  	<label for="">Họ và tên</label>
				<input type="text" class="form-control" name="ten_nv" placeholder="Họ và tên" required>
				</div>
				<div class="col-sm-6">
				  	<label for="">Điện thoại</label>
				<input type="text" class="form-control" name="mobile" placeholder="Điện thoại">
				</div>
			</div>
			<div class="form-group">
				<label for="">Địa chỉ</label>
				<input type="text" class="form-control" name="dia_chi" placeholder="Địa chỉ">
			</div>
			<div class="form-group">
				<label for="">Tên cửa hàng</label>
				<input type="text" class="form-control" name="tencuahang" placeholder="Tên cửa hàng của Bạn">
			</div>
			<div class="row">
				<div class="col-sm-6">
				  <label for="">Mật khẩu</label>
				<input type="password" class="form-control" name="mat_khau" placeholder="Mật khẩu" >
				</div>
				<div class="col-sm-6">
				  	<label for="">Nhập lại mật khẩu</label>
				<input type="password" class="form-control" name="mat_khau_1" placeholder="Nhập lại mật khẩu" value="1">
				</div>
			</div>	
			<br>
			<button type="submit" class="btn btn-sm btn-success">Cập nhật</button>
			
		</form>
		</div>
		
	</div>
</div>


	<?php 
		$bangdsnv = mysqli_query($conn,"SELECT ma_nv,ten_nv,mat_khau,mobile,dia_chi,cap_bac from nhan_vien");
	 ?>
<div class="container-fluid"  style="margin-top: 20px">
	<div class="card text-dark" style="max-width: 100%;">
	  <div class="card-header bg-gray"  style="color: black">DANH SÁCH NHÂN VIÊN</div>
	  <div class="card-body">
	  <div style="max-height: auto; overflow-y: auto">		
			<!-- Table -->
			<table class="table table-bordered table-inverse table-hover">
				<thead>
					<tr>
						<th>Sửa</th>
						<th>Xóa</th>
						<th>Mã NV</th>
						<th>Họ và tên</th>
						<th>Điện thoại</th>
						<th>Địa chỉ</th>
						<th>Cấp bậc</th>
						
					</tr>
				</thead>
				<tbody>
					<?php foreach ($bangdsnv as $key => $dsnv): ?>
					<tr>
						<td style="text-align: center;">
							<a href="nhanvien_sua.php?ma_nv=<?php echo $dsnv['ma_nv'] ?>" title="Sửa"><i class="fa fa-address-book" aria-hidden="true" style="color: orange"></i></a>
						</td>
						<td style="text-align: center;">
							<a href="nhanvien_xoa.php?ma_nv=<?php echo $dsnv['ma_nv'] ?>" title="Sửa"><i class="fa fa-address-book" aria-hidden="true" style="color: orange"></i></a>
						</td>
						<td><?php echo $dsnv['ma_nv'] ?></td>
						<td><?php echo $dsnv['ten_nv'] ?></td>
						<td><?php echo $dsnv['mobile'] ?></td>
						<td><?php echo $dsnv['dia_chi'] ?></td>
						<td><?php echo $dsnv['cap_bac'] ?></td>
						
					</tr>
					<?php endforeach; ?>
				</tbody>
			</table>
			</div>
			
		</div>
	</div>
</div>


<?php endif; ?>
<?php include 'chan-trang.php' ?>