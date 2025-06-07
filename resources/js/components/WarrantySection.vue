<template>
  <section class="bg-[#344C36] text-white py-16 md:py-20 mb-60">
    <div class="container mx-auto px-4 flex flex-col md:flex-row items-center justify-center md:justify-around space-y-8 md:space-y-0">
      <div class="flex-shrink-0">
        <img :src="'/images/1-year-warranty.png'" alt="1 Year Warranty Badge" class="h-32 w-32 md:h-40 md:w-40 object-contain mx-auto">
      </div>
      <div class="text-center md:text-left max-w-lg">
        <h3 class="text-3xl font-bold mb-4">{{ title }}</h3>
        <p class="text-lg leading-relaxed mb-6">
          {{ description }}
        </p>
        <button v-if="buttonText" class="bg-yellow-500 hover:bg-yellow-600 text-green-900 font-bold py-3 px-8 rounded-full text-lg shadow-xl hover:shadow-2xl transition-all duration-300">
          {{ buttonText }}
        </button>
      </div>
    </div>
  </section>
</template>

<script setup>
import { defineProps } from 'vue';

const props = defineProps({
  title: {
    type: String,
    default: 'Layanan Kami Bergaransi!',
  },
  description: {
    type: String,
    default: 'Menyediakan garansi maksimal 7 hari setelah pekerjaan selesai. Apabila ada pengerjaan yang belum benar, terselesaikan Klaim garansi Anda disini!',
  },
  warrantyBadgeImage: {
    type: String,
    default: '/images/1-year-warranty.png',
  },
  buttonText: {
    type: String,
    default: 'Klaim',
  },
});
</script>

<style scoped>
/* ... */
</style>    