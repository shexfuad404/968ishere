
<?php
if(isset($_POST['submit'])){
$name = htmlentities($_POST['name']);
$dec = htmlentities ($_POST['dec']);
// this is information of image
$file = $_FILES['file'];
$fileName = $file['name'];
$fileType = $file['type'];
$fileTmpName = $file['tmp_name'];
$fileError = $file['error'];
$fileSize = $file['size'];

$fileExt = explode('.' , $fileName);
$fileActualExt = strtolower(end($fileExt));
$fileAllowed = array('png' , 'jpg' , 'jpeg' , 'svg' , 'gif');

if(in_array($fileActualExt , $fileAllowed)){
if($fileError === 0){
if($fileSize < 10000000){

$fileNewName = rand().".".$fileActualExt;
$fileDestinition = "upload/$fileNewName";
move_uploaded_file($fileTmpName ,$fileDestinition);

$query = mysqli_query($db , "INSERT INTO `name`(`names`,`dec`,`photo`) VALUES('$name','$dec',$fileNewName)");
if($query){
  header("location:index.php?success");
}

}else {
  $errors['result'] = "photo is 1000000 mg";
}
}else {
  $errors['result'] = "plese refresh website";
}

}else {
  $errors['result'] = "fake photo";
}
}
