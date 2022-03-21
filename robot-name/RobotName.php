<?php

/*
 * By adding type hints and enabling strict type checking, code can become
 * easier to read, self-documenting and reduce the number of potential bugs.
 * By default, type declarations are non-strict, which means they will attempt
 * to change the original type to match the type specified by the
 * type-declaration.
 *
 * In other words, if you pass a string to a function requiring a float,
 * it will attempt to convert the string value to a float.
 *
 * To enable strict mode, a single declare directive must be placed at the top
 * of the file.
 * This means that the strictness of typing is configured on a per-file basis.
 * This directive not only affects the type declarations of parameters, but also
 * a function's return type.
 *
 * For more info review the Concept on strict type checking in the PHP track
 * <link>.
 *
 * To disable strict typing, comment out the directive below.
 */

declare(strict_types=1);

class Robot
{
    private string $name = '';
    private static $names = [];

    public function getName(): string
    {
        if (!$this->name){
            $this->name = $this->generateName();
        }
        return $this->name;
    }

    public function reset(): void
    {
        $this->name = '';
    }

    private function generateName():string
    {
        $new_name =  $this->generateRandomString().$this->generateRandomNumber();
        if (in_array($new_name, self::$names)){
            return $this->generateName();
        }
        self::$names[] = $new_name;
        return $new_name;
    }

    private function generateRandomString(): string
    {
        return substr(str_shuffle(str_repeat('ABCDEFGHIJKLMNOPQRSTUVWXYZ', 2 )),1,2);
    }

    private function generateRandomNumber(): string
    {
        return substr(str_shuffle(str_repeat('0123456789', 3 )),1,3);
    }
}
