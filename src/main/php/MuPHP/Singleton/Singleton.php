<?php
/**
 * Created by PhpStorm.
 * User: andrew
 * Date: 30/01/2019
 * Time: 18:20
 */

namespace MuPHP\Singleton;

/**
 * Singleton Trait
 *
 * This trait passes through all static method calls to a single instance of
 * the class.
 *
 * @package MuPHP\Singleton
 */
trait Singleton
{
    /**
     * @var array
     */
    private static $singletons = [];

    /**
     * @return self
     * @throws UninitializedSingletonException
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
            throw new UninitializedSingletonException('Singleton for `'
                . get_called_class() . '` not initialized!', $e);
        }
    }

    /**
     * Sets the instance of the Singleton
     *
     * @param self $instance
     */
    protected static function setInstance(self $instance): void
    {
        static::$singletons[get_called_class()] = $instance;
    }

    /**
     * Magic method for translating static methods to instance methods
     *
     * @param $name
     * @param $arguments
     * @return mixed
     * @throws UninitializedSingletonException
     */
    public static function __callStatic($name, $arguments)
    {
        $singleton = static::getInstance();
        return $singleton->$name(...$arguments);
    }

    /**
     * Called when
     *
     * @return Singleton
     * @throws UninitializedSingletonException
     */
    protected static function autoConstruct(): self
    {
        throw new UninitializedSingletonException('This singleton does'
            . ' not support auto-construction!');
    }
}
