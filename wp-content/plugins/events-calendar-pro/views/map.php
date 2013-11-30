<?php
/**
 * Map View Template
 * The wrapper template for map view.
 *
 * Override this template in your own theme by creating a file at [your-theme]/tribe-events/map.php
 *
 * @package TribeEventsCalendar
 * @since  3.0
 * @author Modern Tribe Inc.
 *
 */

if ( !defined('ABSPATH') ) { die('-1'); } ?>

<?php do_action( 'tribe_events_before_template' ); ?>

<!-- Google Map Container -->
<?php tribe_get_template_part( 'map/gmap-container' ) ?>

<!-- Tribe Bar -->
<?php tribe_get_template_part( 'modules/bar' ); ?>

<!-- Main Events Content -->
<?php tribe_get_template_part( 'map/content' ) ?>

<div class="tribe-clear"></div>

<?php do_action( 'tribe_events_after_template' ) ?>
