<?php 
include 'config/ket-noi.php';

date_default_timezone_set("Asia/Ho_Chi_Minh");
?>
<!DOCTYPE>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Phần mềm quản lý bán hàng</title>
<!-- Bootstrap CSS -->
<link rel="stylesheet" href="public/assets/css/trang_in.css">
</head>
<body onload="window.print();">
<div id="page" class="page">
  <?php
 if (isset($_GET['ma_phieuthu'])) {
        $ma_phieuthu = $_GET['ma_phieuthu'];
        $phieuthu = mysqli_query($conn,"SELECT pt.ma_phieuthu,pt.noi_dung,pt.ngay_thu,pt.tien_thu,pt.ma_kh,kh.ten_kh,kh.mobile,kh.dia_chi FROM phieu_thu pt 
          left join khach_hang kh on kh.ma_kh = pt.ma_kh 
          where pt.ma_phieuthu ='$ma_phieuthu' limit 1");
        $hien = mysqli_fetch_assoc($phieuthu);
        $noi_dung = $hien['noi_dung'];
        $tien_thu = $hien['tien_thu'];
        $ngay_thu = $hien['ngay_thu'];
        $ten_kh = $hien['ten_kh'];
        $mobile = $hien['mobile'];
        $dia_chi = $hien['dia_chi'];
    }
// Hàm đổi số ra chữ
    function convert_number_to_words($number) {

$hyphen      = ' ';

$conjunction = '  ';

$separator   = ' ';

$negative    = 'âm ';

$decimal     = ' phẩy ';

$dictionary  = array(

0                   => 'Không',

1                   => 'Một',

2                   => 'Hai',

3                   => 'Ba',

4                   => 'Bốn',

5                   => 'Năm',

6                   => 'Sáu',

7                   => 'Bảy',

8                   => 'Tám',

9                   => 'Chín',

10                  => 'Mười',

11                  => 'Mười một',

12                  => 'Mười hai',

13                  => 'Mười ba',

14                  => 'Mười bốn',

15                  => 'Mười năm',

16                  => 'Mười sáu',

17                  => 'Mười bảy',

18                  => 'Mười tám',

19                  => 'Mười chín',

20                  => 'Hai mươi',

30                  => 'Ba mươi',

40                  => 'Bốn mươi',

50                  => 'Năm mươi',

60                  => 'Sáu mươi',

70                  => 'Bảy mươi',

80                  => 'Tám mươi',

90                  => 'Chín mươi',

100                 => 'trăm',

1000                => 'ngàn',

1000000             => 'triệu',

1000000000          => 'tỷ',

1000000000000       => 'nghìn tỷ',

1000000000000000    => 'ngàn triệu triệu',

1000000000000000000 => 'tỷ tỷ'

);

if (!is_numeric($number)) {

return false;

}


if (($number >= 0 && (int) $number < 0) || (int) $number < 0 - PHP_INT_MAX) {

// overflow

trigger_error(

'convert_number_to_words only accepts numbers between -' . PHP_INT_MAX . ' and ' . PHP_INT_MAX,

E_USER_WARNING

);

return false;

}


if ($number < 0) {

return $negative . convert_number_to_words(abs($number));

}

$string = $fraction = null;

if (strpos($number, '.') !== false) {

list($number, $fraction) = explode('.', $number);

}

switch (true) {

case $number < 21:

$string = $dictionary[$number];

break;

case $number < 100:

$tens   = ((int) ($number / 10)) * 10;

$units  = $number % 10;

$string = $dictionary[$tens];

if ($units) {

$string .= $hyphen . $dictionary[$units];

}

break;

case $number < 1000:

$hundreds  = $number / 100;

$remainder = $number % 100;

$string = $dictionary[$hundreds] . ' ' . $dictionary[100];

if ($remainder) {

$string .= $conjunction . convert_number_to_words($remainder);

}

break;

default:

$baseUnit = pow(1000, floor(log($number, 1000)));

$numBaseUnits = (int) ($number / $baseUnit);

$remainder = $number % $baseUnit;

$string = convert_number_to_words($numBaseUnits) . ' ' . $dictionary[$baseUnit];

if ($remainder) {

$string .= $remainder < 100 ? $conjunction : $separator;

$string .= convert_number_to_words($remainder);

}

break;

}

if (null !== $fraction && is_numeric($fraction)) {

$string .= $decimal;

$words = array();

foreach (str_split((string) $fraction) as $number) {

$words[] = $dictionary[$number];

}

$string .= implode(' ', $words);

}

return $string;

}
//Hết hàm đổi số ra chữ
$thongtin = mysqli_query($conn,"SELECT * FROM thongtin");
$sll = mysqli_fetch_assoc($thongtin);
?>
    
   <table border="0" class="TableData1">
    <tr>
      <td style="width:100%;text-align: center;">
        <b><?php echo $sll['tencuahang'] ?></b>
         <div style="font-size: 14px"><i><?php echo $sll['ttkhac'] ?></i></div>
        <hr>
        <h1>HÓA ĐƠN</h1>
        <p><i>Ngày xuất: <?php echo  date("d-m-Y", strtotime($ngayhoadon))?></i></p>
      </td>
      </tr>      
  </table>
  <hr>
   <br>
    <table class="TableData1">  
     
      <TR>
      <td  style="width:100%;text-align: center;">
        <div><h3>PHIẾU THU</h3></div>
<div>Ngày : <?php echo $ngay_thu; ?> </div>
      </td>
      
      </tr>
  </table>

  <br>
<p style="padding-bottom: 5px">Khách hàng: <?php echo $ten_kh ?></p>
<p style="padding-bottom: 5px">Điện thoại: <?php echo $mobile ?></p>
<p style="padding-bottom: 5px">Địa chỉ: <?php echo $dia_chi ?></p>
<p style="padding-bottom: 5px">Lý do: <?php echo $noi_dung ?></p>
<p style="padding-bottom: 5px">Số tiền: <b><?php echo number_format($tien_thu) ?> VNĐ</b></p>
<p style="padding-bottom: 5px">Viết bằng chữ: <i><?php echo convert_number_to_words($tien_thu) ?></i></p>

  
  
<table class="TableData1">
    <tr>
     <td  style="text-align: right;"><i> Ngày....tháng....năm........</i></span></td>
    </tr>
  </table>
<br>
  <table class="TableData1">
    <tr>
      <td style="width:20%;text-align: center;">
        <h5>Giám đốc</h5>
      </td>
      <td style="width:20%;text-align: center;">
        <h5>Kế toán trưởng</h5>
      </td>
      <td style="width:20%;text-align: center;">
        <h5>Người nộp tiền</h5>
      </td>
      <td style="width:20%;text-align: center;">
        <h5>Người lập phiếu</h5>
      </td>
      <td style="width:20%;text-align: center;">
        <h5>Thủ quỹ</h5>
      </td>
      </tr>
  </table>
  <br>
 <p style="padding-top: 115px"> Đã nhận đủ số tiền (Viết bằng chữ): <i><?php echo convert_number_to_words($tien_thu) ?></i>
</div>
</body>
</html>
