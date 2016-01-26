<?php
/**
 * Created by PhpStorm.
 * User: Glenn
 * Date: 2016-01-26
 * Time: 10:51 AM
 */

namespace Geggleto;

/**
 * Class Session
 *
 * Wrapper around _SESSION with simple flash messages
 *
 * @package Geggleto
 *
 */
class Session implements \ArrayAccess
{
    public function __construct() {
        if (!isset($_SESSION)) {
            // If we are run from the command line interface then we do not care
            // about headers sent using the session_start.
            if (PHP_SAPI === 'cli') {
                $_SESSION = [];
            }
        }

        $_SESSION['flash'] = isset($_SESSION['flashPrevious']) ?:[];

    }

    public function __destruct() {
        unset($_SESSION['flash']);
    }

    /**
     * @param $name
     * @param $value
     */
    public function flash($name, $value) {
        $_SESSION['flashPrevious'][$name] = $value;
    }

    /**
     * @param $name
     * @return mixed|null
     */
    public function getFlash($name) {
        if ( isset($_SESSION['flashPrevious'][$name])) {
            return $_SESSION['flashPrevious'][$name];
        }
        return null;
    }


    /**
     * Whether a offset exists
     *
     * @link http://php.net/manual/en/arrayaccess.offsetexists.php
     * @param mixed $offset <p>
     * An offset to check for.
     * </p>
     * @return boolean true on success or false on failure.
     * </p>
     * <p>
     * The return value will be casted to boolean if non-boolean was returned.
     * @since 5.0.0
     */
    public function offsetExists ($offset) {
        return isset($_SESSION[$offset]);
    }

    /**
     * Offset to retrieve
     *
     * @link http://php.net/manual/en/arrayaccess.offsetget.php
     * @param mixed $offset <p>
     * The offset to retrieve.
     * </p>
     * @return mixed Can return all value types.
     * @since 5.0.0
     */
    public function offsetGet ($offset) {
        return $_SESSION[$offset];
    }

    /**
     * Offset to set
     *
     * @link http://php.net/manual/en/arrayaccess.offsetset.php
     * @param mixed $offset <p>
     * The offset to assign the value to.
     * </p>
     * @param mixed $value <p>
     * The value to set.
     * </p>
     * @return void
     * @since 5.0.0
     */
    public function offsetSet ($offset, $value) {
        $_SESSION[$offset] = $value;
    }

    /**
     * Offset to unset
     *
     * @link http://php.net/manual/en/arrayaccess.offsetunset.php
     * @param mixed $offset <p>
     * The offset to unset.
     * </p>
     * @return void
     * @since 5.0.0
     */
    public function offsetUnset ($offset) {
        $_SESSION[$offset] = null;
        unset($_SESSION[$offset]);
    }

}

