<?php
/**
 * Created by PhpStorm.
 * User: andrew
 * Date: 30/01/2019
 * Time: 18:22
 */

namespace MuPHP\Singleton;

use Throwable;

/**
 * Class SingletonException
 *
 * @package MuPHP\Singleton
 */
class UninitializedSingletonException extends \Exception
{
    public function __construct($message = "", Throwable $previous = null)
    {
        parent::__construct($message, 0, $previous);
    }
}
