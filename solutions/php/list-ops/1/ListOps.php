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

class ListOps
{
    public function append(array $list1, array $list2): array
    {
        $list1 = array_merge($list1, $list2);
        return $list1;
    }

    public function concat(array $list1, array ...$listn): array
    {
        $new_list = $list1;
        if (!empty($listn)) {
            foreach ($listn as $addl_array) {
                $new_list = array_merge($new_list, $addl_array);
            }
        }

        return $new_list;
    }

    /**
     * @param callable(mixed $item): bool $predicate
     */
    public function filter(callable $predicate, array $list): array
    {
        $new_list = [];
        foreach ($list as $item) {
            if ($predicate($item)) {
                $new_list[] = $item;
            }
        }
        return $new_list;
    }

    public function length(array $list): int
    {
        return count($list);
    }

    /**
     * @param callable(mixed $item): mixed $function
     */
    public function map(callable $function, array $list): array
    {
        return array_map($function, $list);
    }

    /**
     * @param callable(mixed $accumulator, mixed $item): mixed $function
     */
    public function foldl(callable $function, array $list, $accumulator)
    {
        $acc = $accumulator;
        foreach ($list as $item) {
            $acc = $function($acc, $item);
        }
        return $acc;
    }
    
    /**
     * @param callable(mixed $item, mixed $accumulator): mixed $function
     */
    public function foldr(callable $function, array $list, $accumulator)
    {
        $acc = $accumulator;
        for ($i = count($list) - 1; $i >= 0; $i--) {
            $acc = $function($acc, $list[$i]); // accumulator first, element second
        }
        return $acc;
    }

    public function reverse(array $list): array
    {
        return array_reverse($list);
    }
}
