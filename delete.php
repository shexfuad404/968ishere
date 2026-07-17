<?php 
if(isset($_GET['delete'])){
$id = htmlspecialchars($_GET['delete']);
$query = mysqli_query($db , "DELETE FROM `name` WHERE `id` = '$id'");
if($query){
  header("Location:post.php");
}
}
?>
