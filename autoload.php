<?php

if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ );
}


// TODO - make this an actual autoloader!

//require_once "HiSoL-CS.class.php";
// require_once "tests/cs_test_traits.trait.php";

//require_once "handlers/Handler.php";
//require_once "handlers/CURLHandler.php";


// TODO Fix file structure for case sensitive OSes?
spl_autoload_register( function ( $class_name ) {
	$class_file = __DIR__ . '\\' . preg_replace( '/^Hisol\\\Transtats\\\/', '', $class_name ) . '.php';
	if ( file_exists( $class_file ) ) {
		include $class_file;
	} elseif ( file_exists( strtolower( $class_file ) ) ) {
		include strtolower( $class_file );
	}
}
);
