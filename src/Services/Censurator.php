<?php

namespace App\Services;

class Censurator
{

    private array $motsInterdit = array(
        "Putain",
        "fuck",
        "merde",
        "chier",
        "connard",
        "pd",
        "enculé",
        "encule",
        "nègre"
);

    public function purify($message) : string {
        return str_ireplace($this->motsInterdit," *** " ,$message);
    }

}