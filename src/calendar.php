<!DOCTYPE html>
<html>
<head>
    <title>Calendar</title>
</head>
<body>
<a href="../index.html">Back</a>
<form method="post" role="form" action="calendar.php">
    <label for="year">Year: </label>
    <input type="text" name="year" id="year">
    <label for="month">Month: </label>
    <select name="month" id="month">
        <option selected value="1">1</option>
    <?php
        for($i = 2; $i <= 12; $i++) {
            echo "<option value=$i>$i</option>";
        }
    ?>
    </select>
    <input type="submit">
</form>
<?php
if(isset($_POST['year']) && isset($_POST['month'])) {
    $year = $_POST['year'];
    $month = $_POST['month'];
    $fromDate = DateTime::createFromFormat('Y:m:d', $year.':'.$month . ':'. 1);
    if($month === '12') {
        $month = '0';
        $year = intval($year) + 1;
    }
    $toDate = DateTime::createFromFormat('Y:m:d', $year . ':' . (intval($month) + 1) . ':' . 1);
    $interval = new DateInterval('P1D');
    $period = new DatePeriod($fromDate, $interval, $toDate);
    $headers = array('Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun');
    echo '<table border="3"><tr><th>' . implode('</th><th>', $headers) . '</th></tr><tr>';
    $index = 0;
    foreach($period as $dt) {
        while($dt->format('D') !== $headers[$index]) {
            echo '<td></td>';
            $index++;
        }
        echo '<td>' . $dt->format('d') . '</td>';
        $index++;
        if($index == 7) {
            echo '</tr><tr>';
            $index = 0;
        }
    }
    if($index != 7) {
        for(; $index < 7; $index++) {
            echo '<td></td>';
        }
        echo '</tr>';
    }
    echo'</table>';
}
?>
</body>
</html>
