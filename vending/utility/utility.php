<?php


function showInput($array, $value)
{
    if (isset($array['validValues']["valid" . "$value"]) || isset($array['invalidValues']["invalid" . "$value"])) {
        if (isset($array['validValues']["valid" . "$value"])) {
            return $array['validValues']["valid" . "$value"];
        } else {
            return $array['invalidValues']["invalid" . "$value"];
        }
    }
}

function showInputRed($array, $value)
{
    if ($array['invalidValues']["invalid" . "$value" . "Red"] ?? false) {
        return 'incorrect';
    }
}

function showEditInput($array, $value)
{
    if (isset($array['validValues']["valid" . "$value"]) || isset($array['invalidValues']["invalid" . "$value"])) {
        if (isset($array['validValues']["valid" . "$value"])) {
            return $array['validValues']["valid" . "$value"];
        } else {
            return $array['invalidValues']["invalid" . "$value"];
        }
    } else {
        return $array['machineData']["vendingMachine" . "$value"];
    }
}