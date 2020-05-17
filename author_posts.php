<?php include "includes/header.php";
include "includes/db.php";
include "includes/navigation.php";
?>


    <div class="container">

    <div class="row">


        <div class="col-md-8">
            <?php
            if (isset($_GET['p_id'])){
                $the_post_id=$_GET['p_id'];
                $the_post_author=$_GET['author'];
            }

            $query= "SELECT * FROM posts WHERE post_author ='{$the_post_author}'";
            $select_all_posts = mysqli_query($connection,$query);

            while ($row=mysqli_fetch_assoc($select_all_posts)){
                $post_title= $row['post_title'];
                $post_author= $row['post_author'];
                $post_date= $row['post_date'];
                $post_image= $row['post_image'];
                $post_content= $row['post_content'];
                ?>

                <h1 class="page-header">
                    Page Heading
                    <small>Secondary Text</small>
                </h1>


                <h2>
                    <a href="#"><?= $post_title ?></a>
                </h2>
                <p class="lead">
                    by <a href="#"><?= $post_author ?></a>
                </p>
                <p><span class="glyphicon glyphicon-time"></span> <?= $post_date ?></p>
                <hr>
                <img class="img-responsive" src="images/<?php echo $post_image;?>" alt="">
                <hr>
                <p><?= $post_content ?></p>


                <hr>

            <?php }?>

            <!-- Blog Comments -->

            <?php

            if(isset($_POST['create_comment'])) {



                $the_post_id = $_GET['p_id'];

                $comment_author = $_POST['comment_author'];
                $comment_email = $_POST['comment_email'];
                $comment_content = $_POST['comment_content'];
                if (!empty($comment_author) && !empty($comment_email) && !empty($comment_content)){


                    $query = "INSERT INTO comments (comment_post_id, comment_author, comment_email, comment_content,
                comment_status, comment_date)";

                    $query .= "VALUES  ($the_post_id, '{$comment_author}', '{$comment_email}', '{$comment_content}', 'unapproved', now())";

                    $create_comment_query = mysqli_query($connection, $query);
                    if(!$create_comment_query){
                        die('QUERY FAILED ' . mysqli_error($connection));
                    }

                    $query = "UPDATE posts SET post_comment_count = post_comment_count+1";
                    $query .= "WHERE post_id = $the_post_id ";

                    $update_comment_count = mysqli_query($connection, $query);
                }
                else
                {
                    echo "<script>alert('Fields should not be empty')</script>";
                }


            }

            ?>




            <!-- Comments Form -->









            <!-- Comment -->
            <!--            <div class="media">-->
            <!---->
            <!---->
            <!--                <a class="pull-left" href="#">-->
            <!--                    <img class="media-object" src="http://placehold.it/64x64" alt="">-->
            <!--                </a>-->
            <!--                <div class="media-body">-->
            <!--                    <h4 class="media-heading">Start Bootstrap-->
            <!--                        <small>August 25, 2014 at 9:30 PM</small>-->
            <!--                    </h4>-->
            <!--                    Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin commodo. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.-->
            <!--                </div>-->
            <!--            </div>-->


        </div>

        <!-- Blog Sidebar Widgets Column -->

        <?php include "includes/sidebar.php"; ?>

    </div>

    <!-- /.row -->

    <hr>



<?php include "includes/footer.php"; ?>


<?php
