<?php
/**
 * Created by PhpStorm.
 * User: hadi
 * Date: 11/7/2017
 * Time: 16:34
 */

namespace SoftWorks\IranianIdNumber;

class IdNumberValidator
{
    /**
     * Hold National Code
     *
     * @var String
     */
    protected static $nationalCode;
    /**
     * Incorrect List
     *
     * @var String
     */
    protected static $notNationalCode = array(
        "1111111111",
        "2222222222",
        "3333333333",
        "4444444444",
        "5555555555",
        "6666666666",
        "7777777777",
        "8888888888",
        "9999999999",
        "0000000000");

    /**
     * Construct
     *
     * @param String $number Id number to be validated
     */
    public function __construct($number)
    {
        $this->nationlCode = $number;
    }

    /**
     * National Validation Code
     *
     *
     * @return bool
     */
    public function validate()
    {
        $this->nationalCode = trim($this->nationalCode);


        if($this->validNumber())
        {
            $melliCode = $this->nationalCode;

            $subMid = $this->subMidNumbers($melliCode, 10, 1);

            $getNum = 0;

            for($i = 1; $i < 10; $i++)
                $getNum += ($this->subMidNumbers($melliCode, $i, 1) * (11 - $i));

            $modulus = ($getNum % 11);

            if((($modulus < 2) && ($subMid == $modulus)) || (($modulus >= 2) && ($subMid == (11 - $modulus))))
                return true;
        }

        return false;
    }

    /**
     * Validate
     *
     *
     * @return bool
     */
    protected function validNumber()
    {
        $melliCode = $this->nationalCode;

        if((is_numeric($melliCode)) && (strlen($melliCode) == 10) && (strspn($melliCode, $melliCode[0]) != strlen($melliCode)))
            return true;

        return false;
    }

    /**
     * Get Portion of String Specified
     *
     *
     * @return int
     */
    protected function subMidNumbers($number, $start, $length)
    {
        $number = substr($number, ($start - 1), $length);

        return $number;
    }

}

?>
