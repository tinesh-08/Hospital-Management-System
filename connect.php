<?php

$username = $_POST['username'];
$email = $_POST['email'];
$pasword = $_POST['pasword'];
$mobile = $_POST['mobile'];


if(!empty($username) || !empty($email) || !empty($pasword) || !empty($mobile))
{
    $host = "localhost";
    $dbusername = "root";
    $dbpassword = "";
    $dbname = "test";

    $conn=new mysqli($host, $dbusername, $dbpassword, $dbname);

    if(mysqli_connect_error())
    {
        die('Connect Error ('.mysqli_connect_errno() .') '. mysqli_connect_error());
    }
    else
    {
        $SELECT = "SELECT email From signup Where email = ? Limit 1";
        $INSERT = "INSERT INTO signup(username, email, pasword, mobile)values(?,?,?,?)";
        $stmt = $conn->prepare($SELECT);
        $stmt->bind_param("s",$email);
        $stmt->execute();
        $stmt->bind_result($email);
        $stmt->store_result();
        $rnum = $stmt->num_rows;
        if($rnum==0)
        {
            $stmt->close();
            $stmt = $conn->prepare($INSERT);
            $stmt->bind_param("sssi",$username ,$email ,$pasword ,$mobile);
            $stmt->execute();
        }
        $stmt->close();
        $conn->close();
    }
}
else
{
    echo "all fields are required";
    die();
}

?>
<?php require 'G1.html';?>