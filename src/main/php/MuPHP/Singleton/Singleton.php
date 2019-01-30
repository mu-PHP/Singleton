<?php
/**
 * Created by PhpStorm.
 * User: andrew
 * Date: 30/01/2019
 * Time: 18:20
 */

namespace MuPHP\Singleton;

trait Singleton
{
    /**
     * @var array
     */
    private static $singletons = [];

    /**
     * @return self
     * @throws SingletonException
     */
    public static function getInstance(): self
    {
        if (array_key_exists(get_called_class(), static::$singletons)) {
            return static::$singletons[get_called_class()];
        }
        try {
            $singleton = static::autoConstruct();
            static::$singletons[get_called_class()] = $singleton;
            return $singleton;
        } catch (\Exception $e) {
            throw new SingletonException('Singleton for `' . get_called_class() . '` not initialized!', $e);
        }
    }

    /**
     * @param self $instance
     */
    protected static function setInstance(self $instance): void
    {
        static::$singletons[get_called_class()] = $instance;
    }

    /**
     * @param $name
     * @param $arguments
     * @return mixed
     * @throws SingletonException
     */
    public static function __callStatic($name, $arguments)
    {
        $singleton = static::getInstance();
        return $singleton->$name(...$arguments);
    }

    /**
     * @return Singleton
     * @throws SingletonException
     */
    protected static function autoConstruct(): self
    {
        throw new SingletonException('This singleton does not support auto-construction!');
    }
}
