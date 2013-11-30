<?php

add_filter('tribe_get_events_title', 'change_upcoming_events_title');

function change_upcoming_events_title($title) {
// remove first two words "Veranstaltungen in"
	$string = explode (' ', $title, 3);
	$string = $string[2];  
	return($string);
}