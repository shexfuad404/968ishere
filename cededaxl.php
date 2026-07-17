<div class="card" style="width: 18rem;">
  <img class="card-img-top" src="..." alt="Card image cap">
  <div class="card-body">
    <h5 class="card-title">Card title</h5>
    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
    <a href="#" class="btn btn-primary">Go somewhere</a>
  </div>
</div>

<link rel="stylesheet" href="./post.css">
<div class="card" style="width: 18rem;">
<?php
$query = mysqli_query($db,"SELECT * FORM `name");
// $query=  mysqli_query($db, "SELECT * FROM name");



 while($row = mysqli_fetch_assoc($query)){
?>
  <img class="card-img-top" src="./photo.jfif" alt="Card image cap">
  <div class="card-body">
    <h5 class="card-title"><?php echo $row["names"] ?></h5>
    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
    <a href="#" class="delete">Delete post</a>
  </div>
<?php } 
mysqli_close($db);
?>
</div>


<!-- function getTableData($tableName, $colName)
{
  global $db;
  $query = mysqli_query($db, "SELECT * FROM `$tableName`");
  if ($query) {
    while ($row = mysqli_fetch_assoc($query)) {
      echo $row["$colName"];
    }
  }
} -->

<div class="card" style="width: 18rem;">
 <img class="card-img-top" src="upload/?php echo $row['photo'];?> "alt="">
  <div class="card-body">
    <h5 class="card-title"><?php echo $row['names'];?></h5>
    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
    <a href="post.php?delete=<?php echo $row['id'];?>" class="delete">Delete</a>
  </div>
</div>
<?php } ?>








<?php 
if(isset($_POST['submit'])){
  $name = htmlspecialchars($_POST['names']);
  $dec = htmlspecialchars ($_POST['dec']);


  if(empty($name) || empty($dec)){
    $errors['result'] = "noshing descraiption";
  }
else {
  $query = mysqli_query($db , "INSERT INTO `name`(`names`,`dec`) VALUES('$name','$dec')");
  if($query){
    header("location:post.php");
  }
}
}
?>
<form action="post.php" method="POST">
  <div class="form-group" >
<?php if(isset($_POST['submit'])){?><h5><?php echo $errors['result'];?></h5><?php } ?>
    <input type="text" name="names" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Names">
  </div>
  <div class="form-group">
    <input type="text" name="dec" class="form-control" id="exampleInputPassword1" placeholder="Descripshon">
  </div>
  <button type="submit" class="submit">Submit</button>
</form>









<?php 
if(isset($_GET['delete'])){
$id = htmlspecialchars($_GET['delete']);
$query = mysqli_query($db , "DELETE FROM `name` WHERE `id` = '$id'");
if($query){
  header("Location:post.php");
}
}
?>

<?php
if(isset($_POST['submit'])){
$name = htmlspecialchars($_POST['name']);
$price = htmlspecialchars($_POST['dec']);
if (empty($name) || empty($dec)){
$errors['result'] = "JOSHULSOL OLG";
}else{
$query = mysqli_query($db , "INSERT INTO `name` ('names','dec') VALUES ('$name', '$dec')");
if($query){
  header("Location:post.php");
}
}
}
?>






<?php 
$query = mysqli_query($db , "SELECT * FROM `name` ");

while($row = mysqli_fetch_assoc($query)){
  echo $row['names'];
  echo $row['dec'];
}
?>
