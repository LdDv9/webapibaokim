<!DOCTYPE html>
<?php session_start(); ?>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Trang Quản Lý Dành Cho Admin</title>
        <link rel="shortcut icon" href="IMG/favicon.ico" type="image/x-icon">
        <link rel="icon" href="IMG/favicon.ico" type="image/x-icon">
        <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
        <script src="js/jquery-3.2.1.min.js"></script>

        <!-- Bootstrap CSS -->
        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
                            <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.2/html5shiv.min.js"></script>
                            <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
                    <![endif]-->
    </head>

    <?php
     $conn = mysqli_connect('mysql.hostinger.vn', 'u238198959_game1', 'Ld01664153347', 'u238198959_game');

    $_SESSION['taikhoan'] = isset($_POST['taikhoan']) ? $_POST['taikhoan'] : '';
    $_SESSION['matkhau'] = isset($_POST['matkhau']) ? $_POST['matkhau'] : '';

    $dangnhap = false;
    if (isset($_POST['submit'])) {
        if ($_SESSION['taikhoan'] == 'adquangtruc' && $_SESSION['matkhau'] == 'quangtruc') {
            echo ' <script> alert("Đăng Nhập Thành Công") </script>';

            $select = "select * from accgame where daban = 1";
            $query = mysqli_query($conn, $select);
            $dangnhap = true;
        } else {
            echo ' <script> alert("Đăng Nhập Thất Bại Tài Khoản Mật Khẩu Không Chính Xác")</script>';
        }
    }
    ?>
    <body>
        <h1 class="text-center">Trang Quản Lý</h1>
        <div class="container">
            <div class="row" id="formdangnhap">
                <form action="" method="post" accept-charset="utf-8" >
                    <div class="col-md-6 col-md-push-3">
                        <div class="col-md-4" style=" text-align: center; ">
                            <span class="form-control " style="margin: 20px;"> Tài Khoản</span>
                            <span class="form-control" style="margin: 20px;"> Mật Khẩu</span>
                        </div>
                        <div class="col-md-8">
                            <input type="text" name="taikhoan" value="" placeholder="" class="form-control" style="margin: 20px;">
                            <input type="password" name="matkhau" value="" placeholder="" class="form-control" style="margin: 20px;">
                        </div>
                        <button type="submit" name="submit" id="submit" class="btn btn-primary  form-inline col-md-2 col-md-push-5"> Đăng Nhập</button>
                    </div>
                </form>
            </div>
            <div class="row" >      
                <div class="col-md-6"  id="danhsach"  style="display: none" >
                    <h3>Danh Sách Tài Khoản Chưa Bán</h3>
                    <div style="border:1px solid #000000; border-radius: 10px; ">
                        <table style="text-align: left; "> <thead>
                                <tr >
                                    <th style="padding:   10px;">ID</th>
                                    <th style="padding:   10px;">Tên Tài Khoản</th>
                                    <th style="padding:   10px;">Mật Khẩu</th>
                                </tr>
                            </thead> 
                        </table>


                        <div style="overflow: auto; height: 280px; ">
                            <table style="text-align: left; ">  <thead>
                                    <tr >
                                        <th ></th>
                                        <th ></th>
                                        <th ></th>
                                    </tr>
                                </thead>          
                                <tbody>
                                    <?php
                                    if ($dangnhap == true) {
                                        echo ' <script> $("#formdangnhap").css("display","none");</script>';
                                        echo ' <script> $("#danhsach").css("display","block");</script>';

                                        while ($rows = mysqli_fetch_array($query)) {
                                            ?>
                                            <tr>
                                                <td style="padding:   10px;"><?php echo $rows['id']; ?> </td>
                                                <td style="padding:   10px;"><?php echo $rows['taikhoan']; ?> </td>
                                                <td style="padding:   10px;"> <?php echo $rows['matkhau']; ?> </td>
                                            </tr>
                                            <?php
                                        }
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>


                    </div>
                </div>
                <div class="col-md-6" id="quanlytaikhoan" style="display: none" >
                    <?php
                    if ($dangnhap == true) {
                        echo ' <script> document.getElementById("quanlytaikhoan").style.display = "block";</script>';
                    }
                    ?>
                    <form action="" method="post" accept-charset="utf-8" >
                        <h3>Quản Lý Tài Khoản tài Khoản</h3>
                        <span class="form-control"> ID Game</span>
                        <input type="text" name="idquanly" value="" placeholder="ID chỉ sử dụng cho Xóa Và Sửa" class="form-control" style="margin: 20px 0 20px 0;">
                        <span class="form-control">Tài Khoản Game</span>
                        <input type="text" name="taikhoanquanly" value="" placeholder="Tài Khoản Chỉ Sử Dụng Cho Thêm Và Sửa" class="form-control" style="margin: 20px 0 20px 0;">
                        <span class="form-control">Mật Khẩu Game</span>
                        <input type="text" name="matkhauquanly" value="" placeholder="Mật Khẩu Chỉ Sử Dụng Cho Thêm VÀ Sửa" class="form-control" style="margin: 20px 0 20px 0;">
                        <button type="submit" name="them" class="col-md-3 btn-success btn "> Thêm </button>
                        <button type="submit" name="xoa" class="col-md-3 btn-danger btn col-md-push-1"> Xóa</button>
                        <button type="submit" name="sua" class="col-md-3 btn-warning btn col-md-push-2"> Sửa</button>
                    </form>
                </div>
            </div>

            <div class="col-md-12" id="doingay"  >
                <?php
                if ($dangnhap == true) {
                    echo '  <script>$("#doingay").css("display","block")</script>';
                } else {
                    echo '  <script>$("#doingay").css("display","none")</script>';
                }
                ?>
                <h3>
                    Sửa Ngày Thông Báo Khi Hết Acc Game :
                </h3>
                <form method="post">
                    <input type="text" name="ngaythaydoi" class="form-control">
                    <button type="submit" name="thaydoi" class="btn btn-success  col-md-12" style="margin: 20px 0 20px 0;"> Sửa</button>
                </form>
            </div>

        </div>
        <!-- jQuery -->
        <!-- Bootstrap JavaScript -->
        <script src="js/bootstrap.js"></script>
        <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    </body>
    <?php
// Thêm tài khoản

    if (isset($_POST['them'])) {
        $taikhoangame = isset($_POST['taikhoanquanly']) ? $_POST['taikhoanquanly'] : '';
        $matkhaugame = isset($_POST['matkhauquanly']) ? $_POST['matkhauquanly'] : '';
        echo ' <script> $("#formdangnhap").css("display","none");</script>';
        echo ' <script> $("#quanlytaikhoan").css("display","block");</script>';
        //$conn = mysqli_connect('mysql.hostinger.vn', 'u238198959_game', 'Ld01664153347', 'u238198959_game');
        if ($conn) {
            if ($taikhoangame != '' && $matkhaugame != '') {
                $insert = "insert into accgame(taikhoan,matkhau,daban) values('$taikhoangame','$matkhaugame',1) ";
                $add = mysqli_query($conn, $insert);
                if ($add == true) {
                    echo'<h2 class="col-md-9 col-md-push-3" >   Thêm Thành Công</h2>';
                    $select = "select * from accgame where daban = 1";
                    $query = mysqli_query($conn, $select);
                    ?>
                    <div class="col-md-6 col-md-push-6 " style="position: relative; top: -450px; height: 280px"  >
                        <h3>Danh Sách Tài Khoản Sau Khi Thêm</h3>
                        <div style="border:1px solid #000000;  border-bottom: 0px; ">
                            <table style="text-align: left; "> <thead>
                                    <tr >
                                        <th style="padding:   10px;">ID</th>
                                        <th style="padding:   10px;">Tên Tài Khoản</th>
                                        <th style="padding:   10px;">Mật Khẩu</th>
                                    </tr>
                                </thead> 
                            </table> 
                        </div>

                        <div style="overflow: auto;  height: 280px; border: 1px solid #000000; border-top: 0;  ">
                            <table style="text-align: left; "> 
                                <thead>
                                    <tr >
                                        <th ></th>
                                        <th ></th>
                                        <th ></th>
                                    </tr>
                                </thead>          
                                <tbody>   <?php
                                    while ($rowss = mysqli_fetch_array($query)) {
                                        $id = $rowss['id'];
                                        $taikhoan = $rowss['taikhoan'];
                                        $matkhau = $rowss['matkhau'];
                                        ?>                      
                                        <tr>

                                            <td style="padding:   10px;"> <?php echo $id; ?></td>
                                            <td style="padding:   10px;"><?php echo $taikhoan; ?></td>
                                            <td style="padding:   10px;"><?php echo $matkhau; ?> </td>

                                        </tr><?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <?php
                    return true;
                } else {
                    echo'<h2> Thêm Thất Bại</h2>';
                    return false;
                }
            } else {
                echo ' <h2>Thêm Thất Bại Nhập Tài Khoản Và Mật Khẩu Cần Thêm<h2>';
                return false;
            }
        } else {
            echo '<h2> Kết Nối Database Thất Bại </h2>';
        }
    }
    //Xóa tài Khoản 
    if (isset($_POST['xoa'])) {
        $id = isset($_POST['idquanly']) ? $_POST['idquanly'] : '';
        echo ' <script> $("#formdangnhap").css("display","none");</script>';
        echo ' <script> $("#quanlytaikhoan").css("display","block");</script>';
         //echo '<script> $("#doingay").css("display","block")<script>';
        
        if ($conn) {
            if ($id != '') {
                $delete = "delete from accgame where id= $id ";
                $add = mysqli_query($conn, $delete);
                if ($add == true) {
                    echo'<h2 class="col-md-9 col-md-push-2" >   Xóa Thành Công Tài Khoản CÓ ID = ' . $id . ' Vui Lòng Kiểm Tra Lại Danh Sách </h2>';
                    $select = "select * from accgame where daban = 1";
                    $query = mysqli_query($conn, $select);
                    ?>
                    <div class="col-md-6 col-md-push-6 " style="position: relative; top: -450px; height: 280px"  >
                        <h3>Danh Sách Tài Khoản Sau Khi Xóa</h3>
                        <div style="border:1px solid #000000;  border-bottom: 0px; ">
                            <table style="text-align: left; "> <thead>
                                    <tr >
                                        <th style="padding:   10px;">ID</th>
                                        <th style="padding:   10px;">Tên Tài Khoản</th>
                                        <th style="padding:   10px;">Mật Khẩu</th>
                                    </tr>
                                </thead> 
                            </table> 
                        </div>

                        <div style="overflow: auto;  height: 280px; border: 1px solid #000000; border-top: 0;  ">
                            <table style="text-align: left; "> 
                                <thead>
                                    <tr >
                                        <th ></th>
                                        <th ></th>
                                        <th ></th>
                                    </tr>
                                </thead>          
                                <tbody>   <?php
                                    while ($rowss = mysqli_fetch_array($query)) {
                                        $id = $rowss['id'];
                                        $taikhoan = $rowss['taikhoan'];
                                        $matkhau = $rowss['matkhau'];
                                        ?>                      
                                        <tr>

                                            <td style="padding:   10px;"> <?php echo $id; ?></td>
                                            <td style="padding:   10px;"><?php echo $taikhoan; ?></td>
                                            <td style="padding:   10px;"><?php echo $matkhau; ?> </td>

                                        </tr><?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <?php
                    return true;
                } else {
                    echo'<h2> Xóa Thất Bại Thất Bại</h2>';


                    return false;
                }
            } else {

                $select = "select * from accgame where daban = 1";
                $query = mysqli_query($conn, $select);
                ?>

                <div class="col-md-6 col-md-push-6 " style="position: relative; top: -420px; height: 280px"  >
                    <h3>Xem ID Tại Danh Sách tài Khoản</h3>
                    <div style="border:1px solid #000000;  border-bottom: 0px; ">
                        <table style="text-align: left; "> <thead>
                                <tr >
                                    <th style="padding:   10px;">ID</th>
                                    <th style="padding:   10px;">Tên Tài Khoản</th>
                                    <th style="padding:   10px;">Mật Khẩu</th>
                                </tr>
                            </thead> 
                        </table> 
                    </div>

                    <div style="overflow: auto;  height: 280px; border: 1px solid #000000; border-top: 0;  ">
                        <table style="text-align: left; "> 
                            <thead>
                                <tr >
                                    <th ></th>
                                    <th ></th>
                                    <th ></th>
                                </tr>
                            </thead>          
                            <tbody>   <?php
                                while ($rowss = mysqli_fetch_array($query)) {
                                    $id = $rowss['id'];
                                    $taikhoan = $rowss['taikhoan'];
                                    $matkhau = $rowss['matkhau'];
                                    ?>                      
                                    <tr>

                                        <td style="padding:   10px;"> <?php echo $id; ?></td>
                                        <td style="padding:   10px;"><?php echo $taikhoan; ?></td>
                                        <td style="padding:   10px;"><?php echo $matkhau; ?> </td>

                                    </tr><?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>

                <?php
                echo ' <h2>Xóa Thất Bại Vui Lòng Nhập ID<h2>';
                return false;
            }
        } else {
            echo '<h2> Kết Nối Database Thất Bại </h2>';
        }
    }
    // Sửa Tài Khoản
    if (isset($_POST['sua'])) {
        
        $id = isset($_POST['idquanly']) ? $_POST['idquanly'] : '';
        echo ' <script> $("#formdangnhap").css("display","none");</script>';
        echo ' <script> $("#quanlytaikhoan").css("display","block");</script>';
        // $conn = mysqli_connect('mysql.hostinger.vn', 'u238198959_game', 'Ld01664153347', 'u238198959_game');
       
        if ($conn) {

            $taikhoangame = isset($_POST['taikhoanquanly']) ? $_POST['taikhoanquanly'] : '';
            $matkhaugame = isset($_POST['matkhauquanly']) ? $_POST['matkhauquanly'] : '';
            if ($taikhoangame != '' && $matkhaugame != '' && $id != '') {
                $update = "update accgame set taikhoan = '$taikhoangame',matkhau = '$matkhaugame' where id= $id";
                $add = mysqli_query($conn, $update);
                if ($add == true) {
                    echo'<h2 class="col-md-9 col-md-push-3" >Sửa Thành Công Tài Khoản ID = ' . $id . ' Tên Tài Khoản = ' . $taikhoangame . ' Mật Khẩu = ' . $matkhaugame . '</h2>';
                    $select = "select * from accgame where daban = 1";
                    $query = mysqli_query($conn, $select);
                    ?>
                    <div class="col-md-6 col-md-push-6 " style="position: relative; top: -450px; height: 280px"  >
                        <h3>Danh Sách Tài Khoản Sau Khi Sửa</h3>
                        <div style="border:1px solid #000000;  border-bottom: 0px; ">
                            <table style="text-align: left; "> <thead>
                                    <tr >
                                        <th style="padding:   10px;">ID</th>
                                        <th style="padding:   10px;">Tên Tài Khoản</th>
                                        <th style="padding:   10px;">Mật Khẩu</th>
                                    </tr>
                                </thead> 
                            </table> 
                        </div>

                        <div style="overflow: auto;  height: 280px; border: 1px solid #000000; border-top: 0;  ">
                            <table style="text-align: left; "> 
                                <thead>
                                    <tr >
                                        <th ></th>
                                        <th ></th>
                                        <th ></th>
                                    </tr>
                                </thead>          
                                <tbody>   <?php
                                    while ($rowss = mysqli_fetch_array($query)) {
                                        $id = $rowss['id'];
                                        $taikhoan = $rowss['taikhoan'];
                                        $matkhau = $rowss['matkhau'];
                                        ?>                      
                                        <tr>

                                            <td style="padding:   10px;"> <?php echo $id; ?></td>
                                            <td style="padding:   10px;"><?php echo $taikhoan; ?></td>
                                            <td style="padding:   10px;"><?php echo $matkhau; ?> </td>

                                        </tr><?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <?php
                    return true;
                } else {
                    echo'<h2> Sửa Thất Bại</h2>';

                    return false;
                }
            } else {

                $select = "select * from accgame where daban = 1";
                $query = mysqli_query($conn, $select);
                ?>

                <div class="col-md-6 col-md-push-6 " style="position: relative; top: -420px; height: 280px"  >
                    <h3>Xem Lại Tại Danh Sách Tài Khoản</h3>
                    <div style="border:1px solid #000000;  border-bottom: 0px; ">
                        <table style="text-align: left; "> <thead>
                                <tr >
                                    <th style="padding:   10px;">ID</th>
                                    <th style="padding:   10px;">Tên Tài Khoản</th>
                                    <th style="padding:   10px;">Mật Khẩu</th>
                                </tr>
                            </thead> 
                        </table> 
                    </div>

                    <div style="overflow: auto;  height: 280px; border: 1px solid #000000; border-top: 0;  ">
                        <table style="text-align: left; "> 
                            <thead>
                                <tr >
                                    <th ></th>
                                    <th ></th>
                                    <th ></th>
                                </tr>
                            </thead>          
                            <tbody>   <?php
                                while ($rowss = mysqli_fetch_array($query)) {
                                    $id = $rowss['id'];
                                    $taikhoan = $rowss['taikhoan'];
                                    $matkhau = $rowss['matkhau'];
                                    ?>                      
                                    <tr>

                                        <td style="padding:   10px;"> <?php echo $id; ?></td>
                                        <td style="padding:   10px;"><?php echo $taikhoan; ?></td>
                                        <td style="padding:   10px;"><?php echo $matkhau; ?> </td>

                                    </tr><?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>


                <?php
                echo ' <h2>Sửa Thất Bại Cần Nhập Đủ ID Tài Khoản Mật Khẩu<h2>';
                return false;
            }
        } else {
            echo '<h2> Kết Nối Database Thất Bại </h2>';
        }
    }
    // sửa Ngày Thay Đổi
    if (isset($_POST['thaydoi'])) {
        $ngayquaylai = isset($_POST['ngaythaydoi']) ? $_POST['ngaythaydoi'] : '';
        $doingay = "update hienthi set ngayquaylai = '$ngayquaylai' ";
        if ($ngayquaylai != null) {
            $thaydoi = mysqli_query($conn, $doingay);
            if ($thaydoi) {
                echo "  <h2 class=" . "text-center" . "> Đã Thay Đôi Ngày Hẹn Khách Hàng Quay Lại Thành Ngày $ngayquaylai</h2>";
                echo '<script> $("#danhsach").css("display","block"); $("#quanlytaikhoan").css("display","block"); $("#doingay").css("display","block");$("#formdangnhap").css("display","none");</script>';
            } else{
                echo 'fail';
            }
        } else {
            echo"<h2 class=" . "textcenter" . "> Chưa Nhập Ngày Quay Lại </h2>";
           echo '<script>  $("#danhsach").css("display","block"); $("#quanlytaikhoan").css("display","block"); $("#doingay").css("display","block";  )</script>';             
          
        }
    }
    ?>


</html>