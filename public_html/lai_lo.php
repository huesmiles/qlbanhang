<?php include 'dau-trang.php';
?>
<?php 
$date = getdate();

if (isset($_POST['namcanxem'])) {
	$namcanxem = $_POST['namcanxem'];
}else {
	$namcanxem = $date['year'];
}
?>
<br>
<main>
  <div class="container-fluid">
<div class="card mb-4">
      <div class="card-header">
        <i class="fas fa-table mr-1"></i>
        Lợi nhuận theo tháng
      </div>
      <div class="card-body">
        <div class="table-responsive">
          <form action="" method="POST">
            <div class="input-group">
                    <input class="form-control" type="text" name="namcanxem" placeholder="Nhập năm cần xem" aria-label="Search" aria-describedby="basic-addon2" />
                    <div class="input-group-append">
                        <button class="btn btn-primary" type="submit"><i class="fas fa-search"></i></button>
                    </div>
                </div>
          </form>
          <hr>
          <table class="table table-bordered" width="100%" cellspacing="0">
            <thead>
              <tr>
                <th>Tháng</th>
                <th>Tổng tiền xuất</th>
                <th>Tổng tiền vốn</th>
                <th>Tổng khuyến mại</th>
                <th>Lợi nhuận</th>
              </tr>
            </thead>
            <tbody>

              <?php 
              for($i = 1; $i <=12; $i++):
                //Tính tổng tiền phiếu xuất
                $tinhsumpx = mysqli_query($conn,"SELECT sum(ctx.sl*ctx.don_gia) as tongphieuxuat,sum(ctx.sl*ctx.don_gia*px.tien_km_don_hang*0.01) as tongkm FROM chitiet_px ctx 
                  left join phieu_xuat px on ctx.ma_phieuxuat = px.ma_phieuxuat 
                  where MONTH(px.ngay_xuat) = $i and  YEAR(px.ngay_xuat) = '$namcanxem' and px.phanloai = 'Phiếu xuất' ");
                $tongtienpx = mysqli_fetch_assoc($tinhsumpx);
                $tongpx = $tongtienpx['tongphieuxuat'];
                $tongkm111 = $tongtienpx['tongkm'];

                //Tổng đơn giá vốn - chưa xử lý được này - tham khảo cách tính bên tồn kho
                $dongiavon = mysqli_query($conn,"SELECT h.ma_hh, sum(ctx.slx*(ctn.t_don_gia_nhap/ctn.sln)) as tongtienvon FROM hang_hoa h
                  LEFT JOIN (
                    SELECT ctpx.ma_hh,SUM(ctpx.sl) as 'slx' FROM chitiet_px ctpx
                    left join phieu_xuat px on ctpx.ma_phieuxuat = px.ma_phieuxuat 
                    WHERE px.phanloai = 'Phiếu xuất' and MONTH(px.ngay_xuat) = $i and  YEAR(px.ngay_xuat) = '$namcanxem' 
                    GROUP BY ma_hh
                  ) ctx ON ctx.ma_hh = h.ma_hh
                  LEFT JOIN (
                    SELECT ctpn.ma_hh,SUM(ctpn.sl) as 'sln', sum(ctpn.don_gia*ctpn.sl) as t_don_gia_nhap FROM chitiet_px ctpn
                    left join phieu_xuat pn on ctpn.ma_phieuxuat = pn.ma_phieuxuat 
                    WHERE pn.phanloai = 'Phiếu nhập' and MONTH(pn.ngay_xuat) = $i and  YEAR(pn.ngay_xuat) = '$namcanxem'
                    GROUP BY ma_hh
                  ) ctn ON ctn.ma_hh = h.ma_hh ");
                $hine = mysqli_fetch_assoc($dongiavon);
                $tien_nhap_trung_binh =  $hine['tongtienvon'];                
// $tien_nhap_trung_binh = 0;           
                ?>
                <tr>
                  <td style="text-align: center;"><?php echo $i ?></td>
                  <td style="text-align: right;"><?php echo number_format($tongpx) ?></td>
                  <td style="text-align: right;"><?php echo number_format($tien_nhap_trung_binh) ?></td>
                  <td style="text-align: right;"><?php echo number_format($tongkm111) ?></td>
                  <td style="text-align: right;"><?php echo number_format($tongpx-$tien_nhap_trung_binh-$tongkm111) ?></td>
                </tr>
              <?php endfor; ?>  

            </tbody>
          </table>
        </div>
      </div>
    </div>

</div>
</main>
<?php include 'chan-trang.php' ?>


