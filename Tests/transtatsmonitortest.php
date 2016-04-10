<?php
/**
 * Class TranstatsMonitorTest
 *
 * @package Hisol\Transtats
 * @author  Graeme Hinchliffe <graeme@hisol.co.uk>
 */

namespace Hisol\Transtats\Tests;

use Hisol\Transtats\TranstatsMonitor;

/**
 * Class TranstatsMonitorTest
 */
class TranstatsMonitorTest extends \PHPUnit_Framework_TestCase
{
	/**
	 * Test that instance returns the same instance of the Transtats Monitor class
	 *
	 * @covers \Hisol\Transtats\TranstatsMonitor::instance
	 * @covers \Hisol\Transtats\TranstatsMonitor::__construct
	 */
	public function testInstance() {
		$instance = TranstatsMonitor::instance();
		$this->assertInstanceOf( '\Hisol\Transtats\TranstatsMonitor', $instance, 'Valid instance' );
		$this->assertSame( $instance, TranstatsMonitor::instance(), 'Singleton instance' );
	}

	/**
	 * Test the setting and getting of a timer value
	 *
	 * @covers \Hisol\Transtats\TranstatsMonitor::start_timer
	 * @covers \Hisol\Transtats\TranstatsMonitor::get_timer
	 * @covers \Hisol\Transtats\TranstatsMonitor::reset
	 */
	public function testStartingTimer() {
		$instance = TranstatsMonitor::instance();

		$timerval = $instance->start_timer( 'test_timer' );

		$this->assertSame( $timerval, $instance->get_timer( 'test_timer' ) );
		$this->assertFalse( $instance->get_timer( 'invalid_timer' ) );
		$instance->reset();
		$this->assertFalse( $instance->get_timer( 'test_timer' ) );
	}

	/**
	 * Test the functionality of the timers
	 *
	 * @covers \Hisol\Transtats\TranstatsMonitor::stop_timer
	 * @covers \Hisol\Transtats\TranstatsMonitor::start_timer
	 */
	public function testTimer() {
		$instance = TranstatsMonitor::instance();
		$instance->start_timer( '1sec' );
		$instance->start_timer( '2sec' );
		sleep( 1 );
		$this->assertGreaterThan( 1, $instance->stop_timer( '1sec' ) );
		$this->assertFalse( $instance->get_timer( '1sec' ) );
		sleep( 1 );
		$this->assertGreaterThan( 2, $instance->stop_timer( '2sec' ) );
	}

}
