<?php include "includes/header.php";
include "includes/db.php";
include "includes/navigation.php";
?>


    <div class="container">

    <div class="row">


        <div class="col-md-8">
            <?php
            if (isset($_GET['category']))
            {
                $post_category_id=$_GET['category'];

                if(isset($_SESSION['user_role'])&&$_SESSION['user_role']=='admin'){

                    $stmt1= mysqli_prepare($connection,"SELECT post_id,post_title , post_author , post_date , post_image, post_content FROM posts WHERE post_category_id =?");

                }
                else{

                    $stmt2= mysqli_prepare($connection,"SELECT post_id,post_title , post_author , post_date , post_image, post_content FROM posts WHERE post_category_id =? AND post_status=?");

                    $published='published';
                }

if (isset($stmt1)){
    mysqli_stmt_bind_param($stmt1,"i",$post_category_id);
    mysqli_stmt_execute($stmt1);
    mysqli_stmt_bind_result($stmt1,$post_id, $post_title,  $post_author,$post_date ,$post_image,$post_content);
$stmt=$stmt1;

}
else{
    mysqli_stmt_bind_param($stmt2,"is",$post_category_id, $published);
    mysqli_stmt_execute($stmt2);
    mysqli_stmt_bind_result($stmt1,$post_id, $post_title,  $post_author,$post_date ,$post_image,$post_content);
    $stmt=$stmt2;

}



            if(mysqli_stmt_num_rows($stmt)===0){
                echo "<br><br><br>";
                echo "<h1>No posts available</h1>";
            }





            while (mysqli_stmt_fetch($stmt)):
                $post_id= $row['post_id'];
                $post_title =$row['post_title'];
                $post_author= $row['post_author'];
                $post_date= $row['post_date'];
                $post_image= $row['post_image'];
                $post_content= substr($row['post_content'],0,200);
                ?>

                <h1 class="page-header">
                    Page Heading
                    <small>Secondary Text</small>
                </h1>


                <h2>
                    <a href="post.php?p_id=<?= $post_id?>"><?= $post_title ?></a>
                </h2>
                <p class="lead">
                    by <a href="index.php"><?= $post_author ?></a>
                </p>
                <p><span class="glyphicon glyphicon-time"></span> <?= $post_date ?></p>
                <hr>
                <img class="img-responsive" src="images/<?php echo $post_image;?>" alt="">
                <hr>
                <p><?= $post_content ?></p>
                <a class="btn btn-primary" href="#">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>

                <hr>

            <?php endwhile; mysqli_stmt_close($stmt); }
            else{

                header("Location: header.php");
            }



            ?>










        </div>


        <?php include "includes/sidebar.php"; ?>

    </div>
    <hr>



<?php include "includes/footer.php"; ?>


<?php
