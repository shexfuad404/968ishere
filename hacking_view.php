<?php
$title = "View Post";
include "./includes/header.php";
include "./confing.php";
?>

<?php

session_start();

//get the single post
if (isset($_GET['viewId'])) {
    $post_id = htmlspecialchars($_GET["viewId"]);
    $query = "SELECT * from post WHERE id = {$post_id} ";
    $result = mysqli_query($db, $query);
    $data = mysqli_fetch_assoc($result);
}

//delete post
if (isset($_POST['delete'])) {
    $id = htmlspecialchars($_POST["delete_id"]);
    $deleteQuery = mysqli_query($db, "DELETE FROM `post` WHERE `id`='$id'");
    if ($deleteQuery) {
        header('Location:hacking.php');
    }
}

?>

<div class="container">
    <div class="row my-5">
        <div class="col-lg-8 mb-4">
            <div class="card">
                <img class="card-img-top" style="height: 60vh;" src=".<?php echo $data["image"] ?>" alt="image alt">
                <div class="card-body">
                    <h5 class="card-title"><?php echo $data["title"] ?></h5>
                    <p class="card-text"><?php echo  $data["description"] ?></p>
                    <div class="d-flex justify-content-end">
                        <?php if (isset($_SESSION["login"])) : ?>
                            <a href="hacking_edit.php?editId=<?php echo $data["id"] ?>" class="btn btn-info btn-sm mx-2">Edit</a>
                            <form method="POST" action="<?php echo $_SERVER["PHP_SELF"] ?>">
                                <input type="text" hidden value='<?php echo $data["id"] ?>' name="delete_id">
                                <button class="btn btn-danger btn-sm ml-2" name="delete">Delete</button>
                            </form>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include "includes/bottom.php" ?>
