<?php

include 'db.php';
$output='';
if(isset($_POST['query'])) {
    $search = $_POST['query'];
    $stmt = $conn->prepare("SELECT * FROM diamonds WHERE diamond_lot_no LIKE 
    CONCAT('%',?,'%') ");
    $stmt->bind_param("ss", $search, $search);

}
else
    {
        $stmt=$conn->prepare("select *from diamonds");
    }
$stmt->execute();
$result=$stmt->get_result();
if($result->)
?>