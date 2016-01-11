<?php
/* ----------------------------------------------------------------------------
 * Easy!Appointments - WordPress Plugin
 *
 * @license GPLv3
 * @copyright A.Tselegidis (C) 2016
 * @link http://easyappointments.org
 * @since v1.0.0
 * ---------------------------------------------------------------------------- */

require_once __DIR__ . '/bootstrap.php';

use \EAWP\Core\Plugin;

class PluginTest extends PHPUnit_Framework_TestCase {
    // ------------------------------------------------------------------------
    // TEST OBJECT INSTANTIATION
    // ------------------------------------------------------------------------

    public function testObjectInstantiation() {
        $wpdb = $this->getMock('wpdb');
        $route = $this->getMock('EAWP\Core\Route');
        $plugin = new Plugin($wpdb, $route);
        $this->assertInstanceOf('EAWP\Core\Plugin', $plugin);
    }

    // ------------------------------------------------------------------------
    // TEST INITIALIZE METHOD
    // ------------------------------------------------------------------------

    public function testInitializeMustRegisterTheRequiredRoutes() {
        $wpdb = $this->getMock('wpdb');
        $route = $this->getMock('EAWP\Core\Route');

        $route->expects($this->at(0))->method('action')->with(
                $this->equalTo('plugins_loaded'),
                $this->anything());


        $route->expects($this->at(1))->method('ajax')->with(
                $this->equalTo('install'),
                $this->anything());

        $route->expects($this->at(2))->method('ajax')->with(
                $this->equalTo('bridge'),
                $this->anything());

        $route->expects($this->at(3))->method('shortcode')->with(
                $this->equalTo('easyappointments'),
                $this->anything());

        $plugin = new Plugin($wpdb, $route);
        $plugin->initialize();
    }

    // ------------------------------------------------------------------------
    // TEST GET DATABASE METHOD
    // ------------------------------------------------------------------------

    public function testGetDatabaseMustReturnTheWpDatabaseObject() {
        $wpdb = $this->getMock('wpdb');
        $route = $this->getMock('EAWP\Core\Route');
        $plugin = new Plugin($wpdb, $route);
        $this->assertSame($wpdb, $plugin->getDatabase());
    }
}
