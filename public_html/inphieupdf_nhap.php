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
 if (isset($_GET['ma_phieunhap'])) {
        $ma_phieunhap = $_GET['ma_phieunhap'];
        $bang_kh = mysqli_query($conn,"SELECT * FROM nha_cc");
        // Hiện bảng chi tiết xuất
        $bang_ctn2 = mysqli_query($conn,"SELECT ctn.ma_phieunhap,ctn.ma_hh,ctn.sl,ctn.don_gia,hh.ten_hh as tenhh,hh.dvt FROM chitiet_pn ctn 
            join hang_hoa hh on hh.ma_hh = ctn.ma_hh 
            where ctn.ma_phieunhap =  '$ma_phieunhap'");
        // Lấy các trường khách hàng và số tiền trên phiếu xuất
        $bang_pn = mysqli_query($conn,"SELECT pn.ma_phieunhap,pn.ngay_nhap,pn.ma_ncc,pn.ma_nv,nv.ten_nv,ncc.ten_ncc,ncc.mobile,ncc.dia_chi FROM phieu_nhap pn 
            join nhan_vien nv on nv.ma_nv = pn.ma_nv
            join nha_cc ncc on ncc.ma_ncc = pn.ma_ncc
            where pn.ma_phieunhap = '$ma_phieunhap'");
        $hien = mysqli_fetch_assoc($bang_pn);
        $ngayhoadon =$hien['ngay_nhap'];
        $date=date_create("$ngayhoadon");
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
    
  <table class="TableData1">
    <tr>
      <td style="width:100%;">
        <h5>CÔNG TY CỔ PHẦN PHƯỢNG HOÀNG</h5>
        
      </td>
      </tr>
      <TR>
      <td  style="width:100%;text-align: center;">
        <!-- <div><h2><?php echo $sll['tencuahang'] ?></h2></div>
        <div style="font-size: 14pn"><i><?php echo $sll['ttkhac'] ?></i></div> -->
        <div><h3>PHIẾU XUẤT KHO BÁN HÀNG</h3></div>
<div>Ngày xuất: <?php echo date_format($date,"d/m/Y"); ?> </div>
      </td>
      
      </tr>
  </table>

  <br>

<table class="TableData">
    
    <tr>
        <td style="text-align: left;"><b>Nhà cung cấp: <?php echo $hien['ten_ncc'] ?></b></td>
        <td style="text-align: right;"><b>Điện thoại: <?php echo $hien['mobile'] ?></b> </td>
    </tr>
    <tr>
       <td colspan="2" style="text-align: left;"><B>Địa chỉ: <?php echo $hien['dia_chi'] ?></B></td>
    </tr>
  </table>
  
  <br>

  <table class="TableData">
    <tr>
      <th>STT</th>
      <th>Tên hàng</th>
      <th>ĐVT</th>
      <th>SL</th>
      <th>Đơn giá</th>

      <th>Thành tiền</th>
    </tr>
    
      <?php 
         $tongsotien=0;
      foreach ($bang_ctn2 as $key => $value) : 
         $tongsotien += ($value['don_gia'])*$value['sl'];
      ?><tr>
        <td style="text-align: center;width: 10%"><?php echo $key+1 ?></td>
        <td style="text-align: left;width: 35%"><?php echo $value['tenhh'] ?></td>
        <td style="text-align: center;width: 10%"><?php echo $value['dvt'] ?></td>
        <td style="text-align: center;width: 10%"><?php echo $value['sl'] ?></td>
        <td style="text-align: right;width: 10%"><?php echo number_format($value['don_gia']) ?></td>

        <td  style="text-align: right;width: 15%"><?php echo number_format(($value['don_gia'])*$value['sl']) ?></td>
        </tr>
      <?php endforeach; ?>
      
      <tr>
      <td colspan="5" style="text-align: right;"><B>Tổng tiền hàng </B></td>
      <td style="text-align: right;"><?php echo number_format(($tongsotien),0,",",".")?></td>
    </tr>
  </table>
  <p style="text-align: right;"><i>Bằng chữ:<?php echo convert_number_to_words($tongsotien); ?> </i></p>
<!--   <div class="footer-left">Người nhận hàng</div>
  <div class="footer-right">Người giao hàng</div> -->
</div>
</body>
</html>
