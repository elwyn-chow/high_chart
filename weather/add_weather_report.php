<?php 
/*
 * This PHP script adds a new record with fake random temperature data for 
 * the three cities on the day after the most recent record.
 */

//-----------------------------------------------------------------------------
/**
 * Gets string of day after the most recent record.
 * @param database handler	$db
 * @return string	date in yyyy-mm-dd format
 */

function get_next_date($db) {
	$query=<<<EOSQL
select date_add(report_date, INTERVAL 1 DAY) next_day
from weather_reports 
order by report_date DESC 
LIMIT 1
EOSQL;

        $statement = $db->prepare($query);
        $statement->bind_param('');
        $statement->execute();
        $result = $statement->get_result();
        $records = $result->fetch_all(MYSQLI_ASSOC);
	return $records[0]["next_day"];
}

//-----------------------------------------------------------------------------
/**
 * Stores record
 * @param database handler	$db	database handler
 * @param string		$city	city name
 * @param float			$min	minimum temperatory
 * @param float			$max	maximum temperatory
 * @param string		$date	date in yyyy-mm-dd format
 */
function store_record($db, $city, $min, $max, $date) {
	echo "City: $city<br>\n";
	echo "Min: $min<br>\n";
	echo "Max: $max<br>\n";
	echo "Date: $date<br>\n";
	echo "<hr>\n";

        $query=<<<EOSQL
INSERT INTO weather_reports VALUES (?, ?, ?, date(?))
EOSQL;

        $statement = $db->prepare($query);
        $statement->bind_param('sdds', $city, $min, $max, $date);
        $statement->execute();
}
//-----------------------------------------------------------------------------

$ini_array = parse_ini_file("weather.ini");
$cities = array("Melbourne", "Sydney", "Brisbane");

$db = new mysqli(
		$ini_array["host"],
		$ini_array["username"],
		$ini_array["password"],
		$ini_array["database"]
);

$next_date = get_next_date($db);
foreach ($cities as $city) {
	$min = rand(10, 30);
	$max = $min + rand(0,10);

	store_record($db, $city, $min, $max, $next_date);
}
echo "finished";
