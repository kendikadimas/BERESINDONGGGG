<template>
  <section class="bg-white py-16 md:py-20">
    <div class="container mx-auto px-4">
      <h2 class="text-3xl md:text-4xl font-bold text-center text-green-800 mb-12">
        {{ sectionTitle }}
      </h2>

      <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-5 gap-6 w-[80%] m-auto">
        <div v-for="category in categories" :key="category.name" class="bg-[#344C36] rounded-lg shadow-md p-4 text-center transition-all duration-300 hover:shadow-lg hover:scale-105 flex flex-col items-center justify-center">
          <img :src="category.icon" :alt="category.name" class="h-12 w-12 mb-3 object-contain ">
          <p class="font-semibold text-white text-lg">{{ category.name }}</p>
        </div>
      </div>
    </div>
  </section>
</template>

<script setup>
import { defineProps } from 'vue';

const props = defineProps({
  sectionTitle: {
    type: String,
    default: 'Layanan Kami',
  },
  categories: {
    type: Array,
    required: true,
    default: () => [],
  },
});
</script>

<style scoped>
/* ... */
</style>