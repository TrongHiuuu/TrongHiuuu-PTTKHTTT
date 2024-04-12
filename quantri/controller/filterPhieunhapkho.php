<?php
$sql = "select DISTINCT ncc.tenNCC, pn.idPN, tongtien, ngaytao, ngaycapnhat, pn.trangthai 
        from phieunhap as pn
        inner join ctphieunhap as ctpn on pn.idPN = ctpn.idPN
        inner join sach as s on ctpn.idSach = s.idSach
        inner join nhacungcap as ncc on s.idNCC = ncc.idNCC
        where 1";

if(isset($_POST['btnsearch'])) {
    $kyw = $_POST['kyw'];
    if(!empty($kyw)) {
        $sql .= " and (pn.idPN LIKE '%".$kyw."%' or ncc.tenNCC LIKE '%".$kyw."%')";
    }

    if(isset($_POST['dateFrom']) && isset($_POST['dateTo'])) {
        $from = date('Y-m-d', strtotime($_POST['dateFrom']));
        $to = date('Y-m-d', strtotime($_POST['dateTo']));

        $sql .= " AND ngaycapnhat BETWEEN '$from' AND '$to'";
        // $sql .= " and ((year(ngaycapnhat) >= year('$from') and month(ngaycapnhat) >= month('$from') and day(ngaycapnhat) >= day('$from'))  
        //           and (year(ngaycapnhat) <= year('$to') and month(ngaycapnhat) <= month('$to') and day(ngaycapnhat) >= day('$to')))";
    }

} else {
    if(isset($_POST['dateFrom']) && isset($_POST['dateTo'])) {
        $from = date('Y-m-d', strtotime($_POST['dateFrom']));
        $to = date('Y-m-d', strtotime($_POST['dateTo']));

        $sql .= " AND ngaycapnhat BETWEEN '$from' AND '$to'";
        // $sql .= " and ((year(ngaycapnhat) >= year('$from') and month(ngaycapnhat) >= month('$from') and day(ngaycapnhat) >= day('$from'))  
        //           and (year(ngaycapnhat) >= year('$to') and month(ngaycapnhat) >= month('$to') and day(ngaycapnhat) >= day('$to')))";
    }
}
$sql.= " order by pn.idPN";

$result = getAll($sql);
$_SESSION['searchResult'] = $result;
?>