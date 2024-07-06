<?php
namespace Controller;

use Dotenv\Dotenv;

class WeatherController
{
  public function __construct()
  {
    $dotenv = Dotenv::createImmutable(__DIR__ . '/../..');
    $dotenv->load();
  }

  public function getData()
  {
    $key = $_ENV["key"];

    $location = $_POST["location"];
    $location = $this->formatString($location);

    $this->getResponse($key, $location);
  }

  public function formatString($str)
  {
    $str = trim($str);
    $str = preg_replace("/\s+/", "%20", $str);

    return $str;
  }

  public function getResponse($key, $location)
  {
    try {
      $curl = curl_init();

      $url = "http://api.weatherapi.com/v1/forecast.json?key=$key&q=$location&days=3";

      curl_setopt($curl, CURLOPT_URL, $url);
      curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
      $response = curl_exec($curl);
      curl_close($curl);

      $data = json_decode($response, true);
      $weatherData = $this->fragmentWeatherData($data);

      echo json_encode($weatherData);
    } catch (Exception $e) {
      echo "Error: $e";
    }
  }

  public function fragmentWeatherData($data)
  {
    $name = $data["location"]["name"];
    $region = $data["location"]["region"];
    $conditions = [
      [
        $data["forecast"]["forecastday"][0]["day"]["condition"]["text"],
        $data["forecast"]["forecastday"][0]["day"]["condition"]["icon"]
      ],
      [
        $data["forecast"]["forecastday"][1]["day"]["condition"]["text"],
        $data["forecast"]["forecastday"][1]["day"]["condition"]["icon"]
      ],
      [
        $data["forecast"]["forecastday"][2]["day"]["condition"]["text"],
        $data["forecast"]["forecastday"][2]["day"]["condition"]["icon"]
      ]
    ];
    $forecasts = [
      [
        $data["forecast"]["forecastday"][0]["date"],
        $data["forecast"]["forecastday"][0]["day"]["maxtemp_c"],
        $data["forecast"]["forecastday"][0]["day"]["mintemp_c"],
        $data["forecast"]["forecastday"][0]["day"]["totalprecip_mm"],
        $data["forecast"]["forecastday"][0]["day"]["daily_chance_of_rain"],
      ],
      [
        $data["forecast"]["forecastday"][1]["date"],
        $data["forecast"]["forecastday"][1]["day"]["maxtemp_c"],
        $data["forecast"]["forecastday"][1]["day"]["mintemp_c"],
        $data["forecast"]["forecastday"][1]["day"]["totalprecip_mm"],
        $data["forecast"]["forecastday"][1]["day"]["daily_chance_of_rain"],
      ],
      [
        $data["forecast"]["forecastday"][2]["date"],
        $data["forecast"]["forecastday"][2]["day"]["maxtemp_c"],
        $data["forecast"]["forecastday"][2]["day"]["mintemp_c"],
        $data["forecast"]["forecastday"][2]["day"]["totalprecip_mm"],
        $data["forecast"]["forecastday"][2]["day"]["daily_chance_of_rain"],
      ]
    ];

    $weather = [
      "name" => $name,
      "region" => $region,
      "forecast" => [
        [
          "date" => $forecasts[0][0],
          "max_temp" => $forecasts[0][1],
          "min_temp" => $forecasts[0][2],
          "precip" => $forecasts[0][3],
          "rain" => $forecasts[0][4],
          "condition" => [
            "text" => $conditions[0][0],
            "icon" => $conditions[0][1]
          ]
        ],
        [
          "date" => $forecasts[1][0],
          "max_temp" => $forecasts[1][1],
          "min_temp" => $forecasts[1][2],
          "precip" => $forecasts[1][3],
          "rain" => $forecasts[1][4],
          "condition" => [
            "text" => $conditions[1][0],
            "icon" => $conditions[1][1]
          ]
        ],
        [
          "date" => $forecasts[2][0],
          "max_temp" => $forecasts[2][1],
          "min_temp" => $forecasts[2][2],
          "precip" => $forecasts[2][3],
          "rain" => $forecasts[2][4],
          "condition" => [
            "text" => $conditions[2][0],
            "icon" => $conditions[2][1]
          ]
        ]
      ]
    ];

    return $weather;
  }
}