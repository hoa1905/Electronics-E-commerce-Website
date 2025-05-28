<?php require './layouts/header.php' ?>

<?php
	$max_date = '30';
	$sql = "SELECT DATE_FORMAT(created_at, '%e-%m') as 'ngay', sum(total_price) as 'doanh_thu'
					FROM orders 
					WHERE DATE(created_at) >= CURDATE() - INTERVAL $max_date DAY
					GROUP BY DATE_FORMAT(created_at, '%e-%m')";
	$result = mysqli_query($conn, $sql);

	$arr = [];
	$today = date('d');
	if($today < $max_date){
		$get_day_last_month = $max_date - $today;
		$last_month = date('m', strtotime(" -1 month"));
		$last_month_date = date('Y-m-d', strtotime(" -1 month"));
		$max_day_last_month = (new DateTime($last_month_date))->format('t');
		$start_day_last_month = $max_day_last_month - $get_day_last_month;
		for($i = $start_day_last_month; $i <= $max_day_last_month; $i++){
			$key = $i . '-' . $last_month;
			$arr[$key] = 0;
		}
		$start_date_this_month = 1;
	} else{
		$start_date_this_month = $today - $max_date;

	}
	$this_month = date('m');
	for($i = $start_date_this_month; $i <= $today; $i++){
		$key = $i . '-' . $this_month;
		$arr[$key] = 0;
	}
	foreach($result as $each){
		$arr[$each['ngay']] = $each['doanh_thu'];
	}
	$arrX = array_keys($arr);
	$arrY = array_values($arr);
?>

<main>
	<div class="container-fluid px-4">
		<h1 class="mt-4">Thống kê doanh thu</h1>
	</div>	
	<div class="card mb-4" style="margin: 24px 24px">
		<div class="card-header">
				<i class="fas fa-chart-area me-1"></i>
				<?php echo "Thống kê doanh thu $max_date ngày gần nhất" ?>
		</div>
		<div class="card-body"><canvas id="myAreaChart" width="100%" height="30"></canvas></div>
		<div class="card-footer small text-muted">
			<?php
				$today = date('d/m/Y');
				echo "Hôm nay: $today";
			?>
		</div>
	</div>
</main>
<?php require './layouts/footer.php' ?>