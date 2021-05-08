<?php
include 'dau-trang.php';
?>
<script src="https://cdn.ckeditor.com/4.8.0/full-all/ckeditor.js"></script>
<?php 
	$bangdsnv = mysqli_query($conn,"SELECT ma_kh,ten_kh,mobile,dia_chi,email,facebook,zalo,sinhnhat from khach_hang order by ma_kh desc limit 100");
	if (isset($_POST['ngay_bd'])) {
		$ngay_bd = $_POST['ngay_bd'];
		$ngay_kt = $_POST['ngay_kt'];
		if ($ngay_bd !='') {
			$bangdsnv = mysqli_query($conn,"SELECT ma_kh,ten_kh,mobile,dia_chi,email,facebook,zalo,sinhnhat from khach_hang where month(sinhnhat) >= '$ngay_bd' and month(sinhnhat) <= '$ngay_kt'");
		}
	}
 ?>
 <br>
<div class="container-fluid"  >
	<div class="card text-dark" style="max-width: 100%;">
		<div class="card-header bg-dark"  style="color: white;">Chọn danh sách khách hàng để gửi</div>
		<div class="card-body">				
			
				<hr>
  <div class="table-responsive">			
			<!-- Table -->

			<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
				<thead>
					<tr>
						<th>Chọn</th>
						<th>Sửa</th>
						<th>Họ và tên</th>
						<th>Điện thoại</th>
						<th>Địa chỉ</th>
						
						<th>Email</th>
						
					</tr>
				</thead>
				<tbody>
					<?php foreach ($bangdsnv as $key => $dsnv): ?>
					<tr>
						<td>
							<input type="checkbox" name="customers" value="<?php echo $dsnv['ma_kh'] ?>">
						</td>
						<td>
							<a href="khachhang_sua.php?ma_kh=<?php echo $dsnv['ma_kh'] ?>" title="Sửa"><i class="fa fa-address-book" aria-hidden="true" style="color: orange"></i></a>
						</td>
						<td><?php echo $dsnv['ten_kh'] ?></td>
						<td><?php echo $dsnv['mobile'] ?></td>
						<td><?php echo $dsnv['dia_chi'] ?></td>
						
						<td><?php echo $dsnv['email'] ?></td>
						
					</tr>
					<?php endforeach; ?>
				</tbody>
			</table>
			</div>
			<hr>
			<h4>Nội dung gửi thư</h4>
			<hr class="m-y-md">
			<div>
				<form target="_blank" action="gui_email.php" method="post">
					<input type="hidden" value="" name="customers_ids">
					<label for="exampleInputName2">Tiêu đề</label>
					<input type="text" class="form-control" name="mail_title" id="" placeholder="Tiêu đề ">
					
					<br>
					
					<textarea name="mail_content" id="editor" cols="30" rows="10"> </textarea>
					<p class="lead">
						<br>
						<input type="submit" class="btn btn-success btn-sm" value="Gửi Email">
					</p>
				</form>
			</div>
			
		</div>
	</div>
</div>


<script>
	CKEDITOR.replace('editor', {
		skin: 'moono',
		enterMode: CKEDITOR.ENTER_BR,
		shiftEnterMode:CKEDITOR.ENTER_P,
		toolbar: [{ name: 'basicstyles', groups: [ 'basicstyles' ], items: [ 'Bold', 'Italic', 'Underline', "-", 'TextColor', 'BGColor' ] },
		{ name: 'styles', items: [ 'Format', 'Font', 'FontSize' ] },
		{ name: 'scripts', items: [ 'Subscript', 'Superscript' ] },
		{ name: 'justify', groups: [ 'blocks', 'align' ], items: [ 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock' ] },
		{ name: 'paragraph', groups: [ 'list', 'indent' ], items: [ 'NumberedList', 'BulletedList', '-', 'Outdent', 'Indent'] },
		{ name: 'links', items: [ 'Link', 'Unlink' ] },
		{ name: 'insert', items: [ 'Image'] },
		{ name: 'spell', items: [ 'jQuerySpellChecker' ] },
		{ name: 'table', items: [ 'Table' ] }
		],
	});
</script>

<?php include 'chan-trang.php' ?>
<script type="text/javascript">
	jQuery(document).ready(function($) {
		const setSelected = () => {
			const ids = [];
			$.each($('[name=customers]'), function(index, val) {
				if($(val).is(':checked'))
					ids.push($(val).val())
				$('[name=customers_ids]').val(ids.join(','));
			});

			// console.log(ids);
		}
		$('[name=checkall]').click(function(event) {
			if($(this).is(':checked'))
			{
				$('[name=customers]').prop('checked', true);
			}
			else
			{
				console.log('false');
				$('[name=customers]').prop('checked', false);
			}
			setSelected();
		});

		$('[name=customers]').change(function(event) {
			setSelected();

		});
	});
</script>
