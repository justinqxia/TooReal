<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>TooReal</title>
  <?php
  require 'assets/head.inc.php';
  ?>
  <script
    src="https://cdn.jsdelivr.net/npm/chartjs-adapter-date-fns/dist/chartjs-adapter-date-fns.bundle.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Darker+Grotesque:wght@400;700;900&display=swap" rel="stylesheet">
  <style>
    body {
      font-family: 'Darker Grotesque', sans-serif;
      font-size: 1.2rem;
    }
  </style>
</head>

<body>
  <?php
  require 'assets/navbar.inc.php';
  ?>
  <div>
    <main id="main" class="main">
      <div class="row mb-3">
        <div class="col text-center">
          <?php
          require 'backend/dbh.php';
          $sql1 = $conn->prepare("SELECT COUNT(1) FROM `images`");
          $sql1->execute();
          $sql1 = $sql1->get_result();
          $r1 = mysqli_fetch_assoc($sql1);
          $numRows = $r1["COUNT(1)"];

          $results_per_page = 5;
          $number_of_pages = ceil($numRows / $results_per_page);

          if (!isset($_GET['page']) || $_GET['page'] < 0) {
            $pageNum = 1;
          } else {
            $pageNum = $_GET['page'];
            if (!is_numeric($pageNum)) {
              $pageNum = 1;
            }
          }

          $this_page_first_result = ($pageNum - 1) * $results_per_page;

          if ($number_of_pages > 1) {
            for ($page = 1; $page <= $number_of_pages; $page++) {
              echo "<a href=?page=$page>Page $page&nbsp;&nbsp;</a>";
            }
          }
          $sql = "SELECT * FROM `images` 
          LEFT JOIN `users` ON images.userid = users.idUsers 
          ORDER BY `id` DESC 
          LIMIT " . $this_page_first_result . "," . $results_per_page;

          $result = $conn->query($sql);
          if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
              $date = date_create($row['timestamp']);
              $date = date_format($date, "m/d/Y H:i");

              echo "<br>" . $row['uidUsers'] . "&nbsp;&nbsp;" . $date . "<br><img src='" . $row["filepath"] . "' class='img-fluid' alt='Responsive image' style='max-width: 100%; height: auto;'><br>";
            }
          } else {
            echo "0 results";
          }
          ?>
        </div>
      </div>
  </div>
  <div class="modal" id="drinkModal">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
        </div>
      </div>
    </div>