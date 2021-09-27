<?php 
/*
 * This PHP script generates JSON data from the weather_reports table of the
 * highchart database.
 *
 * By default, it fetches the 7 most recent temperatures for each city in
 * the database.
 * Using the city parameter, only a single specified city's data is generated.
 *
 * The format of the JSON data is:
 * [
 * 	{
 * 		name: 'CityName1 (max)',
 *		data: [ temp1, temp2, temp3, temp4, temp5, temp6, temp7 ]
 * 	},
 * 	{
 * 		name: 'CityName1 (min)',
 *		data: [ temp1, temp2, temp3, temp4, temp5, temp6, temp7 ]
 * 	},
 * 	...
 * ]
 */

//-----------------------------------------------------------------------------
/**
 * Get array of max temperatures of most recent 7 days for a given city
 * @param database handler	$db		database handler
 * @param string		$city		name of the city
 * @param string		$max_or_min	"max" or "min" temperature
 * @return array				array of temperatures
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
/**
 * Append city's details to data array
 * @param database handler	$db	database handler
 * @param associative array	$data	associative array of data
 * @param string		$city	name of city
 */

function append_city_data($db, &$data, $city) {
	$data[] = array(
		"name" => $city . " (max)",
		"data" => get_temperatures($db, $city, 7, "max")
	);
	$data[] = array(
		"name" => $city . " (min)",
		"data" => get_temperatures($db, $city, 7, "min")
	);
}
//-----------------------------------------------------------------------------

$ini_array = parse_ini_file("weather.ini");
$city = $_GET["city"];

//TODO: Added some validation/sanitization of the variable $city
$data = array();

header('Content-Type: application/json; charset=utf-8');

$db = new mysqli(
		$ini_array["host"],
		$ini_array["username"],
		$ini_array["password"],
		$ini_array["database"]
);

if ( isset($city) ) {
	append_city_data($db, $data, $city);
} else {
	// No city is set: fetch records for all cities
	$result = $db->query("select distinct(city) from weather_reports");
	
	while($row = $result->fetch_row()) {
		$city = $row[0];

		append_city_data($db, $data, $city);
	}

}

echo json_encode($data);
