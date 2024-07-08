<?php
namespace Controller;

class CityController
{
    public function getCity(): ?string
    {
        $city = $_POST["city"] ? $this->formatCity($_POST["city"]) : null;

        return $city;
    }

    public function formatCity(string $str): string
    {
        $str = trim($str);
        $str = preg_replace("/\s+/", "%20", $str);

        return $str;
    }
}