<?php

/*
 * Timezone functions
*/

$timezones = [];

// Create an array of time zones
add_action('init', 'realgh_create_timezone_arr');
function realgh_create_timezone_arr() {
	global $timezones;
	$timezone_list = DateTimeZone::listIdentifiers();

	foreach ($timezone_list as $timezone){
		[$continent, $city] = explode('/', $timezone);
		if (!$city) {
			$timezones[] = array(
				'timezone' 	=> $timezone,
				'offset' 	=> 0,
				'string'		=> "(UTC+00:00) $timezone"
			);
			continue;
		}

		$time = new DateTime('now', new DateTimeZone($timezone));
		$offset_min = $time->getOffset() / 60;
		$sign = $offset_min >= 0 ? '+' : '-';
		$hours = sprintf('%02d', intdiv(abs($offset_min), 60));
		$mins = sprintf('%02d', abs($offset_min) % 60);

		$timezones[] = array(
			'timezone' 	=> $timezone,
			'offset' 	=> $offset_min,
			'string'		=> "(UTC$sign$hours:$mins) $timezone"
		);
	}
	
	usort($timezones, function($a, $b) {
		return [$a['offset'], $a['timezone']] <=> [$b['offset'], $b['timezone']];
	});
}



function realgh_get_timezones($format = 'str', $default = NULL) {
	global $timezones;
	$options = '';

	foreach ($timezones as $timezone) {
		$value = $format == 'num' ? $timezone['offset'] : $timezone['timezone'];
		$is_checked = $default && $default == $timezone['timezone'] ? 'selected' : '';
		$options .= <<<HTML
			<option value="$value" $is_checked>
				{$timezone['string']}
			</option>
		HTML;
	}

	return $options;
}




// function realgh_create_timezone_arr() {
// 	$timezone_arr = [];
// 	$cur_continent = '';
// 	$i = -1;

// 	$timezone_list = DateTimeZone::listIdentifiers();

// 	foreach ($timezone_list as $timezone){
// 		$time = new DateTime('now', new DateTimeZone($timezone));
// 		$offset_min = $time->getOffset() / 60;
// 		[$continent, $city] = explode('/', $timezone);

// 		if (!$city) continue;

// 		if (!$cur_continent || $cur_continent != $continent) {
// 			$cur_continent = $continent;
// 			$i++;
// 		}

// 		$key = array_search($offset_min, array_column($timezone_arr[$i], 'offset'));

// 		if (empty($timezone_arr[$i]) || $key === false) {

// 			$sign = $offset_min >= 0 ? '+' : '-';
// 			$hours = intdiv($offset_min, 60);
// 			$mins = $offset_min % 60;

			
// 			$timezone_arr[$i][] = array(
// 				'offset' => $offset_min,
// 				'string' => "<strong>(UTC$sign$hours:$mins)</strong> $city"
// 			);
// 		}
// 		else {
// 			$timezone_arr[$i][$key]['string'] .= ", $city";
// 		}
// 	}
// echo '<pre>';
// 	var_dump($timezone_arr);
// echo '</pre>';
// }