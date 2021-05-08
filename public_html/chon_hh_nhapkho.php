<?php include 'dau-trang.php' ?>
<?php 

$ma_hh = !empty($_POST['ma_hh']) ? $_POST['ma_hh'] : [];
$mahhxoa = !empty($_GET['ma_hh']) ? $_GET['ma_hh'] : 0;
$hd = !empty($_GET['hd']) ? $_GET['hd'] : 'them';
$hd1 = !empty($_GET['hd1']) ? $_GET['hd1'] : '';
$hd2 = !empty($_GET['hd2']) ? $_GET['hd2'] : '';
if (count($ma_hh)) {
	foreach ($ma_hh as $key => $value) {
		$tv = mysqli_query($conn,"SELECT anh_hh,ma_hh,ten_hh,dongia_nhap FROM hang_hoa where ma_hh = '$value'");
		$hh = mysqli_fetch_assoc($tv);
		if ($hh) {
			$_SESSION['hhnhapkho'][$value]['anh_hh'] = $hh['anh_hh'];
			$_SESSION['hhnhapkho'][$value]['ma_hh'] = $hh['ma_hh'];
			$_SESSION['hhnhapkho'][$value]['ten_hh'] = $hh['ten_hh'];
		
			$_SESSION['hhnhapkho'][$value]['sl'] = 1;
			$_SESSION['hhnhapkho'][$value]['don_gia'] = $hh['dongia_nhap'];
		}
	}
}


if ($hd == 'xoa') {
	unset($_SESSION['hhnhapkho'][$mahhxoa]);
}
if ($hd1 == 'add1') {
	$ma_hh1 = !empty($_GET['ma_hh']) ? $_GET['ma_hh'] : 0;
	$tv1 = mysqli_query($conn,"SELECT * FROM hang_hoa where ma_hh = '$ma_hh1'");
	$hh1 = mysqli_fetch_assoc($tv1);
			$_SESSION['hhnhapkho'][$ma_hh1]['sl'] += 1;
}
if ($hd2 == 'del1') {

	$ma_hh2 = !empty($_GET['ma_hh']) ? $_GET['ma_hh'] : 0;
	$tv2 = mysqli_query($conn,"SELECT * FROM hang_hoa where ma_hh = '$ma_hh2'");
	$hh2 = mysqli_fetch_assoc($tv2);
	// $_SESSION['hhnhapkho'][$ma_hh2]['anh_hh'] = $hh2['anh_hh'];
	// 		$_SESSION['hhnhapkho'][$ma_hh2]['ma_hh'] = $hh2['ma_hh'];
	// 		$_SESSION['hhnhapkho'][$ma_hh2]['ten_hh'] = $hh2['ten_hh'];
			$_SESSION['hhnhapkho'][$ma_hh2]['sl'] -= 1;
			// $_SESSION['hhnhapkho'][$ma_hh2]['don_gia'] = $hh2['dongia_ban'];
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
				
				if (isset($_SESSION['hhnhapkho'][$mh])) {
					$_SESSION['hhnhapkho'][$mh]['sl'] = $sl;
					$_SESSION['hhnhapkho'][$mh]['don_gia'] = $gia;
				
					
				}
			}
		}
	}

header('location: phieu_nhap.php');
// echo '<pre>';

// print_r($_SESSION['hhnhapkho']);
// echo '</pre>';

 ?>