<?php 
require_once("config/db.class.php");
class Detail{



public $subjectName;
public $image;
public $info;
public function __construct( $subjectName,$image,$info){
$this->subjectName=$subjectName;
$this->image=$image;
$this->info=$info;
}
public function save(){
    $pic_temp = $this->image['tmp_name'];
    $user_pic = $this->image['name'];
    $picpath = "upload/" . $user_pic;
    if (move_uploaded_file($pic_temp, $picpath) == false) {
        return false;
    }
    $db= new Db();
    $sql="INSERT INTO Subject(subjectName,subjectImage,subjectInfo) VALUES
    ('$this->subjectName','$picpath','$this->info');";
    $result=$db->query_execute($sql);
    return $result;
}
public static function saveTaiLieu($sCode,$sTitle,$file,$sType){
    $file_temp = $file['tmp_name'];
    $user_file = $file['name'];
    $filepath = "upload/" . $user_file;
    if (move_uploaded_file($file_temp, $filepath) == false) {
        return false;
    }
    $db= new Db();
    $sql = "INSERT INTO subjectDetaiil (subjectCode, subjectTitle,  file   , subjectType) 
    VALUES ($sCode, '$sTitle', '$filepath', '$sType')";
    $result=$db->query_execute($sql);
    return $result;
}
public static function saveVideo($sCode,$sTitle,$file,$sType){
    $db= new Db();
    $sql = "INSERT INTO subjectDetaiil (subjectCode, subjectTitle,  file   , subjectType) 
    VALUES ($sCode, '$sTitle', '$file', '$sType')";
    $result=$db->query_execute($sql);
    return $result;
}
public static function list_Subject()
{
    $db= new Db();
    $sql ="SELECT * FROM Subject";
    $result=$db->select_to_array($sql);
    return $result;
}
public static function list_SubjectWithSearch($key){
    $db= new Db();
    $sql ="SELECT * FROM Subject where subjectName LIKE '%$key%' ";
    $result=$db->select_to_array($sql);
    return $result;
}
public static function get_Subject($id)
{
    $db= new Db();
    $sql ="SELECT * FROM Subject  where subjectCode=$id";
    $result=$db->select_to_array($sql);
    return $result;
}
public static function suaTaiLieu($id,$Title,$file){
    $file_temp = $file['tmp_name'];
    $user_file = $file['name'];
    $filepath = "upload/" . $user_file;
    if (move_uploaded_file($file_temp, $filepath) == false) {
        return false;
    }
    $db= new Db();
    $sql = "CALL updateDetailSubject($id,'$Title','$filepath')";
    $result=$db->query_execute($sql);
    return $result;
}
public static function suaTenTaiLieu($id,$Title){
    $db= new Db();
    $sql="UPDATE subjectDetaiil SET subjectTitle = '$Title' WHERE id = '$id' ;";
    $result=$db->query_execute($sql);
    return $result;
}
public static function suaVideo($id,$Title,$file){
    $db= new Db();
    $sql = "CALL updateDetailSubject($id,'$Title','$file')";
    $result=$db->query_execute($sql);
    return $result;
}
public static function list_SubjectDtail($id)
{
    $db= new Db();
    $sql ="SELECT * FROM subjectDetaiil where subjectCode=$id";
    $result=$db->select_to_array($sql);
    return $result;
}
public static function list_SubjectDetailByType($id,$Title)
{
    $db= new Db();
    $sql ="SELECT * FROM subjectDetaiil where subjectCode=$id and subjectType = '$Title'";
    $result=$db->select_to_array($sql);
    return $result;
}
public static function list_SubjectDetailId($id)
{
    $db= new Db();
    $sql ="SELECT * FROM subjectDetaiil where id=$id";
    $result=$db->select_to_array($sql);
    return $result;
}
//     public static function delete_Subject($id){
//         $db= new Db();
//         $sql ="DELETE  FROM Subject Where subjectCode='$id'";
//         $result=$db->query_execute($sql);
//     return $result;
//     }
//     public static function list_Subject_Update($id){
//         $db= new Db();
//         $sql ="SELECT * FROM Subject Where subjectCode=$id";
//         $result=$db->select_to_array($sql);
//         return $result;
      
//         }   



public static function update_subject($subjectCode, $subjectName,$picture,$info)
{

    if ($picture['name'] != "") 
    {
        $pic_temp = $picture['tmp_name'];
        $user_pic = $picture['name'];
        $picpath = "upload/" . $user_pic;
        if (move_uploaded_file($pic_temp, $picpath) == false)
        {
            return false;
        }
    }
    $sql = "CALL updateSubject('$subjectCode','$subjectName',' $picpath','$info')";
try
{
    $db = new Db();
    $db->query_execute(($sql));
    return true;
}
catch(PDOException $e)
{
    return false;
}
}
public static function update_subjectname($subjectCode, $subjectName,$info)
{

    $sql = "CALL updateNameSubject('$subjectCode','$subjectName','$info')";

try{
    $db = new Db();
    $db->query_execute(($sql));
    return true;
}
catch(PDOException $e){
    return false;
}
}
public static function delete_Subject($id)
{
    $db= new Db();
    $sqlAll ="DELETE  FROM subjectDetaiil Where subjectCode='$id'";
    $result=$db->query_execute($sqlAll);
    $sql ="DELETE  FROM Subject Where subjectCode='$id'";
    $result=$db->query_execute($sql);
    return $result;
}
// public  function delete_AllSubjectDetaile($id)
// {
//     $db= new Db();
//     $sql ="DELETE  FROM subjectDetaiil Where subjectCode='$id'";
//     $result=$db->query_execute($sql);
//     return $result;
// }
public static function delete_SubjectDetaile($id)
{
    $db= new Db();
    $sql ="DELETE  FROM subjectDetaiil Where id=$id";
    $result=$db->query_execute($sql);
    return $result;
}
public static function showLimitSubject($item, $offset){
    $db= new Db();
    $sql ="SELECT * FROM Subject ORDER BY subjectCode ASC LIMIT $item OFFSET $offset";
    $result=$db->select_to_array($sql);
    return $result;
}
public static function showLimitSubjectDetail($id,$type,$item, $offset){
    $db= new Db();
    $sql ="SELECT * FROM subjectDetaiil where subjectType ='$type' and subjectCode=$id ORDER BY subjectCode ASC LIMIT $item OFFSET $offset";
    $result=$db->select_to_array($sql);
    return $result;
}
public static function showSubjectDetail($id,$type){
    $db= new Db();
    $sql ="SELECT * FROM subjectDetaiil where subjectType ='$type' and subjectCode=$id";
    $result=$db->select_to_array($sql);
    return $result;
}
public static function showSearchSubject($key,$item, $offset){
    $db= new Db();
    $sql ="SELECT * FROM Subject WHERE subjectName LIKE '%$key%' LIMIT $item OFFSET $offset;";
    $result=$db->select_to_array($sql);
    return $result;
}
public static function countSearchSubject($key){
    $db= new Db();
    $sql ="SELECT * FROM Subject WHERE subjectName LIKE '%$key%'";
    $result=$db->select_to_array($sql);
    return $result;
}
public static function showSearchSubjectDetail($key,$id,$type,$item, $offset){
    $db= new Db();
    $sql ="SELECT * FROM subjectDetaiil where subjectType ='$type' and subjectCode=$id and  subjectTitle LIKE '%$key%' LIMIT $item OFFSET $offset;";
    $result=$db->select_to_array($sql);
    return $result;
}
public static function countSearchSubjectDetail($key,$id,$type){
    $db= new Db();
    $sql ="SELECT * FROM subjectDetaiil where subjectType ='$type' and subjectCode=$id and  subjectTitle LIKE '%$key%'";
    $result=$db->select_to_array($sql);
    return $result;
}
public static function showLimitSubject10(){
    $db= new Db();
    $sql ="SELECT * FROM Subject ORDER BY subjectCode ASC LIMIT 11";
    $result=$db->select_to_array($sql);
    return $result;
}
public static function showLimitSubject8(){
    $db= new Db();
    $sql ="SELECT * FROM Subject ORDER BY subjectCode ASC LIMIT 6";
    $result=$db->select_to_array($sql);
    return $result;
}
}

?>