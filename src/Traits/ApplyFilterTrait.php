<?php

namespace Alablaster\Foreman\Traits;

use Illuminate\Support\Str;

trait ApplyFilterTrait
{

    private function applyFilter($filter, $string): ?string
    {

        // TODO: This could be refactored into a pipeline
        // which is defined in a config, allowing it to more
        // easily be extended.

        switch($filter) {
            case 'trailingBackSlash':
                return $string ? $string . '\\' : null;
            case 'leadingBackSlash':
                return $string ? '\\' . $string : null;
            case 'leadingForwardSlash':
                return $string ? '/' . $string : null;
            case 'trailingForwardSlash':
                return $string ? $string . '/' : null;
            case 'trailingDot':
                return $string ? $string . '.' : null;
            case 'leadingDot':
                return $string ? '.' . $string : null;
            case 'dot':
                return $string ? $this->dot($string) : null;
            default:
                return Str::$filter($string);
        }
    }

    private function dot($string)
    {
        $words = $this->breakApartWords($string);

        return implode('.', $words);
    }

    private function breakApartWords($string)
    {
        return preg_split('/\\\\|\//', $string);
    }

}
