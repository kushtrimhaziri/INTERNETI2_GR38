<?php
function confirmQuery($result){
    global $connection;
    if (!$result){
        die("QUERY FAILED.". mysqli_error($connection));
    }


}


function insert_categories()
{
    global $connection;
    if (isset($_POST['submit'])) {
        $cat_title = $_POST['cat_title'];
        if ($cat_title == "" || empty($cat_title)) {
            echo "This field should not be empty";
        } else {
            $stmt =mysqli_prepare($connection,"INSERT INTO category(cat_title) VALUES (?)") ;

            mysqli_stmt_bind_param($stmt,'s',$cat_title);
            mysqli_stmt_execute($stmt);


            if (!$stmt) {
                die('Query Failed' . mysqli_error($connection));
            }
        }

    }
    }

    function findAllCategories(){
        global $connection;
        $query= "SELECT * FROM category";
        $select_categories = mysqli_query($connection,$query);
        while ($row=mysqli_fetch_assoc($select_categories)){
            $cat_id= $row['cat_id'];
            $cat_title= $row['cat_title'];

            echo "<tr>";
            echo "<td>{$cat_id}</td>";
            echo "<td>{$cat_title}</td>";

            echo "<td><a href='categories.php?delete={$cat_id}'>Delete</a></td>";
            echo "<td><a href='categories.php?edit={$cat_id}'>Edit</a></td>";

            echo "</tr>";

    }}

    function deleteCategories(){
        global $connection;
        if (isset($_GET['delete'])){

            $the_cat_id=$_GET['delete'];

            $query="DELETE FROM category WHERE cat_id={$the_cat_id} ";
            $delete_query=mysqli_query($connection,$query);
            header("Location: categories.php");

        }

    }

    function is_admin($username){
    global $connection;
    $query ="SELECT user_role FROM users WHERE username = '$username'";

   $result=  mysqli_query($connection,$query);
    confirmQuery($result);

   $row= mysqli_fetch_assoc($result);

        if (preg_match("/admin/", $row['user_role'])){
            return true;
        }
        else
        {
       return false;
        }


}
function username_exists($username){
    global $connection;
    $query = "SELECT username FROM users WHERE username='$username'";
    $result=mysqli_query($connection,$query);
    confirmQuery($result);

    if (mysqli_num_rows($result) >0){
        return true;

    }
    else{
        return false;
    }


}

function email_exists($email){
    global $connection;
    $query = "SELECT user_email FROM users WHERE user_email='$email'";
    $result=mysqli_query($connection,$query);
    confirmQuery($result);

    if (mysqli_num_rows($result) >0){
        return true;

    }
    else{
        return false;
    }


}
function validateEmail($email) {

    if(filter_var($email, FILTER_VALIDATE_EMAIL)){
        return true;
    }else{
        return false;
    }

}

function redirect($location){

    return header("Location:".$location);
    exit;
}
function ifItIsMethod($method=null){
    if($_SERVER['REQUEST_METHOD']==strtoupper($method)){
        return true;
    }
    return false;
}
function isLoggedIn(){
    if(isset($_SESSION['user_role'])){
        return true;
    }
    return false;

}
function checkifUserIsLogedInAndRedirect($redirectLocation=null){
    if(isLoggedIn()){
        redirect($redirectLocation);
    }

}

function register_user($firstname,$lastname,$username,$email,$password){
    global $connection;


        $firstname=mysqli_real_escape_string($connection,$firstname);
        $lastname=mysqli_real_escape_string($connection,$lastname);
        $username = mysqli_real_escape_string($connection,$username);
        $email=mysqli_real_escape_string($connection,$email);
        $password=mysqli_real_escape_string($connection,$password);
        $query = "SELECT randSalt FROM users";
        $select_randsalt_query=mysqli_query($connection,$query);


        if (!$select_randsalt_query){
            die("QUERY FAILED");
        }
        else {
            $row = mysqli_fetch_assoc($select_randsalt_query);
            $salt = $row['randSalt'];

            $password = crypt($password, $salt);

            $query = "INSERT INTO users (user_firstname,user_lastname,username,user_email,user_password,user_role) VALUES('{$firstname}','{$lastname}','{$username}','{$email}','{$password}','subscriber')";
            $register_user_query = mysqli_query($connection, $query);
            confirmQuery($register_user_query);
        }

}


function login_user($username, $password)
{
   global $connection;

   $username =trim($username);
   $password=trim($password);

    $username=mysqli_real_escape_string($connection,$username);
    $password=mysqli_real_escape_string($connection,$password);

    $query = "SELECT * FROM users WHERE username='{$username}'";
    $select_user_query = mysqli_query($connection,$query);
    if (!$select_user_query){
        echo "QUERY FAILED".mysqli_error($connection);
        die();
    }
    else
    {
        while ($row=mysqli_fetch_assoc($select_user_query)){

            $db_user_id=$row['user_id'];
            $db_username=$row['username'];
            $db_password=$row['user_password'];
            $db_user_firstname=$row['user_firstname'];
            $db_user_lastname=$row['user_lastname'];
            $db_user_role=$row['user_role'];
        }
        $password= crypt($password,$db_password);

        if ($username!== $db_username && $password!==$db_password){
            header("Location: ../index.php");
        }
        elseif ($username == $db_username && $password==$db_password){
            $_SESSION['username']=$db_username;
            $_SESSION['firstname']=$db_user_firstname;
            $_SESSION['lastname']= $db_user_lastname;
            $_SESSION['user_role']=$db_user_role;


            header("Location: ../admin");



        }
        else {
            header("Location: ../index.php");
        }


    }



}

?>
