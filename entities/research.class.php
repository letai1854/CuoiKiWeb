<?php
require_once("config/db.class.php");
class Research {

    // public static function getHoiNghi() {
    //     $db= new Db();
    //     $sql ="SELECT * FROM research where type = 1";
    //     $result=$db->select_to_array($sql);
    //     return $result;
    // }

    public static function getNCKH() {
        $db= new Db();
        $sql ="SELECT * FROM research where type = 2";
        $result=$db->select_to_array($sql);
        return $result;
    }

    public static function getCongBo() {
        $db= new Db();
        $sql ="SELECT * FROM research where type = 3";
        $result=$db->select_to_array($sql);
        return $result;
    }

    public static function getResearchById($id) {
        $db= new Db();
        $sql ="SELECT * FROM research where id = $id";
        $result=$db->select_to_array($sql);
        return $result;
    }
    public static function getHoiNghi($item, $offset){
        $db= new Db();
        $sql ="SELECT * FROM research where type = 1 LIMIT $item OFFSET $offset;";
        $result=$db->select_to_array($sql);
        return $result;
    }
    public static function countgetHoiNghi(){
        $db= new Db();
        $sql ="SELECT * FROM research where type = 1";
        $result=$db->select_to_array($sql);
        return $result;
    }
    public static function getHoiNghiByID($id){
        $db= new Db();
        $sql ="SELECT * FROM research where type = 1 and id='$id'";
        $result=$db->select_to_array($sql);
        return $result;
    }


}


?>