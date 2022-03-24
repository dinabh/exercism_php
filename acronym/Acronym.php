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

function acronym(string $text): string
{
    $acronym = '';
    $words = explode(' ', $text);

    if (count($words) <= 1){
        return '';
    }
    foreach ($words as $word){
        if (str_contains($word, ':')){
            $acronym = str_replace(':', '', $word);
            break;
        }
        $acronym .= mb_strtoupper(mb_substr($word, 0, 1, "UTF-8"));
        $letters = str_split($word, 1);
        foreach ($letters as $k => $letter) {
            if ($k !== 0 && ctype_upper($letter)) {
                $acronym .= $letter;
            }

            if ($letter === '-') {
                $acronym .= mb_strtoupper($letters[$k + 1]);
            }
        }

    }

    return $acronym;
}
