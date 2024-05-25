<?php
    require_once("config/db.class.php");
    class ThongTin {
        public $id;
        public $infoTitle;
        public $date;
        public $infoImage;
        public $infoType;
        public $infoContents;

        public function __construct($id, $infoTitle, $date, $infoImage, $infoType, $infoContents) {
            $this->id = $id;
            $this->infoTitle = $infoTitle;
            $this->date = $date;
            $this->infoImage = $infoImage;
            $this->infoType = $infoType;
            $this->infoContents = $infoContents;
        }
        public static function saveThongTin($infoTitle, $date, $infoImage, $infoType, $infoContents) {
            $pic_temp = $infoImage['tmp_name'];
            $user_pic = $infoImage['name'];
            $picpath = "upload/" . $user_pic;
            if (move_uploaded_file($pic_temp, $picpath) == false) {
                return false;
            }
            $db= new Db();
            $sql = "INSERT INTO News (infoTitle, day, infoImage, infoType, infoContents) 
            VALUES ('$infoTitle', '$date', '$picpath', '$infoType', '$infoContents')";
            $result=$db->query_execute($sql);
            return $result;
        }
        public static function updateThongTin($id, $infoTitle, $date, $infoImage, $infoType, $infoContents) {
            $pic_temp = $infoImage['tmp_name'];
            $user_pic = $infoImage['name'];
            $picpath = "upload/" . $user_pic;
            if (move_uploaded_file($pic_temp, $picpath) == false) {
                return false;
            }
            try{
                $db = new Db();
                $sql = "UPDATE News SET infoTitle ='$infoTitle', day = '$date', infoImage = '$picpath', infoType = '$infoType', infoContents ='$infoContents' WHERE id = $id";
                $db->query_execute(($sql));
                return true;
            }
            catch(PDOException $e){
                return false;
            }
        }
        public static function updateThongTinKhongImage($id, $infoTitle, $date,$infoType, $infoContents) {
            try{
                $db = new Db();
                $sql = "UPDATE News SET infoTitle ='$infoTitle', day = '$date', infoType = '$infoType', infoContents ='$infoContents' WHERE id = $id";
                $db->query_execute(($sql));
                return true;
            }
            catch(PDOException $e){
                return false;
            }
        }
        public static function deleteThongTin($id) {
            $db= new Db();
            $sql = "DELETE  FROM News where id = $id";
            $result=$db->query_execute($sql);
            return $result;
        }
        public static function getListThongTinByType($infoType) {
            $db= new Db();
            $sql ="SELECT * FROM News WHERE infoType = '$infoType'";
            $result=$db->select_to_array($sql);
            return $result;
        }
        public static function getListThongTinByType4($infoType) {
            $db= new Db();
            $sql ="SELECT * FROM News WHERE infoType = '$infoType' ORDER BY id ASC LIMIT 4";
            $result=$db->select_to_array($sql);
            return $result;
        }
        public static function getListThongTinByTypeLimit8($infoType) {
            $db= new Db();
            $sql="SELECT * FROM News WHERE infoType= '$infoType' ORDER BY id DESC LIMIT 8";
            $result=$db->select_to_array($sql);
            return $result;
        }
        public static function getListThongTinByTypeLimit($infoType,$item,$offset) {
            $db= new Db();
            $sql="SELECT * FROM News WHERE infoType= '$infoType' ORDER BY id ASC LIMIT $item OFFSET $offset";
            $result=$db->select_to_array($sql);
            return $result;
        }
        public static function getThongTinById($id) {
            $db= new Db();
            $sql ="SELECT * FROM News WHERE id = $id";
            $result=$db->select_to_array($sql);
            return $result;
        }
        public static function getSearchNewstDetail($key,$infoType,$item,$offset){
            $db= new Db();
            $sql="SELECT * FROM News WHERE infoType= '$infoType' and  infoTitle LIKE '%$key%' ORDER BY id ASC LIMIT $item OFFSET $offset";
            $result=$db->select_to_array($sql);
            return $result;
        }
        public static function countSearchNewstDetail($key,$infoType){
            $db= new Db();
            $sql="SELECT * FROM News WHERE infoType= '$infoType' and  infoTitle LIKE '%$key%'";
            $result=$db->select_to_array($sql);
            return $result;
        }
        public static function addThongTinHoiNghi($title,$content, $date, $infoImage) {
            $pic_temp = $infoImage['tmp_name'];
            $user_pic = $infoImage['name'];
            $picpath = "upload/" . $user_pic;
            if (move_uploaded_file($pic_temp, $picpath) == false) {
                return false;
            }
            try{
                $db = new Db();
                $sql = "INSERT INTO research (title, content, day, image, type) 
                VALUES ('$title', '$content', '$date', '$picpath', 1)";
                $db->query_execute(($sql));
                return true;
            }
            catch(PDOException $e){
                return false;
            }
        }
        public static function addThongTinCongTrinhCongBo($title,$content, $date,$type) {
            try{
                $db = new Db();
                $sql = "INSERT INTO research (title, content, day, image, type) 
                VALUES ('$title', '$content', '$date', '', $type)";
                $db->query_execute(($sql));
                return true;
            }
            catch(PDOException $e){
                return false;
            }
        }
        public static function getSearchThongTinNghienCuu($type,$key,$item,$offset) {
            $db= new Db();
            $sql="SELECT * FROM research WHERE type = '$type' and  title LIKE '%$key%' ORDER BY id ASC LIMIT $item OFFSET $offset;";
            $result=$db->select_to_array($sql);
            return $result;
        }
        public static function getThongTinNghienCuu($type,$item,$offset) {
            $db= new Db();
            $sql="SELECT * FROM research WHERE type= $type ORDER BY id ASC LIMIT $item OFFSET $offset";
            $result=$db->select_to_array($sql);
            return $result;
        }
        
        public static function countSearchThongTinNghienCuu($type,$key) {
            $db= new Db();
            $sql="SELECT * FROM research WHERE type= $type and  title LIKE '%$key%'";
            $result=$db->select_to_array($sql);
            return $result;
        }
        public static function countThongTinNghienCuu($type) {
            $db= new Db();
            $sql="SELECT * FROM research WHERE type= $type";
            $result=$db->select_to_array($sql);
            return $result;
        }
        public static function deleteThongTinNghienCuu($id) {
            $db= new Db();
            $sql = "DELETE FROM research where id = $id";
            $result=$db->query_execute($sql);
            return $result;
        }
        public static function getThongTinNghienCuuById($id) {
            $db= new Db();
            $sql ="SELECT * FROM research WHERE id = $id";
            $result=$db->select_to_array($sql);
            return $result;
        }
        public static function updateThongTinNghienCuuKhongImage($id, $title,$content, $date) {
            try{
                $db = new Db();
                $sql = "UPDATE research SET title ='$title', day = '$date', content ='$content' WHERE id = $id";
                $db->query_execute(($sql));
                return true;
            }
            catch(PDOException $e){
                return false;
            }
        }
        public static function updateThongTinNghienCuu($id,$infoImage,$title,$content, $date) {
            $pic_temp = $infoImage['tmp_name'];
            $user_pic = $infoImage['name'];
            $picpath = "upload/" . $user_pic;
            if (move_uploaded_file($pic_temp, $picpath) == false) {
                return false;
            }
            try{
                $db = new Db();
                $sql = "UPDATE research SET title ='$title', day = '$date', image='$picpath', content ='$content' WHERE id = $id"; 
                $db->query_execute(($sql));
                return true;
            }
            catch(PDOException $e){
                return false;
            }
        }
        public static function getListThongTinByType1($infoType) {
            $db= new Db();
            $sql ="SELECT * FROM News WHERE infoType = '$infoType' ORDER BY id DESC LIMIT 1";
            $result=$db->select_to_array($sql);
            return $result;
        }
        public static function showNewsLimit($type,$item, $offset){
            $db= new Db();
            $sql ="SELECT * FROM News where infoType ='$type' and ORDER BY ASC DESC LIMIT $item OFFSET $offset;";
            $result=$db->select_to_array($sql);
            return $result;
        }
        public static function countNewsLimit($type){
            $db= new Db();
            $sql ="SELECT * FROM News where infoType ='$type'";
            $result=$db->select_to_array($sql);
            return $result;
        }
        public static function showSearchNews($key,$id,$type,$item, $offset){
            $db= new Db();
            $sql ="SELECT * FROM subjectDetaiil where subjectType ='$type' and subjectCode=$id and  subjectTitle LIKE '%$key%' LIMIT $item OFFSET $offset;";
            $result=$db->select_to_array($sql);
            return $result;
        }

    }

?>