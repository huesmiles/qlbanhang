<?php
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);

header('Content-Type:application/json');

// if(isset($_GET['order']))
// {
	include '../config/ket-noi.php';
	
	
	function getCustomer($data)
	{
		global $conn;
		$customerId = 0;
		$customerData =  $data['customer'];
		$customer = mysqli_query($conn,"SELECT * FROM khach_hang where mobile = $customerData[phone]");
		$customer = mysqli_fetch_assoc($customer);
		if($customer)
		{
			$customerId = $customer['ma_kh'];
		}
		else
		{
			$sql = "INSERT INTO khach_hang(ten_kh,mobile,dia_chi) VALUES('$customerData[name]','$customerData[phone]','$customerData[address]')";
			if(mysqli_query($conn,$sql))
			{
				$customerId = $conn->insert_id;
			}
		
		}
		return $customerId;
	}
	$data = file_get_contents("php://input");
	// $data = '{"customer":{"name":"\u0110\u1ed7 ","phone":"0336564989","address":"S\u00f3c S\u01a1n"},"products":[{"product_id":450,"variation_id":0,"system_id":"1","name":"Test","quantity":1,"subtotal":"1000","total":"1000"}]}';
	if($data)
	{
		$data = json_decode($data, true);
		$ma_kh = getCustomer($data);
		$ma_nv = 1;
		$ngay_xuat = date('Y-m-d');
		$tien_thu_truoc = 0;
		$tien_km_don_hang = 0;
		$ghi_chu_dh = '';
		$tien_tra_shipper = 0;
		$tien_ship_dh = 0;


		// tao phieu xuat
		$sql = mysqli_query($conn,"INSERT INTO phieu_xuat(ma_kh,ma_nv,ngay_xuat,tien_thu_truoc,tien_km_don_hang,ghi_chu_dh,tien_tra_shipper,tien_ship_dh) VALUES('$ma_kh','$ma_nv','$ngay_xuat','$tien_thu_truoc','$tien_km_don_hang','$ghi_chu_dh','$tien_tra_shipper','$tien_ship_dh')");
		$ma_px = $conn->insert_id;
		if($ma_px)
		{
			foreach ($data['products'] as $key => $product) {
			
				$pro = mysqli_query($conn,"SELECT * FROM hang_hoa where ma_hh = $product[system_id]");
				$pro = mysqli_fetch_assoc($pro);
				
				if($pro)
				{
					$ma_hh = $product['system_id'];
					$slctx = $product['quantity'];
					$today = date('Y-m-d');
					$hsd_date = strtotime($today." +".$pro['han_su_dung']." day");
					$hsd = $pro['han_su_dung'] == 0 ? '1970-01-01' : date('Y-m-d', $hsd_date);
					$don_giactx = str_replace(',','', $product['subtotal']);
					$sql1 = mysqli_query($conn,"INSERT INTO chitiet_px(ma_phieuxuat,ma_hh,sl,don_gia,hsd) VALUES('$ma_px','$ma_hh','$slctx','$don_giactx', '$hsd')");
				}
				
				// $count++;
			}
		}
		// print_r($data);
		// die();
		// echo json_encode(['customer_id' => $data]);
	}
// }

die();
 ?>