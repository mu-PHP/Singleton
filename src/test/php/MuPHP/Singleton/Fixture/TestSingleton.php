<?php
/**
 * Created by PhpStorm.
 * User: andrew
 * Date: 30/01/2019
 * Time: 18:36
 */

namespace MuPHP\Singleton\Fixture;

use MuPHP\Singleton\Singleton;

class TestSingleton
{
    use Singleton;

    public static function setup()
    {
        static::setInstance(new TestSingleton());
    }

    public function returnTrue()
    {
        return true;
    }
}
