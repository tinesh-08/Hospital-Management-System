<?php

$blood = $_POST['blood'];
$country = $_POST['country'];
$state = $_POST['state'];
$city = $_POST['city'];


if(!empty($country) || !empty($state) || !empty($city) || !empty($blood) )
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
        $sql = "SELECT username, email, mobile, blood FROM form";
        $res = $conn->query($sql);
        
        if($res->num_rows > 0)
        {
            require 'G10.html';
            $i=1;
            echo "<br>";
            echo "<br>";
            echo "<br>";
            echo "<br>";
            while($row = $res->fetch_assoc())
            {
                if($row["blood"]==$blood)
                {
                    $a=$row["username"];
                    $b=$row["email"];
                    $c=$row["mobile"];
                    echo "<p style='margin-left:500px;margin-top:0px;position:relative;'>"."<br>$i)&nbsp;&nbsp"."Name: ".$a."</p>";
                    echo "<p style='margin-left:530px;margin-top:0px;position:relative;'>"."Email: ".$b."</p>";
                    echo "<p style='margin-left:530px;margin-top:0px;position:relative;'>"."Mobile Number: ".$c."</p>";
                    $i++;
                }
            }
        }
        $conn->close();
    }
}
else
{
    echo "all fields are required";
    die();
}

?>
