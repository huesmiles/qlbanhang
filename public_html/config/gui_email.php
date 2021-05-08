<?php
	include '../dau-trang.php';
	include "PHPMailer/PHPMailer.php";
	include "PHPMailer/Exception.php";
	include "PHPMailer/OAuth.php";
	include "PHPMailer/POP3.php";
	include "PHPMailer/SMTP.php";
	 
	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\Exception;

	$mail = new PHPMailer(true);                              // Passing `true` enables exceptions

	function sendMail($title, $content, $nTo, $mTo,$diachicc=''){
	    $nFrom = 'Thông báo hạn hết hạn sử dụng';
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
		$customers_ids = explode(',', $_POST['customers_ids']);
		$mail_title = explode(',', $_POST['mail_title']);
		$mail_content = explode(',', $_POST['mail_content']);

	 ?>


	<!-- <?php print_r($_POST) ?> -->
</div>
<?php include '../chan-trang.php' ?>