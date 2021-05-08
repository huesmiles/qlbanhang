<?php session_start(); ?>
<?php include 'config/ket-noi.php'; ?>
<?php 
$errors = [];
    if (isset($_POST['user'])) {
    $user = $_POST['user'];
    if ($user == '') {
        $errors['User'] = 'Vui lòng nhập User';
    }
    $pass = $_POST['pass'];
    if ($pass == '') {
        $errors['Password'] = 'Vui lòng nhập mật khẩu';
    }
    if (!$errors) {
        $sql = "SELECT * FROM nhan_vien WHERE ten_nv = '$user' AND cap_bac = ('quan_tri' OR 'nhan_vien')  LIMIT 1";
        $res = mysqli_query($conn,$sql);
        if (mysqli_num_rows($res) == 1) {
            $u = mysqli_fetch_assoc($res);
            $pass_cu = $u['mat_khau'];/// mật khẩu đã mã hóa

            if ($pass==$pass_cu) {
                $_SESSION['adminajchdbd'] = $u;
                header('location: index.php');
            }else{
                $errors['PasswordNotMatch'] = 'Mật khẩu không đúng, kiểm tra lại';
            }
        }else{
            $errors['EmailNotExiste'] = 'User không tồn tại';
        }
    }
    }  

 ?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Phần mềm bán hàng online 365</title>
        <link href="startbootstrap-sb-admin-gh-pages/dist/css/styles.css" rel="stylesheet" />
        <script src="startbootstrap-sb-admin-gh-pages/dist/js/all.min.js" crossorigin="anonymous"></script>
    </head>
    <body class="bg-dark">
        <div id="layoutAuthentication">
            <div id="layoutAuthentication_content">
                <main>
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-5">
                                <div class="card shadow-lg border-0 rounded-lg mt-5">
                                    <div class="card-header"><h3 class="text-center font-weight-light my-4">Đăng nhập</h3></div>
                                    <div class="card-body">
                                        <form  method="POST">
                                        	<?php if($errors) : ?>
												<div class="alert alert-danger">
													<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
													<?php foreach ($errors as $key => $er): ?>
														<li><?php echo $er; ?></li>
													<?php endforeach ?>
												</div>
											<?php endif; ?>	
                                            <div class="form-group">
                                                <label class="small mb-1" for="inputEmailAddress">User</label>
                                                <input class="form-control py-4" id="inputEmailAddress" type="text" name="user" placeholder="Nhập User đăng nhập" />
                                            </div>
                                            <div class="form-group">
                                                <label class="small mb-1" for="inputPassword">Mật khẩu</label>
                                                <input class="form-control py-4" id="inputPassword" type="password" name="pass" placeholder="Enter password" />
                                            </div>
											<div class="form-group d-flex align-items-center justify-content-between mt-4 mb-0">
												<button type="submit" class="btn btn-block btn-lg btn-success">Đăng nhập</button>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="card-footer text-center">
                                        <div class="small"><a href="tel:0868604846">Hỗ trợ : 0868 60 48 46</a></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
            <div id="layoutAuthentication_footer">
                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">Copyright &copy; <a href="https://phanmem.phucvu365.com">Website</a></div>
                            <div>
                                <a href="https://phanmem.phucvu365.com">Hướng dẫn sử dụng</a>
                                &middot;
                                <a href="https://phanmem.phucvu365.com">Về Chúng tôi</a>
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
        <script src="https://code.jquery.com/jquery-3.5.1.min.js" crossorigin="anonymous"></script>
        <script src="startbootstrap-sb-admin-gh-pages/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="startbootstrap-sb-admin-gh-pages/dist/js/scripts.js"></script>
    </body>
</html>
