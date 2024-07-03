import Header from "./components/Header.jsx";
import SearchBox from "./components/SearchBar.jsx";
import Card from "./components/Card.jsx";
import React, { useState } from "react";

function App() {
  const [results, setResults] = useState([]);
  const [location, setLocation] = useState('');

  const fetchData = async (query) => {
    try {
      const response = await fetch(`https://api.weatherapi.com/v1/forecast.json?key=84dbd0102e614019a21133107231511&q=${query}&days=3`);
      const data = await response.json();
      setLocation(data.location.name + ', ' + data.location.region);
      const forecastData = data.forecast.forecastday.map(day => ({
        date: day.date,
        conditionText: day.day.condition.text,
        conditionIcon: day.day.condition.icon,
        maxTemp: day.day.maxtemp_c,
        minTemp: day.day.mintemp_c,
        precipitation: day.day.totalprecip_mm,
        chanceOfRain: day.day.daily_chance_of_rain
      }));
      setResults(forecastData);
    } catch (error) {
      console.error('Error fetching data:', error);
    }
  }

  return (
    <>
      <Header />
      <SearchBox onSearch={fetchData} />
      <main className="bg-zinc-300 h-screen">
        <p className="text-center text-xl pt-8 pb-8">{location ? `Previsão para ${location}` : ""}</p>
        <section className="grid grid-cols-2 justify-items-center gap-y-16">
          {results.map((result, index) => (
            <Card key={index} data={result} />
          ))}
        </section>
      </main>
    </>
  )
}

export default App;
