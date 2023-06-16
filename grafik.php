<?php
include('function.php');
$country = mysqli_query($conn, "select * from stock");
while ($row = mysqli_fetch_array($country)) {
    $nama[] = $row['nama_barang'];
    $stok[] = $row['stock'];
    


}
?>
<!DOCTYPE html>
<html>

<head>
    <title>grafik bar stock</title>
    <script type="text/javascript" src="Chart.js"></script>
</head>

<body>
    <div style="">
        <canvas id="myChart"></canvas>
    </div>
    <script>
        var ctx = document.getElementById("myChart").getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: <?php echo json_encode($nama); ?>,
                datasets: [{
                    label: 'Total Case',
                    data: <?php echo json_encode($stok);

                    ?>,
                    backgroundColor: 'rgba(255, 99, 132, 0.2)',
                    borderColor: 'rgba(255,99,132,1)',
                    borderWidth: 1

                }]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                }
            }
        });
    </script>
</body>

</html>