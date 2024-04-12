<?php
    function getAllProduct(){
        $sql='select * from sach';
        return getAll($sql);
    }

    function getAllProductBySupplierID($idNCC){
        $sql = 'SELECT * FROM sach WHERE idNCC = '.$idNCC;
        return getAll($sql);
    }
    function getProductByID($id){
        $sql = 'select * from sach where idSach='.$id;
        return getOne($sql);
    }

    function isProductExist($tuasach, $tacgia, $nxb, $namxb){
        $sql = 'select idSach from sach where tuasach= "'.$tuasach.'" and tacgia= "'.$tacgia.'" and nxb="'.$nxb.'" and namxb='.$namxb;
       return getOne($sql)!=null;
    }
    
    function addProduct($hinhanh, $tuasach, $tacgia, $nxb, $namxb, $idNCC, $giabia, $giaban, $idTL, $mota){
        $sql='insert into Sach(hinhanh, tuasach, tacgia, nxb, namxb, idNCC, giabia, giaban, idTL, mota, trangthai, idMGG) values ("'.$hinhanh.'","'.$tuasach.'","'.$tacgia.'","'.$nxb.'",'.$namxb.','.$idNCC.','.$giabia.','.$giaban.','.$idTL.',"'.$mota.'",1, NULL)';
        insert($sql);
    }

    function editProduct($idSach, $hinhanh, $tuasach,  $tacgia, $nxb, $namxb, $giabia, $idTL, $idMGG, $mota, $trangthai){
        $sql = 
        'UPDATE Sach
        SET hinhanh = "'.$hinhanh.'",
        tuasach = "'.$tuasach.'",
        tacgia = "'.$tacgia.'",
        nxb = "'.$nxb.'",
        namxb = '.$namxb.',
        giabia = '.$giabia.',';
        if($idMGG === NULL) $sql.='idMGG = NULL,';
        else $sql.='idMGG = '.$idMGG.',';
        $sql.='
        idTL = '.$idTL.',
        mota = "'.$mota.'",
        trangthai = '.$trangthai.'
        WHERE idSach = '.$idSach;
        edit($sql);
    }

    // function editProduct($idSach, $hinhanh, $tuasach,  $tacgia, $nxb, $namxb, $idNCC, $giabia, $idTL, $idMGG, $mota, $trangthai){
    //     $sql = 
    //     'UPDATE Sach
    //     SET hinhanh = "'.$hinhanh.'",
    //     tuasach = "'.$tuasach.'",
    //     tacgia = "'.$tacgia.'",
    //     nxb = "'.$nxb.'",
    //     namxb = '.$namxb.',
    //     idNCC = '.$idNCC.',
    //     giabia = '.$giabia.',';
    //     if($idMGG === NULL) $sql.='idMGG = NULL,';
    //     else $sql.='idMGG = '.$idMGG.',';
    //     $sql.='
    //     idTL = '.$idTL.',
    //     mota = "'.$mota.'",
    //     trangthai = '.$trangthai.'
    //     WHERE idSach = '.$idSach;
    //     edit($sql);
    // }

    function searchProduct($tuasach){
        $sql = 'SELECT * FROM sach WHERE tuasach LIKE "%'.$tuasach.'%"';
        return getAll($sql);
    }

    function lockProduct($id){
        $sql = 
        'UPDATE sach
        SET trangthai = 0
        WHERE idSach = '.$id;
        edit($sql);
    }

    function unlockProduct($id){
        $sql = 
        'UPDATE sach
        SET trangthai = 1
        WHERE idSach = '.$id;
        edit($sql);
    }
?>