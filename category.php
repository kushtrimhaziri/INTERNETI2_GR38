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
            }
            $query= "SELECT * FROM posts WHERE post_category_id=$post_category_id";
            $select_all_posts = mysqli_query($connection,$query);

            while ($row=mysqli_fetch_assoc($select_all_posts)){
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

            <?php }?>










        </div>


        <?php include "includes/sidebar.php" ; ?>

    </div>
    <hr>



<?php include "includes/footer.php"; ?>


<?php
