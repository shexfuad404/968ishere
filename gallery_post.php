<?php
$title = "New Gallery";
include "./includes/header.php";
include "./confing.php";
?>

<?php

session_start();

if (isset($_POST["submit"])) {
    $title = htmlspecialchars($_POST["title"]);
    $description = htmlspecialchars($_POST["description"]);

    if (empty($title) || empty($description)) {
        $error["result"] = "please fill all the fields";
    }

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
        $query = mysqli_query($db, "INSERT INTO `gallery`(`title`,`description`,`image`) VALUES ('$title','$description','/upload/$newFileName')");
        if ($query) {
            header("Location:gallery.php");
        }
    } else {
        $error["result"] = "please choose valid image (png, jpg, jpeg)";
    }
}
?>

<?php if (isset($_SESSION["login"])) : ?>
    <div class="container">
        <div class="row my-5 justify-content-center">
            <div class="col-md-8 bg-white p-3 rounded">
                <form class=" p-4 rounded" enctype="multipart/form-data" method="post" action="<?php echo $_SERVER["PHP_SELF"] ?>">
                    <h3 class="mb-4">Add New Gallery</h3>
                    <?php if (isset($_POST["add"])) {
                        echo "<p class='text-danger'>" . $error['result'] . "</p>";
                    } ?>

                    <div class="mb-3">
                        <label for="title" class="form-label">Title</label>
                        <input type="text" class="form-control" name="title" id="title" placeholder="post title">
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control" name="description" id="description" rows="4"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="file" class="form-label">Choose Post Image</label>
                        <input class="form-control" type="file" name="file" id="file">
                    </div>
                    <button type="submit" name="submit" class="btn btn-primary mb-3">Submit</button>
                </form>
            </div>
        </div>
    </div>

<?php endif; ?>

<?php include "includes/bottom.php" ?>
