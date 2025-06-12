<script setup>
import { Link } from '@inertiajs/vue3';

defineProps({
  title: String,
  description: String,
  buttonText: String,
  buttonRouteName: String, // Nama route untuk tombol
  imageUrl: String,
  imagePosition: { // Prop untuk menentukan posisi gambar ('left' atau 'right')
    type: String,
    default: 'left', // Nilai default adalah gambar di kiri
  },
});
</script>

<template>
  <section>
    <h2 v-if="title" class="text-3xl font-bold text-center text-gray-800 mb-8">
      {{ title }}
    </h2>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-8 items-center bg-gray-50 p-8 rounded-lg">
      
      <div 
        class="w-full h-auto overflow-hidden rounded-lg"
        :class="{ 'md:order-last': imagePosition === 'right' }"
      >
        <img :src="imageUrl" alt="Call to action image" class="w-full h-full ">
      </div>

      <div class="text-left">
        <h2 v-if="!title" class="text-3xl font-bold text-gray-800 mb-4">
            {{ description.split(' ')[0] + ' ' + description.split(' ')[1] }} </h2>
        <p class="text-gray-600 leading-relaxed mb-6">
          {{ description }}
        </p>
        <Link :href="route(buttonRouteName)">
          <button class="bg-[#2A3C2D] text-white font-semibold py-3 px-8 rounded-lg hover:bg-[#38503D] transition-colors duration-300">
            {{ buttonText }}
          </button>
        </Link>
      </div>
    </div>
  </section>
</template>