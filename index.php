<?php include "includes/header.php";
include "includes/db.php";
include "includes/navigation.php";
?>


    <div class="container">

    <div class="row">


        <div class="col-md-8">
            <?php


            if(isset($_GET['page'])){

                $page=$_GET['page'];
            }else{

                $page="";
            }

            if($page=="" || $page==1){
                $page_1=0;
            }else{

                $page_1=($page*3)-3;
            }



            $post_query_count = "SELECT * FROM posts  WHERE post_status='published' ";
            $find_count = mysqli_query($connection,$post_query_count);
            $count = mysqli_num_rows($find_count);
            
            
            if($count<1){
                echo"NO POSTS";
                  echo"<br>NO POSTS</br>";
                                  echo"<br><h1 class='text-center'>NO POSTS AVALIABLE</h1></br>";

                 
            }
            else{

            $count=ceil($count/5);





            $query= "SELECT * FROM posts LIMIT $page_1,3";
            $select_all_posts = mysqli_query($connection,$query);

            while ($row=mysqli_fetch_assoc($select_all_posts)){
                $post_id= $row['post_id'];
                $post_title =$row['post_title'];
                $post_author= $row['post_author'];
                $post_date= $row['post_date'];
                $post_image= $row['post_image'];
                $post_content= substr($row['post_content'],0,200);
                $post_status = $row['post_status'];





                    ?>


                    <h1><br></h1>
                    <h2>
                        <a href="post.php?p_id=<?php echo $post_id; ?>"><?php echo $post_title ?></a>
                    </h2>
                    <p class="lead">
                        by <a href="index.php"><?= $post_author ?></a>
                    </p>
                    <p><span class="glyphicon glyphicon-time"></span> <?= $post_date ?></p>
                    <hr>


                    <a href="post.php?p_id=<?php echo $post_id; ?>">
                        <img class="img-responsive" src="images/<?php echo $post_image;?>" alt="">
                    </a>
                    <hr>
                    <p><?= $post_content ?></p>
                    <a class="btn btn-primary" href="post.php?p_id=<?php echo $post_id; ?>">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>

                    <hr>

                <?php } 
                
                 }?>










        </div>


        <?php include "includes/sidebar.php"; ?>

    </div>
    <hr>
    <ul class="pager">

        <?php

        for($i=1;$i<=$count;$i++){

            echo "<li><a href='index.php?page={$i}'>{$i}</a></li>";
        }

        ?>


    </ul>




<?php include "includes/footer.php"; ?>


<?php
