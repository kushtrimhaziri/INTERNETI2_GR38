<?php include "includes/header.php";
include "includes/db.php";
include "includes/navigation.php";
include "admin/functions.php";
session_start();

?>





<?php
if(isset($_SESSION['username'])){

    $username=$_SESSION['username'];
    $query="SELECT * FROM users WHERE username='{$username}'";
    $select_user_profile_query=mysqli_query($connection,$query);
    while ($row=mysqli_fetch_array($select_user_profile_query)){
        $user_id = $row['user_id'];
        $username = $row['username'];
        $user_password = $row['user_password'];
        $user_firstname = $row['user_firstname'];
        $user_lastname = $row['user_lastname'];
        $user_email = $row['user_email'];
        $user_image = $row['user_image'];
        $user_role = $row['user_role'];
    }

}

?>

<?php
if(!isset($_SESSION['user_role'])){
    header("Location: index.php");
}
else{
?>
<div id="wrapper">


    <div id="page-wrapper">

        <div class="container-fluid">
            <br>
            <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">
                        Welcome<?php echo $username ?>
                        <small></small>
                    </h1>


                    <table class="table">
                        <tr>
                            <td>First Name:</td>
                            <td><?php echo $user_firstname ?></td>
                        </tr>
                        <tr>
                            <td>Last Name:</td>
                            <td><?php echo $user_lastname ?></td>
                        </tr><tr>
                            <td>Your role:</td>
                            <td><?php echo $user_role ?></td>
                        </tr><tr>
                            <td>Username:</td>
                            <td><?php echo $username ?></td>
                        </tr>


                    </table>






                </div>
            </div>
            <!-- /.row -->

        </div>
        <!-- /.container-fluid -->

    </div>

    <?php }?>

    <body>
    <br><br>

    <div class="weather-container">
        <img class="icon">
        <p class="weather"></p>
        <p class="temp"></p>
        <p class="city"></p>
    </div>

    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="includes/api.js"></script>
    <link rel="stylesheet" href="includes/weather.css">
    </body>

</div>
