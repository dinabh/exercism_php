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


function encode(string $text): string
{
    $cipher = [
        'a'=>'z',
        'b'=>'y',
        'c'=>'x',
        'd'=>'w',
        'e'=>'v',
        'f'=>'u',
        'g'=>'t',
        'h'=>'s',
        'i'=>'r',
        'j'=>'q',
        'k'=>'p',
        'l'=>'o',
        'm'=>'n',
        'n'=>'m',
        'o'=>'l',
        'p'=>'k',
        'q'=>'j',
        'r'=>'i',
        's'=>'h',
        't'=>'g',
        'u'=>'f',
        'v'=>'e',
        'w'=>'d',
        'x'=>'c',
        'y'=>'b',
        'z'=>'a',
    ];
    $newWord = '';
    $letters = mb_str_split(strtolower($text), 1);
    foreach ($letters as $letter){
        if (in_array($letter, $cipher)){
            $newWord .= $cipher[$letter];
        }elseif(in_array($letter, [' ', '.', ','])) {
            continue;
        }else{
            $newWord .= $letter;
        }
    }

    if (strlen($newWord) > 5){
        $newWord = implode(' ', str_split($newWord, 5));
    }

    return $newWord;
}
