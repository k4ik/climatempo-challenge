<?php
namespace Controller;
use Controller\CityController;
use Exception;
use Dotenv\Dotenv;

class WeatherController
{
  public function __construct()
  {
    $dotenv = Dotenv::createImmutable(__DIR__ . '/../..');
    $dotenv->load();
  }

  public function index(): void
  {
    $key = $_ENV["key"];

    $cityController = new CityController();
    $city = $cityController->getCity();

    if ($city === null) {
      echo json_encode(["error" => "Fill in all fields"]);
      return;
    }
   
    $this->requestWeatherData($key, $city);
  }

  public function requestWeatherData(string $key, string $city): void
  {
    try {
      $curl = curl_init();
      $url = "http://api.weatherapi.com/v1/forecast.json?key=$key&q=$city&days=3";
      curl_setopt($curl, CURLOPT_URL, $url);
      curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
      $response = curl_exec($curl);
      curl_close($curl);

      $data = json_decode($response, true);
      if($data["location"]["name"] == null) {
        echo json_encode(["error" => "Sorry, we couldn't find your city :c"]);
        return;
      }

      $weatherData = $this->fragmentWeatherData($data);
      echo json_encode($weatherData);
    } catch (Exception $e) {
      echo "Error: $e";
    }
  }

  public function fragmentWeatherData(array $data): array
  {
    $weather = [
      "name" => $data["location"]["name"],
      "region" => $data["location"]["region"],
      "forecast" => [
        [
          "date" => date('d/m/Y', strtotime($data["forecast"]["forecastday"][0]["date"])),
          "max_temp" => $data["forecast"]["forecastday"][0]["day"]["maxtemp_c"],
          "min_temp" => $data["forecast"]["forecastday"][0]["day"]["mintemp_c"],
          "precip" => $data["forecast"]["forecastday"][0]["day"]["totalprecip_mm"],
          "rain" => $data["forecast"]["forecastday"][0]["day"]["daily_chance_of_rain"],
          "condition" => [
            "text" => $data["forecast"]["forecastday"][0]["day"]["condition"]["text"],
            "icon" => $data["forecast"]["forecastday"][0]["day"]["condition"]["icon"]
          ]
        ],
        [
          "date" => date('d/m/Y', strtotime($data["forecast"]["forecastday"][1]["date"])),
          "max_temp" => $data["forecast"]["forecastday"][1]["day"]["maxtemp_c"],
          "min_temp" => $data["forecast"]["forecastday"][1]["day"]["mintemp_c"],
          "precip" => $data["forecast"]["forecastday"][1]["day"]["totalprecip_mm"],
          "rain" => $data["forecast"]["forecastday"][1]["day"]["daily_chance_of_rain"],
          "condition" => [
            "text" => $data["forecast"]["forecastday"][1]["day"]["condition"]["text"],
            "icon" => $data["forecast"]["forecastday"][1]["day"]["condition"]["icon"]
          ]
        ],
        [
          "date" => date('d/m/Y', strtotime($data["forecast"]["forecastday"][2]["date"])),
          "max_temp" => $data["forecast"]["forecastday"][2]["day"]["maxtemp_c"],
          "min_temp" => $data["forecast"]["forecastday"][2]["day"]["mintemp_c"],
          "precip" => $data["forecast"]["forecastday"][2]["day"]["totalprecip_mm"],
          "rain" => $data["forecast"]["forecastday"][2]["day"]["daily_chance_of_rain"],
          "condition" => [
            "text" => $data["forecast"]["forecastday"][2]["day"]["condition"]["text"],
            "icon" => $data["forecast"]["forecastday"][2]["day"]["condition"]["icon"]
          ]
        ]
      ]
    ];
    return $weather;
  }
}