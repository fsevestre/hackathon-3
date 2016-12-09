<?php

namespace Hackathon3\Patatoche;
use Hackathon3\Patatoche\ConverterInterface;

class RomanToIntegerConverter implements ConverterInterface
{
    protected $romanInteger = array('I' => 1, 'V' => 5, 'X' => 10, 'L' => 50, 'C' => 100, 'D' => 500, 'M' => 1000);

    /**
     * Retourne la conversion d'une valeur romaine "élémentaire".
     * Par exemple 5 pour 'V', 10 pour 'X', etc.
     *
     * @param string $roman
     * @return string
     */
    protected function getRomanInteger($roman)
    {
        return $this->romanInteger[$roman];
    }

    /**
     * Convertit un chiffre romain donné en sa représentation décimale.
     *
     * @param string $roman
     * @return string
     */
    public function convert($roman)
    {
        $conv = array(
            array("letter" => 'I', "number" => 1),
            array("letter" => 'V', "number" => 5),
            array("letter" => 'X', "number" => 10),
            array("letter" => 'L', "number" => 50),
            array("letter" => 'C', "number" => 100),
            array("letter" => 'D', "number" => 500),
            array("letter" => 'M', "number" => 1000),
            array("letter" => 0, "number" => 0)
        );

        $arabic = 0;
        $state = 0;
        $len = strlen($roman);

        while ($len >= 0) {
            $i = 0;
            $sidx = $len;

            while ($conv[$i]['number'] > 0) {
                if (isset($roman[$sidx]) && strtoupper($roman[$sidx]) == $conv[$i]['letter']) {
                    if ($state > $conv[$i]['number']) {
                        $arabic -= $conv[$i]['number'];
                    } else {
                        $arabic += $conv[$i]['number'];
                        $state = $conv[$i]['number'];
                    }
                }

                $i++;
            }

            $len--;
        }

        return $arabic;
    }
}
