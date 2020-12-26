<?php include_once('db.php'); ?>

<div class="tab-content container">
    <div>
        <nav class="nav nav-pills">
            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                <?php
            $shapes = "SELECT diamond_lot_no,diamond_cert,diamond_size,diamond_meas1,diamond_meas2,diamond_meas3,diamond_status,
       shape.attribute_name as shape,lab.attribute_name as lab,clr.attribute_name as Clr , cla.attribute_name as Cla 
        From diamonds LEFT JOIN attributes as shape
        ON diamonds.diamond_shape_id = shape.attribute_id
        LEFT JOIN attributes as lab ON diamonds.diamond_lab_id = lab.attribute_id
        LEFT JOIN attributes as clr ON diamonds.diamond_clr_id = clr.attribute_id
        LEFT JOIN attributes as cla ON diamonds.diamond_cla_id = cla.attribute_id
        where diamond_status ='Available' and diamond_type = 'Certified' GROUP BY shape";
            $result = mysqli_query($conn, $shapes);
            $counter=0;
            
            if (mysqli_num_rows($result) > 0) {
                foreach ($result as $shape) 
                
                {
                    $shpkey = 'tab-'.md5($shape['shape']);
                    ?>
                <li role="presentation">
                    <a class="nav-item nav-link <?php echo $counter==0 ? 'active' : '' ?> "
                        data-shape="<?php echo $shpkey ?>" selec id="tab-<?php echo $shpkey; ?>" data-toggle="tab"
                        href="#<?php echo $shpkey;?>" role="tab" aria-controls="nav-home"
                        aria-selected="true"><?php echo $shape['shape']; ?></a>
                </li>
                <?php 
                      $counter++;  
                    }
            } ?>
            </div>
        </nav>


    </div>

</div>


</div>