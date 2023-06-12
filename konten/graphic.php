<?php

$user = "root";
$password = "";
$database = "user_db";

try {
    $pdo = new PDO("mysql:host=localhost;database=$database", $user, $password);
    // Set the PDO error mode to exception
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}   catch(PDOException $e){
    die("ERROR: Could not connect. " . $e->getMessage());
}

?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Getting Started with Chart JS with www.chartjs3.com</title>
    <style>
      * {
        margin: 0;
        padding: 0;
        font-family: sans-serif;
      }
      .chartMenu {
        width: 100vw;
        height: 40px;
        background: #fff;
        color: #blue;
      }
      .chartMenu p {
        padding: 10px;
        font-size: 20px;
        font-family: 'Poppins', sans-serif;
        text-align: center;
      }
      .chartCard {
        width: 100vw;
        height: calc(100vh - 40px);
        background: rgba(54, 162, 235, 0.2);
        display: flex;
        align-items: center;
        justify-content: center;
      }
      .chartBox {
        width: 700px;
        padding: 20px;
        border-radius: 20px;
        border: solid 3px rgba(54, 162, 235, 1);
        background: white;
      }
      .previous{
        background-color: #fff;
        color: black;
        text-align: center
      }
      a{
        text-decoration: none;
        display: inline-block;
        padding: 8px 16px;
      }
    </style>
  </head>
  <body>
    <div class="chartMenu">
      <p>GRAPHIC PARKIR MOTOR</p>
    </div>
    <div class="chartCard">
        <div class="chartBox">
            <input type="date" onchange="startDateFilter(this)" value="
            2023-06-01" min="2023-06-01" max="2023-06-31">
            <input type="date" onchange="endDateFilter(this)" value="
            2023-06-030" min="2023-06-01" max="2023-06-31">
            <canvas id="myChart"></canvas>
        </div>

        <div class="previous">
            <a href="admin_page.php" class="previous">&laquo; Previous</a>
        </div>
    </div>

    <?php
        try {
            $sql = "SELECT * FROM user_db.riwayat_parkir";
            $result = $pdo->query($sql);

            if($result->rowCount() >0) {
                while($row = $result->fetch()) {
                    $dateArray[] = $row["date"];
                    $platArray[] = $row["plat"];
                }

                unset($result);
              } else {
                echo 'No result in DB';
              }
            } catch(PDOException $e) {
                die("Error");
            } 
            unset($pdo);
            print_r($dateArray)
    ?>

    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/chart.js/dist/chart.umd.min.js"></script>
    
    <script src="https://cdn.jsdelivr.net/npm/chartjs-adapter-date-fns/dist/chartjs-adapter-date-fns.bundle.min.js"></script>
    
    <script>
        const dateArrayJS = <?php echo json_encode($dateArray); ?>;
    //console.log(dateArrayJS)
    
    const dateChartJS = dateArrayJS.map((day, index) => {
        let dayjs = new Date(day);
        return dayjs.setHours(0, 0, 0, 0);
    });

    // setup 
    const data = {
      labels: dateChartJS,
      datasets: [{
        label: 'Plat No. Motor',
        data: <?php echo json_encode($platArray); ?>,
        backgroundColor: [
          'rgba(255, 26, 104, 0.2)',
        ],
        borderColor: [
          'rgba(255, 26, 104, 1)',
        ],
        borderWidth: 1
      }]
    };

    // config 
    const config = {
      type: 'bar',
      data,
      options: {
        scales: {
            x : {
                min: '2023-06-01',
                max: '2023-06-31',
                type: 'time',
                time: {
                    unit: 'day'
                }
            },
          y: {
            beginAtZero: true
          }
        }
      }
    };

    // render init block
    const myChart = new Chart(
      document.getElementById('myChart'),
      config
    );

    function startDateFilter(date){
        const startDate = new Date(date.value); 
        console.log(startDate.setHours(0, 0, 0, 0));
        myChart.config.options.scales.x.min = startDate.setHours(0, 0, 0, 0);
        myChart.update();
    }

    function endDateFilter(date){
        const endDate = new Date(date.value); 
        console.log(endDate.setHours(0, 0, 0, 0));
        myChart.config.options.scales.x.max = endDate.setHours(0, 0, 0, 0);
        myChart.update();
    }

    </script>

  </body>
</html>