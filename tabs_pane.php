<?php

include ('db.php');
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT diamond_lot_no,diamond_cert,diamond_size,diamond_meas1,diamond_meas2,diamond_meas3,diamond_status,
       shape.attribute_name as shape,lab.attribute_name as lab,clr.attribute_name as clr , cla.attribute_name as cla 
        From diamonds LEFT JOIN attributes as shape
        ON diamonds.diamond_shape_id = shape.attribute_id
        LEFT JOIN attributes as lab ON diamonds.diamond_lab_id = lab.attribute_id
        LEFT JOIN attributes as clr ON diamonds.diamond_clr_id = clr.attribute_id
        LEFT JOIN attributes as cla ON diamonds.diamond_cla_id = cla.attribute_id
        where diamond_status ='Available' and diamond_type = 'Certified'";
        

$result = $conn->query($sql);

$count=0;
$data=[];


?>


<?php if (mysqli_num_rows($result)>0):?>


<?php foreach($result as $row): ?>

<?php
    $data[$row['shape']][$count]['diamond_lot_no']=$row['diamond_lot_no'];
    $data[$row['shape']][$count]['diamond_cert']=$row['diamond_cert'];
    $data[$row['shape']][$count]['shape']=$row['shape'];
    $data[$row['shape']][$count]['lab']=$row['lab'];
    $data[$row['shape']][$count]['clr']=$row['clr'];
    $data[$row['shape']][$count]['cla']=$row['cla'];
    $data[$row['shape']][$count]['diamond_size']=round($row['diamond_size'],2);
    $data[$row['shape']][$count]['diamond_meas1']=round($row['diamond_meas1'],2);
    $data[$row['shape']][$count]['diamond_meas2']=round($row['diamond_meas2'],2);
    $data[$row['shape']][$count]['diamond_meas3']=round($row['diamond_meas3'],2);
    $data[$row['shape']][$count]['diamond_status']=$row['diamond_status'];

    $count++;
       
    ?>


<?php endforeach;?>


<?php endif;?>
<?php $lcounter=0;?>
<ul class="nav nav-tabs" id="myTab" role="tablist">
<?php foreach($data as $key=>$diamonds):?>
<?php $shpkeypane=md5($key);?>
<?php 
$active = ($lcounter++ == 0) ? 'active' :'';
?>
  <li class="nav-item">
    <a class="nav-link <?=$active?>" id="<?=$shpkeypane?>-tab" data-toggle="tab" href="#<?=$shpkeypane ?>" role="tab" aria-selected="true"><?=$key;?></a>
  </li>
 <?php 
 endforeach;
 ?> 
</ul>
<?php
$lcounter=0;
?>
<div class="tab-content" id="myTabContent">
<?php foreach($data as $key=>$diamonds):?>
<?php $shpkeypane=md5($key);?>
<?php 
$active = $lcounter == 0 ? 'active in' :'';
?>
  <div class="tab-pane fade <?=$active?>" id="<?=$shpkeypane ?>" role="tabpanel">
  <table  class="table table-striped table-info">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">diamond_lot_no</th>
                <th scope="col">diamond_cert</th>
                <th scope="col">shape</th>
                <th scope="col">lab</th>
                <th scope="col">clr</th>
                <th scope="col">cla</th>
                <th scope="col">diamond_size</th>
                <th scope="col">diamond_meas1</th>
                <th scope="col">diamond_meas2</th>
                <th scope="col">diamond_meas3</th>
                <th scope="col">diamond_status</th>
            </tr>
        </thead>
<tbody>
<?php 
$sr = 1;
?>
<?php foreach($diamonds as $key => $row):?>
                <tr>
                <td><?php echo $sr++;?></td>
                <td><?php echo $row['diamond_lot_no']; ?></td>
                <td><?php echo $row['diamond_cert']; ?></td>
                <td><?php echo $row['shape']; ?></td>
                <td><?php echo $row['lab']; ?></td>
                <td><?php echo $row['clr']; ?></td>
                <td><?php echo $row['cla']; ?></td>
                <td><?php echo round($row['diamond_size'],2); ?></td>
                <td><?php echo round($row['diamond_meas1'],2); ?></td>
                <td><?php echo round($row['diamond_meas2'],2); ?></td>
                <td><?php echo round($row['diamond_meas3'],2); ?></td>
                <td><?php echo $row['diamond_status']; ?></td>
                </tr>
<?php endforeach;?>
</tbody>
</table>
  </div>
  <?php 
  $lcounter++;
 endforeach;
 ?> 
</div>


<script>
$(document).readyu(function(){
$('.tab-pane').removeClass('show');
});
</script>