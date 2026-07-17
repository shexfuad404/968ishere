<?php
$title = "Hacking";
$page = "hacking";
include "./includes/header.php";
include "./confing.php";
?>

<?php

session_start();

//get all posts
$query = "SELECT * from post";
$result = mysqli_query($db, $query);

?>


<div class="container">
    <div class="mt-4">
        <?php if (isset($_SESSION["login"])) : ?>
            <a href="./hacking_post.php" class="btn btn-primary"> Add New Post</a>
        <?php endif; ?>
    </div>

    <div class="row my-5 justify-content-center">
        <?php while ($data = mysqli_fetch_assoc($result)) : ?>
            <div class="col-lg-3 mb-4">
                <div class="card">
                    <img class="card-img-top" src=".<?php echo $data["image"] ?>" alt="Card image cap">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $data["title"] ?></h5>
                        <p class="card-text text-muted"><?php echo substr($data["description"], 0, 100) . "..."  ?></p>
                        <div class="d-flex justify-content-end">
                            <a href="hacking_view.php?viewId=<?php echo $data["id"] ?>" class="btn btn-info btn-sm mx-2">View</a>
                        </div>
                    </div>
                </div>
            </div>
        <?php endwhile; ?>
        <?php if (mysqli_num_rows($result) < 1) : ?>
            <div class="col-md-12 text-center bg-white">
                <h2>No post found </h2>
            </div>
        <?php endif; ?>

    </div>
</div>

<?php include "includes/bottom.php" ?>
