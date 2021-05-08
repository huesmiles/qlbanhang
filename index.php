<?php include 'dau-trang.php'; ?>

<?php

$date = getdate(); // Get date hệ thống
$ngay_hientai = date('Y-m-d'); // Set báo cáo theo ngày mặc đinh là hôm nay, theo format năm-tháng-ngày

// @TODO: Xem thống kê lợi nhuận theo năm
if (isset($_POST['namcanxem'])) {
  $namcanxem = $_POST['namcanxem'];
} else {
  $namcanxem = $date['year'];
}

// Nếu user đổi ngày view report, set giá trị mới vào $ngay_hientai để tìm kiếm lại
if (isset($_POST['ngay_report'])) {
  $ngay_hientai = $_POST['ngay_report'];
}
?>
<main>
  <!-- Báo cáo theo ngày -->
  <div class="container-fluid">
    <h1 class="mt-4">Báo cáo ngày</h1>
    <ol class="breadcrumb mb-4 d-flex justify-content-between align-items-center">
      <li class="breadcrumb-item active">Ngày: <?php echo $ngay_hientai; ?></li>

      <!-- Đổi ngày báo cáo -->
      <form action="" method="POST" id="ngay_report">
        <input type="date" value="<?php echo $ngay_hientai ?>" name="ngay_report">
      </form>
    </ol>

    <div class="row">
      <div class="col-xl-4 col-md-6">
        <div class="card bg-primary text-white mb-4">
          <div class="card-body">Tổng tiền bán hàng</div>
          <div class="card-footer d-flex align-items-center justify-content-between">
            <a class="small text-white stretched-link" href="#">
              <?php
              // Tính tổng tiền hàng = tổng hàng hoá (số lượng x đơn giá)
              // LEFT JOIN để lấy cả các phiếu xuất không có chi tiết phiếu xuất
              // $conn: db connection
              $bang_px = mysqli_query($conn, "SELECT px.ma_phieuxuat, px.ma_kh, px.ngay_xuat, px.ma_nv, sum(ctx1.sl * ctx1.don_gia) AS tong_mh
                FROM phieu_xuat px 
                LEFT JOIN chitiet_px ctx1 ON ctx1.ma_phieuxuat = px.ma_phieuxuat 
                WHERE px.phanloai ='Phiếu xuất' AND px.ngay_xuat = '$ngay_hientai'");
              $tienhang = mysqli_fetch_assoc($bang_px); // Call api thực hiện query
              echo number_format($tienhang['tong_mh']);
              ?>
            </a>
            <div class="small text-white"><i class="fas fa-angle-right"></i></div>
          </div>
        </div>
      </div>

      <div class="col-xl-4 col-md-6">
        <div class="card bg-success text-white mb-4">
          <div class="card-body">Số đơn đã thực hiện</div>
          <div class="card-footer d-flex align-items-center justify-content-between">
            <a class="small text-white stretched-link" href="#">
              <?php
              // Đếm số đơn hàng dùng COUNT()
              $bang_px_1 = mysqli_query($conn, "SELECT COUNT(ma_phieuxuat) AS sopx,ngay_xuat FROM phieu_xuat WHERE ngay_xuat = '$ngay_hientai' AND phanloai ='Phiếu xuất' ");
              $sodon = mysqli_fetch_assoc($bang_px_1);
              echo number_format($sodon['sopx']);
              ?>
            </a>
            <div class="small text-white"><i class="fas fa-angle-right"></i></div>
          </div>
        </div>
      </div>

      <div class="col-xl-4 col-md-6">
        <div class="card bg-warning text-white mb-4">
          <div class="card-body">Tổng tiền nhập hàng</div>
          <div class="card-footer d-flex align-items-center justify-content-between">
            <a class="small text-white stretched-link" href="#">
              <?php
              // tính tổng tiền hàng
              $bang_px43 = mysqli_query($conn, "SELECT px.ma_phieuxuat,px.ma_kh,px.ngay_xuat,px.ma_nv,sum(ctx1.sl*ctx1.don_gia) AS tong_mh1 FROM phieu_xuat px 
               LEFT JOIN chitiet_px ctx1 ON ctx1.ma_phieuxuat = px.ma_phieuxuat 
               WHERE px.ngay_xuat = '$ngay_hientai' AND px.phanloai ='Phiếu nhập' ");
              $tienhang43 = mysqli_fetch_assoc($bang_px43);
              echo number_format($tienhang43['tong_mh1']);
              ?>
            </a>
            <div class="small text-white"><i class="fas fa-angle-right"></i></div>
          </div>
        </div>
      </div>

      <!-- @TODO: Tổng chi -->
      <!-- <div class="col-xl-3 col-md-6">
        <div class="card bg-danger text-white mb-4">
          <div class="card-body">Tổng chi</div>
          <div class="card-footer d-flex align-items-center justify-content-between">
            <a class="small text-white stretched-link" href="#">
              <?php
              // $bangdsnv = mysqli_query($conn, "SELECT ma_phieuthu,ngay_thu,sum(tien_thu) as tongchi_ngay from phieu_thu where ngay_thu = '$ngay_hientai' and phanloaithuchi = 'Phiếu chi'");
              // $tongchi = mysqli_fetch_assoc($bangdsnv);
              // echo number_format($tongchi['tongchi_ngay']);
              ?>
            </a>
            <div class="small text-white"><i class="fas fa-angle-right"></i></div>
          </div>
        </div>
      </div> -->
    </div>

    <div class="row">
      <!-- @TODO: Báo cáo theo năm -->
      <div class="col-xl-12">
        <div class="card mb-4">
          <!-- <div class="card-header d-flex align-items-center justify-content-between">
            <span>
              <i class="fas fa-table mr-1"></i>
              Lợi nhuận theo tháng - năm <?php echo $namcanxem ?>
            </span>
            <?php if ($namcanxem != date("Y")) : ?>
              <button class="btn btn-sm btn-primary">Xem năm nay</button>
            <?php endif ?>
          </div> -->

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
              <!-- <hr> -->
              <!-- <table class="table table-bordered" width="100%" cellspacing="0">
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

                  // Tính lợi nhuận
                  <?php
                  $loi_nhuan = '';
                  $doanh_so = '';
                  for ($i = 1; $i <= 12; $i++) :
                    //Tính tổng tiền phiếu xuất (tổng số lượng x đơn giá x tiền km đơn hàng x 1%)
                    $tinhsumpx = mysqli_query($conn, "SELECT sum(ctx.sl*ctx.don_gia) as tongphieuxuat,sum(ctx.sl*ctx.don_gia*px.tien_km_don_hang*0.01) as tongkm FROM chitiet_px ctx 
                      left join phieu_xuat px on ctx.ma_phieuxuat = px.ma_phieuxuat 
                      where MONTH(px.ngay_xuat) = $i and YEAR(px.ngay_xuat) = '$namcanxem' and px.phanloai = 'Phiếu xuất' ");
                    $tongtienpx = mysqli_fetch_assoc($tinhsumpx);
                    $tongpx = $tongtienpx['tongphieuxuat'];
                    $tongkm111 = $tongtienpx['tongkm'];

                    //Tổng đơn giá vốn - 
                    $dongiavon = mysqli_query($conn, "SELECT h.ma_hh, sum(ctx.slx*(ctn.t_don_gia_nhap/ctn.sln)) as tongtienvon FROM hang_hoa h
                      LEFT JOIN (
                        SELECT ctpx.ma_hh,SUM(ctpx.sl) as 'slx' FROM chitiet_px ctpx
                        left join phieu_xuat px on ctpx.ma_phieuxuat = px.ma_phieuxuat 
                        WHERE px.phanloai = 'Phiếu xuất' and MONTH(px.ngay_xuat) = $i and YEAR(px.ngay_xuat) = '$namcanxem' 
                        GROUP BY ma_hh
                      ) ctx ON ctx.ma_hh = h.ma_hh
                      LEFT JOIN (
                        SELECT ctpn.ma_hh,SUM(ctpn.sl) as 'sln', sum(ctpn.don_gia*ctpn.sl) as t_don_gia_nhap FROM chitiet_px ctpn
                        left join phieu_xuat pn on ctpn.ma_phieuxuat = pn.ma_phieuxuat 
                        WHERE pn.phanloai = 'Phiếu nhập' and MONTH(pn.ngay_xuat) = $i and YEAR(pn.ngay_xuat) = '$namcanxem'
                        GROUP BY ma_hh
                      ) ctn ON ctn.ma_hh = h.ma_hh ");
                    $hine = mysqli_fetch_assoc($dongiavon);
                    $tien_nhap_trung_binh =  $hine['tongtienvon'];
                    // $tien_nhap_trung_binh = 0; 

                    $tinhloinhuan = $tongpx - $tien_nhap_trung_binh - $tongkm111;
                    // Từng phần tử cho mảng lợi nhuận
                    $loi_nhuan = $loi_nhuan . '"' . $tinhloinhuan . '",';
                    $doanh_so = $doanh_so . '"' . $tongpx . '",';
                  ?>
                    <tr>
                      <td style="text-align: center;"><?php echo $i ?></td>
                      <td style="text-align: right;"><?php echo number_format($tongpx) ?></td>
                      <td style="text-align: right;"><?php echo number_format($tien_nhap_trung_binh) ?></td>
                      <td style="text-align: right;"><?php echo number_format($tongkm111) ?></td>
                      <td style="text-align: right;"><?php echo number_format($tinhloinhuan) ?></td>
                    </tr>
                  <?php endfor; ?>

                </tbody>
              </table> -->
            </div>
          </div>
        </div>
      </div>
      <!-- Hết Báo cáo theo ngày -->


      <!-- Vẽ biểu đồ -->
      <?php
      // đổi $loi_nhuận thành mảng (Chart api yêu cầu data vào là 1 mảng)
      $loi_nhuan = trim($loi_nhuan . ',');
      $doanh_so1 = trim($tongpx . ',');
      // echo '<pre>'; print_r($loi_nhuan); echo '</pre>'
      ?>
      <div class="col-xl-6">
        <div class="card mb-4">
          <div class="card-header">
            <i class="fas fa-chart-bar mr-1"></i>
            Biểu đồ lợi nhuận bán hàng
          </div>
          <div class="card-body"><canvas id="myBarChart1" width="100%" height="40"></canvas></div>
        </div>
      </div>
      <div class="col-xl-6">
        <div class="card mb-4">
          <div class="card-header">
            <i class="fas fa-chart-bar mr-1"></i>
            Biểu đồ doanh số bán hàng
          </div>
          <div class="card-body"><canvas id="myBarChart2" width="100%" height="40"></canvas></div>
        </div>
      </div>
      <!-- Hết vẽ biểu đồ -->
    </div>
  </div>
</main>

<?php include 'chan-trang.php'; ?>

<script type="text/javascript">
  // Sử dụng Chart
  // Config chart font style
  Chart.defaults.global.defaultFontFamily = '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
  // Config char font color
  Chart.defaults.global.defaultFontColor = '#292b2c';

  // Biểu đồ lợi nhuận theo từng tháng trong năm
  var ctx = document.getElementById("myBarChart1");
  var profitLineChart = new Chart(ctx, {
    // Kiểu line chart
    type: 'bar',
    // Data: x- các tháng trong năm, y- lợi nhuận theo từng tháng
    data: {
      labels: ["T1", "T2", "T3", "T4", "T5", "T6", "T7", "T8", "T9", "T10", "T11", "T12"],
      datasets: [{
        label: "Tổng lợi nhuận:",
        backgroundColor: "rgba(2,117,216,1)",
        borderColor: "rgba(2,117,210,5)",
        data: [<?php echo $loi_nhuan; ?>],
      }],
    },
    options: {
      scales: {
        // Config trục x
        xAxes: [{
          time: {
            unit: 'month'
          },
          gridLines: {
            display: false
          },
          ticks: {
            maxTicksLimit: 12
          }
        }],
        // Config trục y
        yAxes: [{
          ticks: {
            min: 10,
            // max: 280000,
            maxTicksLimit: 5
          },
          gridLines: {
            display: true
          }
        }],
      },
      legend: {
        display: false
      }
    }
  });
</script>


<script type="text/javascript">
  // Biểu đồ doanh số
  Chart.defaults.global.defaultFontFamily = '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
  Chart.defaults.global.defaultFontColor = '#292b2c';

  var ctx = document.getElementById("myBarChart2");
  var incomeLineChart = new Chart(ctx, {
    type: 'bar',
    data: {
      labels: ["T1", "T2", "T3", "T4", "T5", "T6", "T7", "T8", "T9", "T10", "T11", "T12"],
      datasets: [{
        label: "Doanh số:",
        backgroundColor: "rgba(2,117,216,1)",
        borderColor: "rgba(2,117,216,1)",
        data: [<?php echo $doanh_so; ?>],

      }],
    },
    options: {
      scales: {
        xAxes: [{
          time: {
            unit: 'month'
          },
          gridLines: {
            display: false
          },
          ticks: {
            maxTicksLimit: 12
          }
        }],
        yAxes: [{
          ticks: {
            min: 10,
            // max: 280000,
            maxTicksLimit: 5
          },
          gridLines: {
            display: true
          }
        }],
      },
      legend: {
        display: false
      }
    }
  });

  // Xử lý người dùng thay đổi ngày report -> submit form để loại lại data mới theo ngày được chọn
  document.querySelector('input[name="ngay_report"]')
    .addEventListener('change', e => {
      document.querySelector('#ngay_report').submit()
    })
</script>