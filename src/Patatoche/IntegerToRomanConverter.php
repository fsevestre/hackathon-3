<?php

namespace Hackathon3\Patatoche;

use Hackathon3\Patatoche\ConverterInterface;

class IntegerToRomanConverter implements ConverterInterface
{
    private $hundreds = array('', 'C', 'CC', 'CCC', 'CD', 'D', 'DC', 'DCC', 'DCCC', 'CM');
    private $tens     = array('', 'X', 'XX', 'XXX', 'XL', 'L', 'LX', 'LXX', 'LXXX', 'XC');
    private $units    = array('', 'I', 'II', 'III', 'IV', 'V', 'VI', 'VII', 'VIII', 'IX');

    /**
     * Convertit un chiffre décimal donné en sa représentation romaine.
     *
     * @param string $number
     * @return string
     */
    public function convert($number)
    {
        $romanNumerals = array(
            'M' => 1000,
            'CM' => 900,
            'D' => 500,
            'CD' => 400,
            'C' => 100,
            'XC' => 90,
            'L' => 50,
            'XL' => 40,
            'X' => 10,
            'IX' => 9,
            'V' => 5,
            'IV' => 4,
            'I' => 1
        );

        $res = '';
        foreach ($romanNumerals as $roman => $n) {
            $res .= str_repeat($roman, $number / $n);

            $number = $number % $n;
        }

        return $res;
    }
}
