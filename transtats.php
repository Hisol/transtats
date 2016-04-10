<?php
/*
Plugin Name: HiSoL TranStats
Plugin URI: comingsoon.com
Description: Wordpress transient statistic analysis tool
Version: 0.1
Author: Hinchliffe Solutions
Author URI: http://hinchliffesolutions.co.uk
License:

*/

namespace Hisol\Transtats;

defined( 'ABSPATH' ) or die( 'No script kiddies please!' );

if (is_admin()) {

}

add_action( 'get_transient', 'get_transient', 0, 1 );

function get_transient( $name ) {
	$instance = TranstatsMonitor::instance();
	$instance->start_timer( $name );
 // todo : make call to original code and check it's response.
	error_log( "GET TRANSIENT CALLED" );
}
