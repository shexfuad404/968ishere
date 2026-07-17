<?php
$title = "Edit Post";
include "./includes/header.php";
include "./confing.php";
?>

<?php

session_start();
if (isset($_GET['editId'])) {
    $id = $_GET['editId'];
}
if (isset($_POST['update'])) {
    $id = htmlspecialchars($_POST["edit_id"]);
    $title = htmlspecialchars($_POST["title"]);
    $description = htmlspecialchars($_POST["description"]);


    if ($_FILES['file']['name']) {
        $file = $_FILES['file'];
        $fileName = $file['name'];
        $fileType = $file['type'];
        $fileTmpName = $file['tmp_name'];
        $fileError = $file['error'];
        $fileSize = $file['size'];
        $fileExt = explode(".", $fileName);
        $fileActualExt = strtolower($fileExt[1]);
        $allowedFileType = ["png", 'jpg', 'jpeg'];

        if (in_array($fileActualExt, $allowedFileType)) {
            $newFileName = $fileExt[0] . "." . $fileActualExt;
            move_uploaded_file($fileTmpName, "./upload/$newFileName");
            $query = "UPDATE post 
        SET title = '$title', description= '$description' , image= '/upload/$newFileName' 
        WHERE id = {$id}";
            $result = mysqli_query($db, $query);
            if ($result) {
                header("Location:hacking.php");
            } else {
                $error["result"] = "please choose valid image (png, jpg, jpeg)";
            }
        }
    } else {
        $query = "UPDATE post 
        SET title = '$title', description= '$description'
        WHERE id = {$id}";
        $result = mysqli_query($db, $query);
        if ($result) {
            header("Location:hacking.php");
        }
    }
}


$query1 = "SELECT * from post  WHERE id = {$id}";
$result = mysqli_query($db, $query1);
$data = mysqli_fetch_assoc($result);
?>



<?php if (isset($_SESSION["login"])) : ?>
    <div class="container">
        <div class="row my-5 justify-content-center">
            <div class="col-md-8 bg-white p-3 rounded">
                <form class=" p-4 rounded" enctype="multipart/form-data" method="post" action="<?php echo $_SERVER["PHP_SELF"] ?>">
                    <h3 class="mb-4">Edit Post</h3>
                    <?php if (isset($_POST["add"])) {
                        echo "<p class='text-danger'>" . $error['result'] . "</p>";
                    } ?>
                    <div class="mb-3">
                        <label for="title" class="form-label">Title</label>
                        <input type="text" class="form-control" name="title" id="title" value="<?php echo $data['title'] ?>" placeholder="post title">
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control" name="description" id="description" rows="4"><?php echo $data['description'] ?></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="file" class="form-label">Choose Post Image</label>
                        <input class="form-control" type="file" name="file" id="file">
                    </div>
                    <input type="text" hidden value='<?php echo $data["id"] ?>' name="edit_id">
                    <button type="submit" name="update" class="btn btn-outline-primary mb-3">Edit</button>
                </form>
            </div>
        </div>
    </div>

<?php endif; ?>

<?php include "includes/bottom.php" ?>
