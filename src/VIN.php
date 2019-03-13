<?php

namespace BinaryxDev\vin;

use BinaryxDev\vin\Fn;

class VIN
{

    protected $vin = null;
    protected $fn = null;
    protected $result = null;

    public function __construct($vin){
        $fn = new Fn();
        $this->fn = $fn;
        $this->vin = $vin;
        $details = $this->fragment();
        
        $result = [
            "check" => $details->check,
            "vds" => $details->vds,
            "vis" => $details->vis,
            "wmi" => $details->identifier,

            "continent" => $fn->getContinents($details->continent),
            "countries" => $fn->getCountries($details->country),
                        
            "modelYear" => $fn->getYears($details->year),
            "manufacture" => $fn->getManufacture($details->manufacture),
            "sequentialNumber" => $details->sequential
        ];
        $this->result = $result;
    }

    public function getDetails(){
        return $this->result;
    }

    public function fragment(){
        $vin = $this->vin;

        $fragment = [
            "identifier" => substr($vin, 0, 3),
            "vds" => substr($vin, 3, 6),
            "vis" => substr($vin, 9, 8),

            "continent" => substr($vin, 0, 1),
            "country" => substr($vin, 0, 2),

            "attributes" => substr($vin, 3, 4),
            "check" => substr($vin, 8, 1),
        
            "year" => substr($vin, 9, 1),
            "manufacture" => substr($vin, 0, 3),
            "sequential" => substr($vin, 11, 6),
        ];

        return (object)$fragment;
    }

}
