<?php

namespace Hisol\Transtats;

/**
 * Class transtats_monitor
 *
 * @package Hisol\Transtats
 * @author  Graeme Hinchliffe <graeme@hisol.co.uk>
 */
class TranstatsMonitor
{
	/**
	 * Current instance of the TranstatsMonitor
	 *
	 * @var TranstatsMonitor|null instance.
	 */
	private static $instance = null;

	/**
	 * Array of transient timers that are running
	 *
	 * @var array
	 */
	private $active_timers;

	/**
	 * Array of complete timers
	 *
	 * @var array
	 */
	private $complete_timers;

	/**
	 * Get active instance of monitor
	 *
	 * @return TranstatsMonitor
	 */
	public static function instance() {
		if ( null === self::$instance ) {
			self::$instance = new static();
		}

		return self::$instance;
	}

	/**
	 * Transtats_monitor constructor.
	 */
	private function __construct() {

	}

	/**
	 * Start timer of a transient.  If it is already running, reset it to zero
	 *
	 * @param \string $name Name of transient we are tracking.
	 *
	 * @return float
	 */
	public function start_timer( $name ) {
		$this->active_timers[ $name ] = microtime( true );

		return $this->active_timers[ $name ];
	}

	/**
	 * Get the value of the timer specified
	 *
	 * @param \string $name Name of the transient.
	 *
	 * @return bool|mixed
	 */
	public function get_timer( $name ) {
		if ( isset( $this->active_timers[ $name ] ) )
		{
			return $this->active_timers[ $name ];
		}
		return false;
	}

	/**
	 * Stop the timer for a transient.  If it's not found return false otherwise true
	 *
	 * @param string $name Name of the transient we are tracking.
	 *
	 * @return float|bool
	 */
	public function stop_timer( $name ) {
		$stop_time = microtime( true );

		if ( isset( $this->active_timers[ $name ] ) ) {
			$start_time = $this->active_timers[ $name ];
			$this->complete_timers[ $name ] = array(
				'start' => $start_time,
				'stop'  => $stop_time,
			);

			unset( $this->active_timers[ $name ] );
			return $stop_time - $start_time;
		}
		return false;
	}

	/**
	 * Reset the monitor, erase all timers.
	 */
	public function reset() {
		$this->active_timers = array();
		$this->complete_timers = array();
	}
}
