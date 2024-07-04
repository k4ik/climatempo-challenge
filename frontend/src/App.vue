<template>
  <div>
    <header class="bg-blue-500 flex justify-center items-center py-4 select-none">
      <img src="./assets/images/logo.png" alt="logo" class="w-40" />
    </header>
    <form class="flex justify-between items-center px-4 py-2">
      <input type="text" placeholder="Pesquisar..." autocomplete="off" class="w-full outline-none" />
      <button type="submit" class="border-none"><Search /></button>
    </form>
    <main class="bg-zinc-300 min-h-screen">
      <section class="grid grid-cols-1 md:grid-cols-2">
        <article class="flex flex-col max-w-80 w-full">
          <div class="flex flex-col bg-zinc-100 items-center justify-center p-4">
            <p class="self-start">01/02/2024</p>
            <img src="" alt="tempo" />
          </div>
          <div class="grid grid-cols-2 justify-items-center p-4 gap-4 bg-zinc-200">
            <div class="flex items-center gap-x-4"><MoveUp /><span class="text-blue-500">27ºC</span></div>
            <div class="flex items-center gap-x-4"><MoveDown /><span class="text-red-500">13ºC</span></div>
            <div class="flex items-center gap-x-4"><Droplet /><span>0mm</span></div>
            <div class="flex items-center gap-x-4"><Umbrella /><span>10%</span></div>
          </div>
        </article>
      </section>
    </main>
  </div>
</template>

<script setup>
  import { Search, MoveUp, MoveDown, Umbrella, Droplet } from "lucide-vue-next";

</script>
