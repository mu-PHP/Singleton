<?php
/**
 * Created by PhpStorm.
 * User: andrew
 * Date: 30/01/2019
 * Time: 20:57
 */

namespace MuPHP\Singleton\Fixture;

class AutoConstructingSingleton extends TestSingleton
{
    protected static function autoConstruct(): TestSingleton
    {
        return new AutoConstructingSingleton();
    }
}
