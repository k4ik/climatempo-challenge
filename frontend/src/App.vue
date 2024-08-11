<template>
  <div>
    <header class="bg-blue-500 flex justify-center items-center py-4 select-none">
      <img src="./assets/images/logo.png" alt="logo" class="w-40" />
    </header>
    <form @submit.prevent="fetchData" class="flex justify-between items-center px-4 py-2" id="form">
      <input type="text" name="city" placeholder="Search..." autocomplete="off" class="w-full outline-none" v-model="search" />
      <button type="submit" class="border-none"><Search /></button>
    </form>
    <main class="bg-zinc-300 min-h-screen">
      <section v-if="message">
        <p class="text-center py-4 text-xs md:text-base">{{message}}</p>
      </section>
      <section v-else>
        <p v-if=weather class="text-center py-4 text-xs md:text-base">Previsões para {{ weather.name }} - {{ weather.region }}</p>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-y-12 p-4 justify-items-center">
          <article v-for="day in weather?.forecast ?? []" :key="day.date" class="flex flex-col max-w-80 w-full bg-white shadow-md rounded-lg">
            <div class="flex flex-col bg-zinc-100 items-center justify-center p-4">
              <p class="self-start">{{ day.date }}</p>
              <img :src="day.condition.icon" :alt="day.condition.text" />
            </div>
            <div class="grid grid-cols-2 justify-items-center p-4 gap-4 bg-zinc-200">
              <div class="flex items-center gap-x-4"><MoveUp /><span class="text-blue-500">{{ day.max_temp }}ºC</span></div>
              <div class="flex items-center gap-x-4"><MoveDown /><span class="text-red-500">{{ day.min_temp }}ºC</span></div>
              <div class="flex items-center gap-x-4"><Droplet /><span>{{ day.precip }}mm</span></div>
              <div class="flex items-center gap-x-4"><Umbrella /><span>{{ day.rain }}%</span></div>
            </div>
          </article>
        </div>
      </section>
    </main>
  </div>
</template>

<script>
import { Search, MoveUp, MoveDown, Umbrella, Droplet } from "lucide-vue-next";

export default {
  components: {
    Search, MoveUp, MoveDown, Umbrella, Droplet
  },
  data() {
    return {
      weather: null,
      message: null,
      search: null
    }
  },
  methods: {
    fetchData() {
      var formData = new FormData(document.querySelector('#form'));

      fetch("http://localhost:8000/weather", {
        method: "POST",
        body: formData
      })
      .then(response => response.json())
      .then(data => {
        this.message = data.error;
        if(data.error) {
          setTimeout(() => {
            this.message = "";
          }, "4000");
          this.weather = null;
          return;
        }
        this.weather = data;
      })
      .catch(error => {
        console.error("Error fetching weather data:", error);
      
      });
      this.search = "";
    }
  }
}
</script>
