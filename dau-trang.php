<?php 
ob_start();
session_start();
include 'config/ket-noi.php';
if (!isset($_SESSION['adminajchdbd'])) {
  header('location: dang-nhap.php');
}else{
  $ad = $_SESSION['adminajchdbd'];
}
date_default_timezone_set("Asia/Ho_Chi_Minh");
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Phần mềm quản lý bán hàng</title>
<!-- Bootstrap CSS -->
<link rel="stylesheet" href="public/assets/css/bootstrap.min.css">
<link rel="stylesheet" href="public/assets/css/font-awesome.css">
<link rel="stylesheet" href="public/assets/fontawesome-free-5.10.2-web/css/all.css">
<!-- Custom fonts for this template-->

    <!-- Google font -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

 <link href="startbootstrap-sb-admin-gh-pages/dist/css/styles.css" rel="stylesheet" />
        <link href="startbootstrap-sb-admin-gh-pages/dist/css/dataTables.bootstrap4.min.css" rel="stylesheet" crossorigin="anonymous" />
        <script src="startbootstrap-sb-admin-gh-pages/dist/js/all.min.js" crossorigin="anonymous"></script>
</head>
<body style="font-size: 14px;"  ng-app="app" ng-controller="AppCctrl"  class="sb-nav-fixed">
   <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <a class="navbar-brand" href="index.php">Home</a>
            <button class="btn btn-link btn-sm order-1 order-lg-0" id="sidebarToggle" href="#"><i class="fas fa-bars"></i></button>
            <!-- Navbar Search-->
            <!-- <form class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0">
                <div class="input-group">
                    <input class="form-control" type="text" placeholder="Tìm kiếm..." aria-label="Search" aria-describedby="basic-addon2" />
                    <div class="input-group-append">
                        <button class="btn btn-primary" type="button"><i class="fas fa-search"></i></button>
                    </div>
                </div>
            </form> -->
            <!-- Navbar-->
            <!-- <ul class="navbar-nav ml-auto ml-md-0">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="userDropdown" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                        <a class="dropdown-item" href="#">Settings</a>
                        <a class="dropdown-item" href="#">Activity Log</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="login.html">Logout</a>
                    </div>
                </li>
            </ul> -->
        </nav>
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                            <div class="sb-sidenav-menu-heading">Core</div>
                            <a class="nav-link" href="index.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Trang chủ
                            </a>
                            <div class="sb-sidenav-menu-heading">Nhập - Xuất</div>
                           
                            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages" aria-expanded="false" aria-controls="collapsePages">
                                <div class="sb-nav-link-icon"><i class="fas fa-book-open"></i></div>
                                Phiếu Xuất
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapsePages" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="phieu_xuat.php">Lập phiếu</a>
                                    <a class="nav-link" href="bao_cao_xuat_hang.php">Chi tiết xuất</a>
                                    <a class="nav-link" href="bao_cao_mat_hang_ban.php">Số lượng xuất</a>
                                    <a class="nav-link" href="hang_hoa_da_xuat.php">Hàng đã xuất</a>
                                </nav>
                            </div>
                            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages54" aria-expanded="false" aria-controls="collapsePages54">
                                <div class="sb-nav-link-icon"><i class="fas fa-book-open"></i></div>
                                Phiếu Nhập
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapsePages54" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="phieu_nhap.php">Lập phiếu</a>
                                    <a class="nav-link" href="bao_cao_nhap_hang.php">Chi tiết</a>
                                    <a class="nav-link" href="bao_cao_mat_hang_nhap.php">Số lượng</a>
                                    <a class="nav-link" href="hang_hoa_da_nhap.php">Hàng đã nhập</a>
                                </nav>
                            </div>
                           
                            <div class="sb-sidenav-menu-heading">Thu - Chi</div>
                            <a class="nav-link" href="phieu_thu.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                                Phiếu thu
                            </a>
                            <a class="nav-link" href="phieu_chi.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                                Phiếu chi
                            </a>
                             <!-- <div class="sb-sidenav-menu-heading">Báo cáo</div> -->
                            <!-- <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseLayouts1" aria-expanded="false" aria-controls="collapseLayouts1">
                                <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                                Thu - Chi
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a> -->
                            <!-- <div class="collapse" id="collapseLayouts1" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="bao_cao_thu.php">Báo cáo thu</a>
                                    <a class="nav-link" href="bao_cao_chi.php">Báo cáo chi</a>

                                </nav>
                            </div> -->
                            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseLayouts2" aria-expanded="false" aria-controls="collapseLayouts2">
                                <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                                Tổng hợp
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapseLayouts2" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="ton_kho.php">Tồn kho</a>
                                    <?php if ($ad['cap_bac'] == 'quan_tri') : ?>
                                     <a class="nav-link" href="lai_lo.php">Lợi nhuận</a>
                                    <!-- <?php endif ?>
                                   
                                    <a class="nav-link" href="danh_sach_kh.php">Công nợ</a> -->

                                </nav>
                            </div>
                            
                             <div class="sb-sidenav-menu-heading">Cập nhật</div>
                            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseLayouts3" aria-expanded="false" aria-controls="collapseLayouts3">
                                <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                                Số liệu ban đầu
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapseLayouts3" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="khach_hang.php">Khách hàng</a>
                                    <a class="nav-link" href="nhacungcap.php">Nhà cung cấp</a>
                                    <a class="nav-link" href="hang_hoa.php">Sản phẩm</a>
                                    <?php if ($ad['cap_bac'] == 'quan_tri') : ?>
                                    <a class="nav-link" href="nhan_vien.php">Nhân viên</a>
                                    <?php endif ?>
                                </nav>
                            </div>
                            
                            <div class="sb-sidenav-menu-heading">Marketing</div>
                            <a class="nav-link" href="gui_thu_kh.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                                Email Marketing
                            </a>
                        </div>
                    </div>
                    <div class="sb-sidenav-footer">
                        <a href="thoet.php" class="btn btn-sm btn-success btn-block">Đăng xuất</a>
                    </div>
                </nav>
            </div>
            
            <div id="layoutSidenav_content">
                
 