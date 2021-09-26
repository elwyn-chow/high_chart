<?php 

//-----------------------------------------------------------------------------
/**
 * Get array of max temperatures of most recent 7 days for a given city
 */
function get_temperatures($db, $city, $days, $max_or_min) {
	$temperatures = array();

	$query=<<<EOSQL
select max, min from (
	select * from weather_reports 
	WHERE city = ? 
	ORDER by report_date 
	DESC LIMIT ?) sub 
order by report_date ASC
EOSQL;

	$statement = $db->prepare($query);
	$statement->bind_param('si', $city, $days);
	$statement->execute();
	$result = $statement->get_result();
	$records = $result->fetch_all(MYSQLI_ASSOC);
	foreach ($records as $record) {
		$temperatures[] = $record[$max_or_min];
	}
	return $temperatures;
}
//-----------------------------------------------------------------------------

$ini_array = parse_ini_file("weather.ini");
$data = array();

header('Content-Type: application/json; charset=utf-8');

$db = new mysqli(
		$ini_array["host"],
		$ini_array["username"],
		$ini_array["password"],
		$ini_array["database"]
);

$result = $db->query("select distinct(city) from weather_reports");

while($row = $result->fetch_row()) {
	$city = $row[0];

	$data[] = array(
		"name" => $city . " (max)",
		"data" => get_temperatures($db, $city, 7, "max")
	);
	$data[] = array(
		"name" => $city . " (min)",
		"data" => get_temperatures($db, $city, 7, "min")
	);
}

echo json_encode($data);
