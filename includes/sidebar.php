<?php
ob_start();
include('login.php');
ob_end_clean();
?>

<div class="col-md-4">

    <br><br><br><br><br><br>

    <div class="well">
        <h4>Blog Search</h4>
        <form action="search.php" method="post">
            <div class="input-group">

                <input name="search" id="txt1" type="text" class="form-control" onkeyup="showHint(this.value)">


                <span class="input-group-btn">
                            <button name="submit" class="btn btn-default" type="submit">
                                <span class="glyphicon glyphicon-search"></span>
                        </button>
                        </span>

            </div>
            <p>Suggestions: <span id="txtHint"></span></p>
            <script>
                function showHint(str) {
                    var xhttp;
                    if (str.length == 0) {
                        document.getElementById("txtHint").innerHTML = "";
                        return;
                    }
                    xhttp = new XMLHttpRequest();
                    xhttp.onreadystatechange = function() {
                        if (this.readyState == 4 && this.status == 200) {
                            document.getElementById("txtHint").innerHTML = this.responseText;
                        }
                    };
                    xhttp.open("GET", "gethint.php?q="+str, true);
                    xhttp.send();
                }
            </script>
        </form>
    </div>

    <div class="well">
        <?php if (isset($_SESSION['user_role'])): ?>

            <?php
            setcookie("username", $_SESSION['username'], time()+3600);
            if(isset($_COOKIE["username"])){
                echo "<h4>Logged in as " . $_COOKIE["username"]."</h4>";
            } else{
                echo "Welcome Guest!";
            }

            ?>

            <a href="includes/logout.php" class="btn btn-primary">Logout</a>
        <?php else: ?>
            <h4>Login</h4>
            <form action="includes/login.php" method="post">
                <div class="form-group">
                    <input name="username" type="text" class="form-control" placeholder="Enter Username">
                </div>

                <div class="input-group">
                    <input name="password" type="password" class="form-control" placeholder="Enter Password">
                    <span class="input-group-btn">
            <button class="btn btn-primary" name="login" type="submit">Login</button>

                </span>
                </div>
            </form>
        <?php endif; ?>

    </div>








    <!-- Blog Categories Well -->
    <div class="well">
        <?php $query= "SELECT * FROM category";
        $select_categories_sidebar = mysqli_query($connection,$query);

        ?>


        <h4>Blog Categories</h4>
        <div class="row">
            <div class="col-lg-12">
                <ul class="list-unstyled">
                    <?php
                    while ($row=mysqli_fetch_assoc($select_categories_sidebar)){
                        $cat_title= $row['cat_title'];

                        echo "<li><a href='#'> {$cat_title}</a></li>";
                    }?>

                </ul>
            </div>





        </div>
        <!-- /.row -->
    </div>

    <!-- Side Widget Well -->


</div>
