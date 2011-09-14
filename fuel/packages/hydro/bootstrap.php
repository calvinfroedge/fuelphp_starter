<?php
/**
 * Fuel
 *
 * Fuel is a fast, lightweight, community driven PHP5 framework.
 *
 * @package    Fuel
 * @subpackage Hydro
 * @version    1.0
 * @author     Fuel Development Team
 * @license    MIT License
 * @copyright  2010 - 2011 Fuel Development Team
 * @link       http://fuelphp.com
 */

Autoloader::add_core_namespace('Hydro');

Autoloader::add_classes(array(
	'Hydro\\Hydro'	=> __DIR__.'/classes/hydro.php',
));


/* End of file bootstrap.php */