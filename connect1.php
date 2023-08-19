<?php

$uname = $_POST['uname'];
$upas = $_POST['upas'];

if(!empty($uname) and !empty($upas))
{
    $host = "localhost";
    $dbusername = "root";
    $dbpassword = "";
    $dbname = "test";

    $conn=new mysqli($host, $dbusername, $dbpassword, $dbname);

    $sql = "SELECT username, pasword FROM signup";
    $res = $conn->query($sql);

    $a = 0;

    if($res->num_rows > 0)
    {

        while($row = $res->fetch_assoc())
        {
            if(($uname==$row["username"]) and ($upas==$row["pasword"]))
            {
                $a = 1;
            }
        }
        if($a==1)
        {
            require 'G4.html';
        }
        else
        {
            require 'G5.html';
        }
    }

    $conn->close();
}

?>
