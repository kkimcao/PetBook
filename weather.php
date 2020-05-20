<?php 
	session_start();
	include 'config.php';
	//include 'header.php';
	require_once __DIR__ . '/vendor/autoload.php';
	//csv file from http://www.bom.gov.au/climate/data/
?>

	<?php
	use Google\Cloud\BigQuery\BigQueryClient;
use Google\Cloud\Core\ExponentialBackoff;
if( !function_exists('random_bytes') )
{
    function random_bytes($length = 6)
    {
        $characters = '0123456789';
        $characters_length = strlen($characters);
        $output = '';
        for ($i = 0; $i < $length; $i++)
            $output .= $characters[rand(0, $characters_length - 1)];

        return $output;
    }
}
$date = "2020-05-19";
if (isset($_POST["date"])) {
	$date = $_POST["date"];
	}

/** Uncomment and populate these variables in your code */
// $projectId = 'The Google project ID';
 $query = "SELECT Minimum_temperature____C_ as Minimum_Temperature FROM `petbook-2020.weather.melbourne_weather` where Date='".$date."'";

$bigQuery = new BigQueryClient([
    'projectId' => $projectId,
]);
$jobConfig = $bigQuery->query($query);
$job = $bigQuery->startQuery($jobConfig);

$backoff = new ExponentialBackoff(10);
$backoff->execute(function () use ($job) {

    $job->reload();
    if (!$job->isComplete()) {
        throw new Exception('Job has not yet completed', 500);
    }
});
$queryResults = $job->queryResults();
$weather = '';
$i = 0;
foreach ($queryResults as $row) {
    ++$i;
    foreach ($row as $column => $value) {
		$weather = $value;
    }
}
echo $weather. " °C <br>on ".$date;

	?>

