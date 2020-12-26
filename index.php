<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Certified Diamond</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
        integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"
        integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous">
    </script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
</head>

<body>
    <div align="center">
        <h1>Certified Diamond</h1>
    </div>
    <div class="row">
        <div class="col-md-12" align="right">
            <input type="search" id="search_filter" class="light-table-filter" data-table="table-info"
                placeholder="Filter/Search">
        </div>


        <?php


include ('db.php');
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT diamond_lot_no,diamond_cert,diamond_size,diamond_meas1,diamond_meas2,diamond_meas3,diamond_status,
       shape.attribute_name as shape,lab.attribute_name as lab,clr.attribute_name as Clr , cla.attribute_name as Cla 
        From diamonds LEFT JOIN attributes as shape
        ON diamonds.diamond_shape_id = shape.attribute_id
        LEFT JOIN attributes as lab ON diamonds.diamond_lab_id = lab.attribute_id
        LEFT JOIN attributes as clr ON diamonds.diamond_clr_id = clr.attribute_id
        LEFT JOIN attributes as cla ON diamonds.diamond_cla_id = cla.attribute_id
        where diamond_status ='Available' and diamond_type = 'Certified' 
        GROUP BY shape.attribute_name";

$result = $conn->query($sql);

    $count=1;
   // if ($result->num_rows > 0) {
    // output data of each row
    ?>
        <!-- <ul class="nav nav-tabs"> -->

        <div id="selection" class="col-md-12" align="right">
            <label>Select Diamond Shape</label>
            <select name='user' class='filterElements' data-cell-to-filter="c3" id="shape_filter">
                <?php
    while($row = $result->fetch_assoc()) { ?>

                <option value="<?php echo $row['shape']; ?>"> <?php echo $row['shape']; ?></option>

                <?php }
    
    ?>
            </select>

        </div>

    

         <?php include('tabs_pane.php');?>
       

    <?php

include ('db.php');
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT diamond_lot_no,diamond_cert,diamond_size,diamond_meas1,diamond_meas2,diamond_meas3,diamond_status,
       shape.attribute_name as shape,lab.attribute_name as lab,clr.attribute_name as Clr , cla.attribute_name as Cla 
        From diamonds LEFT JOIN attributes as shape
        ON diamonds.diamond_shape_id = shape.attribute_id
        LEFT JOIN attributes as lab ON diamonds.diamond_lab_id = lab.attribute_id
        LEFT JOIN attributes as clr ON diamonds.diamond_clr_id = clr.attribute_id
        LEFT JOIN attributes as cla ON diamonds.diamond_cla_id = cla.attribute_id
        where diamond_status ='Available' and diamond_type = 'Certified'";

$result = $conn->query($sql);


?>

    <table class="table table-bordered table-info table table table-bordered table-hover " id="myTable"
        class="table table-bordered table-hover">
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
        <tbody id="table"><?php
    $count=1;
    if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) { ?>
            <tr ng-repeat="x in data">

                <td scope="row"><?php echo $count++;?></td>
                <td scope="col"><?php echo $row['diamond_lot_no']; ?></td>
                <td scope="col"><?php echo $row['diamond_cert']; ?></td>
                <td scope="col"><?php echo $row['shape']; ?></td>
                <td scope="col"><?php echo $row['lab']; ?></td>
                <td scope="col"><?php echo $row['Clr']; ?></td>
                <td scope="col"><?php echo $row['Cla']; ?></td>
                <td scope="col"><?php echo round($row['diamond_size'],2); ?></td>
                <td scope="col"><?php echo round($row['diamond_meas1'],2); ?></td>
                <td scope="col"><?php echo round($row['diamond_meas2'],2); ?></td>
                <td scope="col"><?php echo round($row['diamond_meas3'],2); ?></td>
                <td scope="col"><?php echo $row['diamond_status']; ?></td>

            </tr>
            <?php }
    }
    ?>
        </tbody>
    </table>

<?php include('diamond.php')?>
<?php include('status.php')?>



    <script>
    function myFunction() {

        var input, filter, table, tr, td, i, txtValue;
        input = document.getElementById("myInput");
        filter = input.value.toUpperCase();
        table = document.getElementById("myTable");
        tr = table.getElementsByTagName("tr");
        for (i = 0; i < tr.length; i++) {
            td = tr[i].getElementsByTagName("td")[0];
            if (td) {
                txtValue = td.textContent || td.innerText;
                if (txtValue.toUpperCase().indexOf(filter) > -1) {
                    tr[i].style.display = "";
                } else {
                    tr[i].style.display = "none";
                }
            }
        }
    }
    </script>
    <script>
    $(document).ready(function() {
        // $(".nav-tabs a").click(function() {
        //     $(this).tab('show');
        // });
        // $('.nav-tabs a').on('shown.bs.tab', function(event) {
        //     var x = $(event.target).text(); // active tab
        //     var y = $(event.relatedTarget).text(); // previous tab
        //     $(".act span").text(x);
        //     $(".prev span").text(y);
        // });
    });
    </script>

    <script type="text/javascript">
    (function(document) {
        'use strict';

        var TableFilter = (function(Arr) {

            var _input;

            function _onInputEvent(e) {
                _input = e.target;
                var tables = document.getElementsByClassName(_input.getAttribute('data-table'));
                Arr.forEach.call(tables, function(table) {
                    Arr.forEach.call(table.tBodies, function(tbody) {
                        Arr.forEach.call(tbody.rows, _filter);
                    });
                });
            }

            function _filter(row) {
                var text = row.textContent.toLowerCase(),
                    val = _input.value.toLowerCase();
                row.style.display = text.indexOf(val) === -1 ? 'none' : 'table-row';
            }

            return {
                init: function() {
                    var inputs = document.getElementsByClassName('light-table-filter');
                    Arr.forEach.call(inputs, function(input) {
                        input.oninput = _onInputEvent;
                    });
                }
            };
        })(Array.prototype);

        document.addEventListener('readystatechange', function() {
            if (document.readyState === 'complete') {
                TableFilter.init();
            }
        });

    })(document);
    </script>

    <script type="text/javascript">
    $(function() {

        $('#table').filterRowsByValue($('.filterElements'));
        $('.tabwisedata').on('click', function() {
            let shape = $(this).attr('data-shape');
            $('#shape_filter').val(shape);
            $('#shape_filter').trigger('change');
        });

        // $('.filterElements').change(); // uncomment to start with blank table
    });


    jQuery.fn.filterRowsByValue = function(masterSelects) {
        return this.each(function() {
            var table = this;
            var rows = [];
            $(table).find('tr').each(function() {
                var cells = {};
                $(this).find('td').each(function(i, e) {
                    cells['c' + i] = $(this).html();
                });
                rows.push(cells);
            });
            $(table).data('tr', rows);

            masterSelects.bind('change', function() {
                var cur = this;
                masterSelects.each(function(i, e) {
                    if (e != cur) {
                        $(e).val("0");
                    }
                });
                var rows = $(table).empty().scrollTop(0).data('tr');

                var search = '^' + $.trim($(this).val()) + '$';
                var regex = new RegExp(search, 'gi');
                var cel = $(this).data("cell-to-filter");
                $.each(rows, function(i, e) {
                    var row = rows[i];
                    if (row[cel].match(regex) !== null) {
                        var cellArr = [];
                        for (var curCell in row) {
                            if (row.hasOwnProperty(cel)) {
                                cellArr.push('<td>' + row[curCell] + '</td>');
                            }
                        }
                        $(table).append('<tr>' + cellArr.join('') + '</tr>');
                    }
                });
            });

        });
    };
    </script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>



</body>

</html>