<?php

require_once('connection.php');

if ($_POST['form'] == "kisaan-form") {

    if ($_POST['operation'] == "insert") {


        // converting string to associative array 
        parse_str($_POST['data'], $orignal);
     

        // arranged variables for kisaan data 
        $name = $orignal['name'];
        $phone = $orignal['phone'];
        $date = $orignal['date'];
        $sid = $orignal['sid'];
        $bahi = $orignal['bahi'];
        $rakva = $orignal['rakva'];
        $tahseel = $orignal['tahseel'];
        $vitrank = $orignal['vitrank'];

        echo $name."<br>".$phone."<br>".$date."<br>".$sid."<br>".$bahi."<br>".$rakva."<br>".$tahseel."<br>".$vitrank;

        // inserting the kissan data into thier database
        $insert = "INSERT INTO kisaan VALUES ('$name','$date',$sid,$bahi,$phone,$rakva,'$tahseel','$vitrank')";
        echo $insert;
        $status = mysqli_query($connection, $insert);
        echo $status;
    }
}
