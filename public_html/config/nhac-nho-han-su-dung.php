<?php
include "PHPMailer/PHPMailer.php";
include "PHPMailer/Exception.php";
include "PHPMailer/OAuth.php";
include "PHPMailer/POP3.php";
include "PHPMailer/SMTP.php";
 
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$mail = new PHPMailer(true);                              // Passing `true` enables exceptions

function sendMail($title, $content, $nTo, $mTo,$diachicc=''){
    $nFrom = 'Maylocnuoc';
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
    $mail->AddReplyTo('itthinhphat@gmail.com', 'Đỗ Minh Hải');
    if(!$mail->Send()) {
        return 0;
    } else {
        return 1;
    }
}



include 'ket-noi.php';
$sql = 'SELECT * FROM chitiet_px a JOIN hang_hoa d ON d.ma_hh = a.ma_hh JOIN phieu_xuat b ON a.ma_phieuxuat = b.ma_phieuxuat JOIN khach_hang c ON c.ma_kh = b.ma_kh WHERE DATE(a.hsd) BETWEEN CURDATE() and DATE_ADD(CURDATE(), INTERVAL 30 DAY)';


$data = mysqli_query($conn, $sql);

if (mysqli_num_rows($data) > 0) {

    $data = mysqli_fetch_all($data, 1);
    $dataGroupByCustomer = [];
    foreach ($data as $element) {
        $dataGroupByCustomer[$element['ten_kh']][] = $element;
    }
    // print_r($dataGroupByCustomer);
    foreach ($dataGroupByCustomer as $key => $c) {

    }



// sendMail('Test mail', 'haha', 'minhhai27121994@gmail.com', 'minhhai27121994@gmail.com');
?>
<?php foreach ($dataGroupByCustomer as $key => $k): ?>
<?php ob_start(); ?>
<p>Thông quả hàng hóa sắp hết hạn khách hàng (<?php echo $key ?>):</p>
<table border="1" cellpadding="4">
    <thead>
        <th>Tên hàng hóa</th>
        <th>Số lượng</th>
        <th>Ngày nhập</th>
        <th>Ngày hết hạn</th>
    </thead>
    <tbody>
        <?php foreach ($k as $key => $c): ?>
            
        <tr>
            <td><?php echo $c['ten_hh'] ?></td> 
            <td><?php echo intval($c['sl']) ?></td> 
            <td><?php echo $c['ngay_xuat'] ?></td>  
            <td><?php echo $c['hsd'] ?></td>    
        </tr>
        <?php endforeach ?>
    </tbody>
</table>
<?php 

    $body = ob_get_contents();
    ob_clean();
    echo $body;

    if(isset($_GET['gui_mail']))
        sendMail('Thông báo sản phẩm sắp hết hạn', $body , $k[0]['email'], $k[0]['email']);


?>


<?php endforeach ?>


<?php } ?>