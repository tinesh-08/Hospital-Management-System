<?php

$username = $_POST['username'];
$email = $_POST['email'];
$mobile = $_POST['mobile'];
$gender = $_POST['Gender'];
$country = $_POST['country'];
$state = $_POST['state'];
$city = $_POST['city'];
$blood = $_POST['blood'];
$share = $_POST['share'];


if(!empty($username) || !empty($email) || !empty($gender) || !empty($mobile) || !empty($country) || !empty($state) || !empty($city) || !empty($blood) || !empty($share))
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
        $SELECT = "SELECT email From form Where email = ? Limit 1";
        $INSERT = "INSERT INTO form(username, email, mobile, Gender, country, state, city, blood, share)values(?,?,?,?,?,?,?,?,?)";
        $stmt = $conn->prepare($SELECT);
        $stmt->bind_param("s",$email);
        $stmt->execute();
        $stmt->bind_result($email);
        $stmt->store_result();
        $rnum = $stmt->num_rows;
        if($share=='on')
        {
            $share='Yes';
        }
        else
        {
            $share='No';
        }
        if($gender=='on')
        {
            $gender='Male';
        }
        else
        {
            $gender='Female';
        }
        if($rnum==0)
        {
            $stmt->close();
            $stmt = $conn->prepare($INSERT);
            $stmt->bind_param("ssissssss",$username ,$email ,$mobile ,$gender ,$country ,$state ,$city ,$blood ,$share);
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

<?php require 'G8.html';?>