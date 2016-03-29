<?php
/**
 * PluginName Exception
 *
 * @package PluginName
 * @subpackage Helpers
 *
 * @since 1.0.0
 */

namespace PluginName;

/**
 * The Exceptional Exception
 *
 * Used in the event of a serious error within
 * the PluginName system.
 *
 * @api
 *
 * @since 1.0.0
 */
final class Exception extends \Exception {
	/**
	 * The exception constructor, message required.
	 *
	 * @since 1.0.0
	 *
	 * @param string     $message  The error message.
	 * @param int        $code     Optional The error code.
	 * @param \Exception $previous Optional The previous exception in the chain.
	 */
    final public function __construct( $message, $code = 0, Exception $previous = null ) {
        parent::__construct( $message, $code, $previous );
    }

	/**
	 * Ouput a string representation of the exception.
	 *
	 * @since 1.0.0
	 *
	 * @return string The string representation.
	 */
    final public function __toString() {
	    // Begin the initial message
	    $message = __CLASS__ . ': ' . $this->message;

	    // Append the stack trace
	    $message .= "\nStack trace:\n" . $this->getTraceAsString();

	    return $message;
    }
}
