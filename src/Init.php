<?php


namespace ACP;

if ( ! class_exists( 'Init' ) ) {
	final class Init {
		/**
		 * Store all the classes inside an array
		 *
		 * @return array Full list of classes
		 */
		public static function get_services() {
			return [
				Base\CustomPostTypes::class,
				Base\Enqueue::class,
				Base\SettingsLink::class,
				Pages\Admin::class
			];
		}

		/**
		 * Loop through the classes, initialize them, and call the register() method if exists.
		 *
		 * @return
		 */
		public static function register_services() {
			foreach ( self::get_services() as $class ) {
				$service = self::instantiate( $class );
				if ( method_exists( $service, 'register' ) ) {
					$service->register();
				}
			}
		}

		/**
		 * Initialize the class
		 *
		 * @param class $class class from the service array
		 *
		 * @return class instance   new instance of the class
		 */

		private static function instantiate( $class ) {
			$service = new $class();

			return $service;
		}
	}
}

