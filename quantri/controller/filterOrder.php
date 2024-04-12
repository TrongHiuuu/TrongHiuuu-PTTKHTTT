<?php
$sql = "select idDH, tenTK, ngaytao, ngaycapnhat, tongtien, dh.trangthai 
        from donhang as dh inner join taikhoan as tk on dh.idTK = tk.idTK
        where 1";

if(isset($_POST['btnsearch'])) {
    $kyw = $_POST['kyw'];
    if(!empty($kyw)) {
        $sql .= " and (dh.idDH LIKE '%".$kyw."%' or tk.tenTK LIKE '%".$kyw."%')";
        
        if(isset($_POST['trangthai']) && ($_POST['trangthai']) != -1) {
            $trangthai = $_POST['trangthai'];
            $sql .= " and dh.trangthai = '$trangthai'";
        }

        if(isset($_POST['dateFrom']) && isset($_POST['dateTo'])) {
            $from = date('Y-m-d', strtotime($_POST['dateFrom']));
            $to = date('Y-m-d', strtotime($_POST['dateTo']));
            $sql .= " and ((year(ngaycapnhat) >= year('$from') and month(ngaycapnhat) >= month('$from') and day(ngaycapnhat) >= day('$from'))  
                      and (year(ngaycapnhat) >= year('$to') and month(ngaycapnhat) >= month('$to') and day(ngaycapnhat) >= day('$to')))";
        }
    }
    else {
        if(isset($_POST['trangthai']) && ($_POST['trangthai']) != -1) {
            $trangthai = $_POST['trangthai'];
            $sql .= " and dh.trangthai = '$trangthai'";
        }

        if((isset($_POST['dateFrom']) && ($_POST['dateFrom'] != "")) && (isset($_POST['dateTo']) && ($_POST['dateTo'] != ""))) {
            $from = date('Y-m-d', strtotime($_POST['dateFrom']));
            $to = date('Y-m-d', strtotime($_POST['dateTo']));
            $sql .= " and ((year(ngaycapnhat) >= year('$from') and month(ngaycapnhat) >= month('$from') and day(ngaycapnhat) >= day('$from'))  
                      and (year(ngaycapnhat) <= year('$to') and month(ngaycapnhat) <= month('$to') and day(ngaycapnhat) <= day('$to')))";
        }
    }

}

$result = getAll($sql);
$_SESSION['searchResult'] = $result;
?>