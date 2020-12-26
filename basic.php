<html lang="en">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>

<div class="container">
  <h2>Diamonds Inventory</h2>
   <ul class="nav nav-pills">
   
    <li><a data-toggle="pill" href="#menu1">Status</a></li>
    <li><a data-toggle="pill" href="#menu2">Location</a></li>
    <li><a data-toggle="pill" href="#menu3">Certified</a></li>
  </ul>
  
  <div class="tab-content">
    
    <div id="menu1" class="tab-pane fade in active">
      <h3>Status</h3>
      <?php include('status.php');?>
    </div>
    <div id="menu2" class="tab-pane fade">
      <h3>Location</h3>
      <?php include('diamond.php');?>
    </div>
    <div id="menu3" class="tab-pane fade">
      <h3>Certified</h3>
      <?php include('index.php');?>
    </div>
  </div>
</div>

</body>
</html>