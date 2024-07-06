<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Graph</title>
  <link rel="stylesheet" href="../CSS/graph.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
  <?php 

include('../PHP/db.php'); // Assure-toi que le chemin est correct

if (isset($dbh)) {
    try {
        $sql = "SELECT * FROM logs";
        $stmt = $dbh->query($sql);
        $logs = $stmt->fetchAll();
        echo json_encode($logs);
    } catch (PDOException $e) {
        echo json_encode(['error' => $e->getMessage()]);
    }
} else {
    echo json_encode(['error' => 'Database connection failed.']);
}
  ?>

  <div class="aws-container">
    <div class="aws-content">
      <nav>
        <div class="col-md-6 col-xs-6 col-sm-6">
          <span data-btn-chart="log" class="aws-active">Log</span>
        </div>
        <div class="col-md-6 col-xs-6 col-sm-6">
          <span data-btn-chart="modification">Modification</span>
        </div>
      </nav>
      <div class="aws-chart">
        <canvas id="chartCanvas" height="100" width="400"></canvas>
      </div>
    </div>
    <div class="aws-details">
      <div class="col-md-6 col-xs-6 col-sm-6">
        <div class="aws-block-info">
          <h3><span>&nbsp;</span></h3>
          <h5><span>Total logs (30 days)</span></h5>
        </div>
      </div>
      <div class="col-md-6 col-xs-6 col-sm-6">
        <div class="aws-block-info">
          <h3><span>&nbsp;</span>%</h3>
          <h5><span>Growth vs previous 30 days</span></h5>
        </div>
      </div>
    </div>
    <div class="clearfix"></div>
    <div class="aws-tooltip">
      <span>&nbsp;</span>
      <span>&nbsp;</span>
    </div>
  </div>
  
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/accounting.js/0.4.1/accounting.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/underscore.js/1.13.1/underscore-min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
  <script src="/JS/graph.js"></script>
</body>
</html>
