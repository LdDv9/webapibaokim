
<?php

header('Content-Type: text/html; charset=utf-8');
define('CORE_API_HTTP_USR', 'merchant_19002');
define('CORE_API_HTTP_PWD', '19002mQ2L8ifR11axUuCN9PMqJrlAHFS04o');

$bk = 'https://www.baokim.vn/the-cao/restFul/send';
$seri = isset($_POST['txtseri']) ? $_POST['txtseri'] : '';
$sopin = isset($_POST['txtpin']) ? $_POST['txtpin'] : '';
//Loai the cao (VINA, MOBI, VIETEL, VTC, GATE)
$mang = isset($_POST['chonmang']) ? $_POST['chonmang'] : '';



if ($mang == 'MOBI') {
    $ten = "Mobifone";
} else if ($mang == 'VIETEL') {
    $ten = "Viettel";
} else if ($mang == 'GATE') {
    $ten = "Gate";
} else if ($mang == 'VTC') {
    $ten = "VTC";
} else {
    $ten = "Vinaphone";
}
//Mã MerchantID dang kí trên Bảo Kim
$merchant_id = '30227';
//Api username 
$api_username = 'vitzccom';
//Api Pwd d
$api_password = 'nHsQWxoZEMQ7gpYw6itB';
//Mã TransactionId 
$transaction_id = time();
//mat khau di kem ma website dang kí trên B?o Kim
$secure_code = 'c9df5c3f134d8d7f';

$arrayPost = array(
    'merchant_id' => $merchant_id,
    'api_username' => $api_username,
    'api_password' => $api_password,
    'transaction_id' => $transaction_id,
    'card_id' => $mang,
    'pin_field' => $sopin,
    'seri_field' => $seri,
    'algo_mode' => 'hmac'
);

ksort($arrayPost);

$data_sign = hash_hmac('SHA1', implode('', $arrayPost), $secure_code);

$arrayPost['data_sign'] = $data_sign;

$curl = curl_init($bk);

curl_setopt_array($curl, array(
    CURLOPT_POST => true,
    CURLOPT_HEADER => false,
    CURLINFO_HEADER_OUT => true,
    CURLOPT_TIMEOUT => 30,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_SSL_VERIFYPEER => false,
    CURLOPT_HTTPAUTH => CURLAUTH_DIGEST | CURLAUTH_BASIC,
    CURLOPT_USERPWD => CORE_API_HTTP_USR . ':' . CORE_API_HTTP_PWD,
    CURLOPT_POSTFIELDS => http_build_query($arrayPost)
));

$data = curl_exec($curl);

$status = curl_getinfo($curl, CURLINFO_HTTP_CODE);

$result = json_decode($data, true);
date_default_timezone_set('Asia/Ho_Chi_Minh');
$time = time();
//$time = time();
if ($status == 200) {
    $amount = $result['amount'];
    switch ($amount) {
        case 10000:
            $xu = 10000;
            break;
        case 20000:
            $xu = 20000;
            break;
        case 30000:
            $xu = 30000;
            break;
        case 50000:
            $xu = 50000;
            break;
        case 100000:
            $xu = 100000;
            break;
        case 200000:
            $xu = 200000;
            break;
        case 300000:
            $xu = 300000;
            break;
        case 500000:
            $xu = 500000;
            break;
        case 1000000:
            $xu = 1000000;
            break;
    }
    $sotien = $amount;
    //$dbhost="localhost";
    //$dbuser ="xemtruoc_ngaydep";
    //$dbpass = "BL&v7Wd#hj07";
    //$dbname = "xemtruoc_tuonglai";
    //$db = mysql_connect($dbhost,$dbuser,$dbpass) or die("cant connect db");
    //mysql_select_db($dbname,$db) or die("cant select db");
    $conn = mysqli_connect('mysql.hostinger.vn', 'u238198959_game1', 'Ld01664153347', 'u238198959_game');
    mysqli_set_charset($conn, 'utf8');


    if (isset($_POST['napthe'])) {
        if ($conn) {
            echo '<script>alert("ket noi database thanh cong");	
	</script>';

            if ($sotien == 10000) {
                echo 'Bạn đã nạp  ' . $sotien . ' vnđ <br>';
                $select = "select * from accgame where daban =1 limit 1";
                $query = mysqli_query($conn, $select);
                if ($query) {

                    $sotk = mysqli_num_rows($query);
                    echo 'Số tài khoản bạn nhận được là :' . $sotk . '<br>';
                    echo ' Đây là danh sách tài khoản của bạn : <br>';
                    echo '<table style="text-align:left; ">
                                    <thead>
                                        <tr>
                                            <th>Id</th>
                                            <th>Tên Tài Khoản   </th>
                                            <th> Mật Khẩu</th>
                                            
                                        </tr>
                                    </thead>';
                    while ($row = mysqli_fetch_array($query)) {

                        mysqli_query($conn, "UPDATE   accgame SET daban = 0 WHERE id =" . $row['id']);
                        $id = $row['id'];

                        $taikhoan = $row['taikhoan'];
                        $matkhau = $row['matkhau'];
                        echo '<table style="text-align:left; ">
                                    <thead>
                                        <tr>
                                            <th></th>
                                            <th></th>
                                            <th> </th>                                            
                                        </tr>
                                    </thead>
                                    <tbody>
                                            <tr>                                                
                                                <td>';
                        echo $id;
                        echo '</td>';
                        echo '<td>';
                        echo $taikhoan;
                        echo '</td>
                                                <td>';
                        echo $matkhau;
                        echo '</td>
                                            </tr>

                                    </tbody>
                                </table>';
                    }
                }
            }
            if ($sotien == 20000) {
                echo 'Bạn đã nạp  ' . $sotien . ' vnđ <br>';
                $select = "select * from accgame where daban =1 limit 3";
                $query = mysqli_query($conn, $select);
                if ($query) {

                    $sotk = mysqli_num_rows($query);
                    echo 'Số tài khoản bạn nhận được là :' . $sotk . '<br>';
                    echo ' Đây là danh sách tài khoản của bạn : <br>';
                    echo '<table style="text-align:left; ">
                                    <thead>
                                        <tr>
                                            <th>Id</th>
                                            <th>Tên Tài Khoản   </th>
                                            <th> Mật Khẩu</th>
                                            
                                        </tr>
                                    </thead>';
                    while ($row = mysqli_fetch_array($query)) {

                        mysqli_query($conn, "UPDATE   accgame SET daban = 0 WHERE id =" . $row['id']);
                        $id = $row['id'];

                        $taikhoan = $row['taikhoan'];
                        $matkhau = $row['matkhau'];
                        echo '<table style="text-align:left; ">
                                    <thead>
                                        <tr>
                                            <th></th>
                                            <th></th>
                                            <th> </th>                                            
                                        </tr>
                                    </thead>
                                    <tbody>
                                            <tr>                                                
                                                <td>';
                        echo $id;
                        echo '</td>';
                        echo '<td>';
                        echo $taikhoan;
                        echo '</td>
                                                <td>';
                        echo $matkhau;
                        echo '</td>
                                            </tr>

                                    </tbody>
                                </table>';
                    }
                }
            }
            if ($sotien == 50000) {
                echo 'Bạn đã nạp  ' . $sotien . ' vnđ <br>';
                $select = "select * from accgame where daban =1 limit 6";
                $query = mysqli_query($conn, $select);
                if ($query) {

                    $sotk = mysqli_num_rows($query);
                    echo 'Số tài khoản bạn nhận được là :' . $sotk . '<br>';
                    echo ' Đây là danh sách tài khoản của bạn : <br>';
                    echo '<table style="text-align:left; ">
                                    <thead>
                                        <tr>
                                            <th>Id</th>
                                            <th>Tên Tài Khoản   </th>
                                            <th> Mật Khẩu</th>
                                            
                                        </tr>
                                    </thead>';
                    while ($row = mysqli_fetch_array($query)) {

                        mysqli_query($conn, "UPDATE   accgame SET daban = 0 WHERE id =" . $row['id']);
                        $id = $row['id'];

                        $taikhoan = $row['taikhoan'];
                        $matkhau = $row['matkhau'];
                        echo '<table style="text-align:left; ">
                                    <thead>
                                        <tr>
                                            <th></th>
                                            <th></th>
                                            <th> </th>                                            
                                        </tr>
                                    </thead>
                                    <tbody>
                                            <tr>                                                
                                                <td>';
                        echo $id;
                        echo '</td>';
                        echo '<td>';
                        echo $taikhoan;
                        echo '</td>
                                                <td>';
                        echo $matkhau;
                        echo '</td>
                                            </tr>

                                    </tbody>
                                </table>';
                    }
                }
            }
            if ($sotien == 100000) {
                echo 'Bạn đã nạp  ' . $sotien . ' vnđ <br>';
                $select = "select * from accgame where daban =1 limit 13";
                $query = mysqli_query($conn, $select);
                if ($query) {

                    $sotk = mysqli_num_rows($query);
                    echo 'Số tài khoản bạn nhận được là :' . $sotk . '<br>';
                    echo ' Đây là danh sách tài khoản của bạn : <br>';
                    echo '<table style="text-align:left; ">
                                    <thead>
                                        <tr>
                                            <th>Id</th>
                                            <th>Tên Tài Khoản   </th>
                                            <th> Mật Khẩu</th>
                                            
                                        </tr>
                                    </thead>';
                    while ($row = mysqli_fetch_array($query)) {

                        mysqli_query($conn, "UPDATE   accgame SET daban = 0 WHERE id =" . $row['id']);
                        $id = $row['id'];

                        $taikhoan = $row['taikhoan'];
                        $matkhau = $row['matkhau'];
                        echo '<table style="text-align:left; ">
                                    <thead>
                                        <tr>
                                            <th></th>
                                            <th></th>
                                            <th> </th>                                            
                                        </tr>
                                    </thead>
                                    <tbody>
                                            <tr>                                                
                                                <td>';
                        echo $id;
                        echo '</td>';
                        echo '<td>';
                        echo $taikhoan;
                        echo '</td>
                                                <td>';
                        echo $matkhau;
                        echo '</td>
                                            </tr>

                                    </tbody>
                                </table>';
                    }
                }
            }
            if ($sotien == 200000) {
                echo 'Bạn đã nạp  ' . $sotien . ' vnđ <br>';
                $select = "select * from accgame where daban =1 limit 27";
                $query = mysqli_query($conn, $select);
                if ($query) {

                    $sotk = mysqli_num_rows($query);
                    echo 'Số tài khoản bạn nhận được là :' . $sotk . '<br>';
                    echo ' Đây là danh sách tài khoản của bạn : <br>';
                    echo '<table style="text-align:left; ">
                                    <thead>
                                        <tr>
                                            <th>Id</th>
                                            <th>Tên Tài Khoản   </th>
                                            <th> Mật Khẩu</th>
                                            
                                        </tr>
                                    </thead>';
                    while ($row = mysqli_fetch_array($query)) {

                        mysqli_query($conn, "UPDATE   accgame SET daban = 0 WHERE id =" . $row['id']);
                        $id = $row['id'];

                        $taikhoan = $row['taikhoan'];
                        $matkhau = $row['matkhau'];
                        echo '<table style="text-align:left; ">
                                    <thead>
                                        <tr>
                                            <th></th>
                                            <th></th>
                                            <th> </th>                                            
                                        </tr>
                                    </thead>
                                    <tbody>
                                            <tr>                                                
                                                <td>';
                        echo $id;
                        echo '</td>';
                        echo '<td>';
                        echo $taikhoan;
                        echo '</td>
                                                <td>';
                        echo $matkhau;
                        echo '</td>
                                            </tr>

                                    </tbody>
                                </table>';
                    }
                }
            }
        }
    }

    //mysql_query("UPDATE hqhpt_users SET tien = tien + $xu WHERE username  ='$user';");
    // Xu ly thong tin tai day
       $file = "carddung.log";
      $fh = fopen($file, 'a') or die("cant open file");
      fwrite($fh, "Tai khoan: " . $user . ", Loai the: " . $ten . ", Menh gia: " . $amount . ", Thoi gian: " . $time);
      fwrite($fh, "\r\n");
      fclose($fh);
      echo '<script>alert("Bạn đã thanh toán thành công thẻ ' . $ten . ' mệnh giá ' . $amount . ' ");


      </script>'; 
} else {
    echo 'Status Code:' . $status . '<hr >';
    $error = $result['errorMessage'];
    echo $error;
    $file = "cardsai.log";
    $fh = fopen($file, 'a') or die("cant open file");
    fwrite($fh, "Tai khoan: " . ", Ma the: " . $sopin . ", Seri: " . $seri . ", Noi dung loi: " . $error . ", Thoi gian: " . $time);
    fwrite($fh, "\r\n");
    fclose($fh);
    echo'<script>  alert(" Lỗi !!!  Thẻ Sai:'.$error.' ")';
}

