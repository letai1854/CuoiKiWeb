<?php
require_once("entities/subject.class.php");
$id=$_GET['sid'];
$subject=Detail::get_Subject($id);
$name=$subject[0]['subjectName'];
if(isset($_POST['btnAccept']))
{
  $name=$_POST['name'];
  $type=$_POST['type'];
  $file=$_FILES['editor'];
  $video=$_POST['video'];
  $check=false;
  if($video!="" && $type=="other"){
    $result=Detail::saveVideo($id,$name,$video,$type);
    $check=true;
  }
  if($_FILES['editor']['name'] != '' &&$type!="other") 
  {
    $result=Detail::saveTaiLieu($id,$name,$file,$type);
    $check=true;

  }
  if(!$check){
    echo '<script>alert("Hãy chọn đúng dữ liệu!")</script>';
  }
  if(isset($result))
  {
		if(!$result)
    {
			echo '<script>alert("không thêm được!")</script>';
		}
		else
    {
			echo '<script>alert("Thêm thành công!")</script>';
		}
	}
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>home</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
    integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

<link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" />

<link rel="stylesheet" href="style.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="myScript/script.js"></script>
    <link rel="stylesheet" href="./style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" />
    <link rel="stylesheet" href="style.css">
    <style>
      .single{
        border: 1px solid  #eeeded;
        border-radius: 3px;
        background-color:  #eeeded;
        margin-bottom: 30px;
        justify-content:center ;
        width: auto;
    }
    .single:hover{
        transform: scale(1.1) ;
        background-color: #908E8E;
        color:#eeeded;
    }
      .title{
        display: flex;
        justify-content: center;
      }
    </style>
</head>
<body>
<div class="infor container text-center py-1 mt-1">
      <div class="row">
      <div class="col-lg-3 col-md-4 col-sm-6 col-12">
          <div class="single" >
            <a href="" style=" text-decoration: none;
        color: black;">
                <div class="single-how-works-icon"><i class="fas fa-user"></i></div>
                <h6 style=" color:black;   text-transform: uppercase;">thông tin <br>cá <br> nhân</h6>
            </a>
            <!-- <p>Thêm chỉnh sửa thông tin môn học, tài liệu môn học</p> -->
          </div>
        </div>
        <div class="col-lg-3 col-md-4 col-sm-6 col-12">
          <div class="single" >
          <a href="" style=" text-decoration: none;
        color: black;">
        <div class="single-how-works-icon"><i class="fas fa-book"></i></div>
        <h6 style="  color:black;  text-transform: uppercase;">thông tin <br> bài <br> đăng</h6>
          </a>
            <!-- <p>Thêm chỉnh sửa thông tin môn học, tài liệu môn học</p> -->
          </div>
        </div>
        <div class="col-lg-3 col-md-4 col-sm-6 col-12">
          <div class="single">
          <a href="" style=" text-decoration: none;
        color: black;">
        <div class="single-how-works-icon" ><i class="fas fa-microscope"></i></div>
        <h6 style="  color:black;  text-transform: uppercase;">thông tin nghiên <br> cứu</h6>
          </a>
            <!-- <p>Thêm và chỉnh sửa thông tin các bài nghiên cứu</p> -->
          </div>
        </div>
        <div class="col-lg-3 col-md-4 col-sm-6 col-12">
          <div class="single">
          <a href="" style=" text-decoration: none;
        color: black;">
        <div class="single-how-works-icon" ><i class="fas fa-newspaper"></i></div>
        <h6 style="  color:black;  text-transform: uppercase;">thông tin môn <br>  học</h6>
          </a>
            <!-- <p>Thêm và chỉnh sửa thông tin các bài nghiên cứu</p> -->
          </div>
        </div>

      </div>
</div>
      <div class="titleSubject">
        <h1 class=" title"><?php echo $name ?></h1>
      </div>
      
      <div class="row  container">
        <div class="col-xl-4 col-md-6 col-12">
          <div class="container ">
            <h2 class="text-center" style="">THÊM TÀI LIỆU</h2>
            <form action="#" method="post" class="formSubject"enctype="multipart/form-data">
              <div class="form-group">
                <label for="name">Tên tài liệu:</label>
                <input type="text" id="name" name="name" class="form-control">
              </div>
           
              <div class="form-group">
                <label for="type">Loại:</label>
                <select id="type" name="type" class="form-control">
                  <option value="theory" >Lý thuyết</option>
                  <option value="practice">Thực hành</option>
                  <option value="other">Khác</option>
                </select>
              </div>
              <div class="form-group">
                <label for="document">Chọn file:</label>
                <!-- <textarea name="editor" id="editor"></textarea> -->
                <input type="file" id="document" name="editor" accept=".pdf,.doc,.docx" class="form-control">
              </div>       
              <div class="form-group">
              <label for="video">Chọn video:</label>
              <input type="text" id="video" name="video" class="form-control">
              </div>      
              <div class="form-group">
                <button type="submit" class="btn btn-primary" name="btnAccept">Xác nhận</button>
              </div>
              

            </form>
          </div>
        </div>
        <div class="col-lg-8 col-md-12 col-12">
    <div class="">
    <div class="container-fluid tim">
    <form class="d-flex" action="#" method="post" enctype="multipart/form-data">
      <input class="form-control me-2" type="search" name="tim" placeholder="Tìm kiếm" aria-label="Search">
      <button class="btn1 btn btn-dark" type="submit" name="btntimkiem">Tìm kiếm</button>
    </form>
    </div>
    <table class="table table-hover">
        <thead>
            <tr>
                <th>Tên môn học</th>
                <th>Ảnh môn học</th>
                <th>Chức năng</th>
            </tr>
        </thead>
        <tbody >
                
               
        </tbody>
    </table>
    <div class="">
    
    </div>
    </div>
    </div>
      </div> 
      </div>
  
      <!-- <script src="ckeditor5-build-classic/ckeditor.js"></script>
    <script>
        ClassicEditor
        .create(document.querySelector("#editor"),{
            ckfinder:{
                uploadUrl:'fileupload.php'
            }
        })
        .then(editor=>{
            console.log(editor);
        })

        .catch(error=>{
            console.error(error)
        });
    </script> -->



  
    <?php require_once("footer.php") ?>
</body>
</html>