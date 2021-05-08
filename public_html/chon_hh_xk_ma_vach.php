<?php include 'dau-trang.php' ?>
<?php 

$ma_hh = !empty($_POST['ma_hh']) ? $_POST['ma_hh'] : [];
$mahhxoa = !empty($_GET['ma_hh']) ? $_GET['ma_hh'] : 0;

$hd = !empty($_GET['hd']) ? $_GET['hd'] : 'them';
if (count($ma_hh)) {
	foreach ($ma_hh as $key => $value) {
		$tv = mysqli_query($conn,"SELECT anh_hh,ma_hh,ten_hh,dongia_ban FROM hang_hoa where ma_hh = '$value'");
		$hh = mysqli_fetch_assoc($tv);
		if ($hd == 'them' && $hh) {
			// $_SESSION['xuathh'][$value] = $hh;
			$_SESSION['xuat_hh_ma_vach'][$value]['anh_hh'] = $hh['anh_hh'];
			$_SESSION['xuat_hh_ma_vach'][$value]['ma_hh'] = $hh['ma_hh'];
			$_SESSION['xuat_hh_ma_vach'][$value]['ten_hh'] = $hh['ten_hh'];
			$_SESSION['xuat_hh_ma_vach'][$value]['sl'] = 1;			
			$_SESSION['xuat_hh_ma_vach'][$value]['don_gia'] = $hh['dongia_ban'];
		}
	}
}
if ($hd == 'xoa') {
	unset($_SESSION['xuat_hh_ma_vach'][$mahhxoa]);
}

if (isset($_POST['ma_hh_1'])) {
	$ma_hh_1 = $_POST['ma_hh_1'];
	$so_luong = $_POST['sl'];
	$giahh = $_POST['don_gia'];
	foreach ($ma_hh_1 as $key =>  $mh) {
		// print_r($so_luong[$mh]); die;
		if (isset($so_luong[$mh])) {
				$sl = $so_luong[$mh];
				$gia = $giahh[$mh];
				if (isset($_SESSION['xuat_hh_ma_vach'][$mh])) {
					$_SESSION['xuat_hh_ma_vach'][$mh]['sl'] = $sl;
					$_SESSION['xuat_hh_ma_vach'][$mh]['don_gia'] = $gia;
					
				}
			}
		}
	}

header('location: phieu_xuat_ma_vach.php');
// echo '<pre>';
// print_r($_SESSION['xuat_hh_ma_vach']);
// echo '</pre>';

 ?>

 