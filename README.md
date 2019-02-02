# Singleton

This is an small library for easily implementing singleton functionality. It
provides a trait that essentially turns any class that includes it into a 
static class.

### Why?

Testing static classes is extremely difficult, and if for whatever reason you
want a differently-configured instance, you have to re-implement it as an
instantiable class.

### Usage

Below is a sample class using the Singleton trait:

```php
class UtilityClass()
{
    use Singleton;

    public function utilityMethod(): void
    {
        echo 'Hello, world!';
    }
    
    protected static function autoConstruct(): UtilityClass
    {
        return new UtilityClass();
    }
}
```

You can either invoke this class as an instance or a static class:

```php
$utilityClass = new UtilityClass();
$utilityClass->utilityMethod();

UtilityClass::utilityMethod();
```

By default, trying to use a `Singleton` before it has been initialized will 
throw an `UninitializedSingletonException`. You will need to implement a method 
to initialize your Singleton using `::setInstance()` before calling it. You can
also retrieve the current instance using `::getInstance()`. 

If you implement the `::autoConstruct` method, you can define a default
constructor that will be used if no instance of your singleton currently exists.

```php
class UtilityClass()
{
    use Singleton;

    public function utilityMethod(): void
    {
        echo 'Hello, world!';
    }
    
    public static function setup(): void
    {
        static::setInstance(new UtilityClass());
    }
}

UtilityClass::setup();
UtilityClass::utilityMethod();
UtilityClass::getInstance()->utilityMethod();
```