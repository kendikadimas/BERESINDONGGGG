<template>
  <section class="bg-black text-white py-16 md:py-24 overflow-hidden relative">
    <div class="absolute inset-0 bg-cover bg-black bg-center opacity-30" :style="{ backgroundImage: `url(${backgroundImage})` }"></div>
    <div class="container mx-auto px-4 flex flex-col items-center justify-center relative z-10 text-center">
      <h1 class="text-4xl md:text-5xl lg:text-6xl font-extrabold leading-tight mb-6 animate__animated animate__fadeInUp">
        {{ title }}
      </h1>
      <p class="text-lg md:text-xl mb-8 opacity-90 animate__animated animate__fadeInUp animate__delay-0.5s">
        {{ subtitle }}
      </p>
      <button v-if="buttonText" class="bg-yellow-500 hover:bg-yellow-600 text-green-900 font-bold py-3 px-8 rounded-full text-lg shadow-xl hover:shadow-2xl transition-all duration-300 transform hover:scale-105 animate__animated animate__zoomIn animate__delay-1s">
        {{ buttonText }}
      </button>
    </div>
  </section>
</template>

<script setup>
// Menggunakan defineProps untuk mendeklarasikan props dalam <script setup>
import { defineProps } from 'vue';

const props = defineProps({
  title: {
    type: String,
    required: true,
  },
  subtitle: {
    type: String,
    default: '',
  },
  backgroundImage: {
    type: String,
    default: '', // Path gambar default jika tidak disediakan
  },
  buttonText: {
    type: String,
    default: '', // Tombol opsional
  },
});
</script>

<style scoped>
/* Anda bisa menambahkan gaya kustom jika diperlukan, tapi Tailwind seharusnya cukup */
</style>