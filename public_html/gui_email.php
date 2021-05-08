<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
	include 'dau-trang.php';
	include "config/PHPMailer/PHPMailer.php";
	include "config/PHPMailer/Exception.php";
	include "config/PHPMailer/OAuth.php";
	include "config/PHPMailer/POP3.php";
	include "config/PHPMailer/SMTP.php";
	 
	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\Exception;

	$mail = new PHPMailer(true);                              // Passing `true` enables exceptions

	function sendMail($title, $content, $nTo, $mTo,$diachicc=''){
	    $nFrom = 'ƯU ĐÃI DÀNH CHO BẠN';
	    $mFrom = 'itthinhphat@gmail.com';  //dia chi email cua ban 
	    $mPass = 'kqlbofupaaibudxb';       //mat khau email cua ban
	    $mail             = new PHPMailer();
	    $body             = $content;
	    $mail->IsSMTP(); 
	    $mail->CharSet   = "utf-8";
	    $mail->SMTPDebug  = 0;                     // enables SMTP debug information (for testing)
	    $mail->SMTPAuth   = true;                    // enable SMTP authentication
	    $mail->SMTPSecure = "tls";                 // sets the prefix to the servier
	    $mail->Host       = "smtp.gmail.com";        
	    $mail->Port       = 587;
	    $mail->Username   = $mFrom;  // GMAIL username
	    $mail->Password   = $mPass;               // GMAIL password
	    $mail->SetFrom($mFrom, $nFrom);
	    //chuyen chuoi thanh mang
	    $ccmail = explode(',', $diachicc);
	    $ccmail = array_filter($ccmail);
	    if(!empty($ccmail)){
	        foreach ($ccmail as $k => $v) {
	            $mail->AddCC($v);
	        }
	    }
	    $mail->Subject    = $title;
	    $mail->MsgHTML($body);
	    $address = $mTo;
	    $mail->AddAddress($address, $nTo);
	    $mail->AddReplyTo('phucvu365@gmail.com', 'Đặng Xuân Thành');
	    if(!$mail->Send()) {
	        return 0;
	    } else {
	        return 1;
	    }
	}

?>

<div class="container">
	
	<?php 
		if(!isset($_POST['customers_ids']) &&  $_POST['customers_ids'] == '')
		{

		}
		else
		{
			$customers_ids = $_POST['customers_ids'];

			$mail_title = $_POST['mail_title'];
			$mail_content = $_POST['mail_content'];
			// echo "SELECT ma_kh,ten_kh,mobile,dia_chi,email,facebook,zalo from khach_hang where ma_kh in ('$customers_ids')";


			$bangds_kh = mysqli_query($conn,"SELECT ma_kh,ten_kh,mobile,dia_chi,email,facebook,zalo from khach_hang where ma_kh in ($customers_ids)");
			
			if (mysqli_num_rows($bangds_kh) > 0) {

				$bangds_kh = mysqli_fetch_all($bangds_kh, 1);
				foreach ($bangds_kh as $key => $kh) {
					if($kh['email'])
					{
						$kh_mobile = $kh['mobile'];
						$kh_content = str_replace('{ten_khach_hang}', $kh['ten_kh'], $mail_content);
						$kh_content = str_replace('{so_dien_thoai}', $kh['mobile'], $kh_content);
						$kh_content = str_replace('{dia_chi}', $kh['dia_chi'], $kh_content);
						$kh_content = str_replace('{email}', $kh['email'], $kh_content);
						$kh_content = str_replace('{ma_khach_hang}', $kh['ma_kh'], $kh_content);
						sendMail($mail_title, $kh_content , $kh['email'], $kh['email']);
						sleep(3);
						echo 'Gửi thành công: ' . $kh['ten_kh'] . '('.$kh['email'].')';
					}
				}
			}
			// 	

		}

	 ?>
</div>
<?php include 'chan-trang.php' ?>
<?php 

 ?>

