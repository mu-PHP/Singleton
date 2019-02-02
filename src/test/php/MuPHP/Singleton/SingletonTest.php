<?php
/**
 * Created by PhpStorm.
 * User: andrew
 * Date: 30/01/2019
 * Time: 18:34
 */

namespace MuPHP\Singleton;

use MuPHP\Singleton\Fixture\AutoConstructingSingleton;
use MuPHP\Singleton\Fixture\TestSingleton;
use MuPHP\Singleton\Fixture\UninitializedSingleton;
use PHPUnit\Framework\TestCase;

class SingletonTest extends TestCase
{
    /**
     * @expectedException MuPHP\Singleton\UninitializedSingletonException
     */
    public function testUninitializedSingleton()
    {
        UninitializedSingleton::getInstance();
    }

    public function testInitializedSingleton()
    {
        TestSingleton::setup();
        $this->assertInstanceOf(
            'MuPHP\Singleton\Fixture\TestSingleton',
            TestSingleton::getInstance()
        );
    }

    public function testStaticPassthrough()
    {
        TestSingleton::setup();
        $this->assertTrue(TestSingleton::returnTrue());
    }

    public function testAutoConstructor()
    {
        $this->assertTrue(AutoConstructingSingleton::returnTrue());
    }
}
