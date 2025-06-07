<template>
  <section class="bg-gray-100 py-16 md:py-20">
    <div class="container mx-auto px-4">
      <h2 class="text-3xl md:text-4xl font-bold text-center text-green-800 mb-12">
        {{ sectionTitle }}
      </h2>

      <div class="relative flex overflow-x-auto snap-x snap-mandatory pb-4 space-x-4 md:space-x-6 lg:space-x-8 w-[80%] m-auto ">
    <div v-for="worker in workers" :key="worker.id"
         class="flex-shrink-0 snap-center w-[344px] md:w-72 rounded-lg shadow-lg overflow-hidden relative">
        <div class="relative w-full h-full"> <img :src="worker.photo" :alt="worker.name" class="w-full h-full object-cover">

            <div class="absolute inset-x-0 bottom-0 bg-gradient-to-t from-black/80 to-transparent p-4 text-white ">
                <h3 class="text-xl font-semibold mb-1">{{ worker.name }}</h3>
                <p class="text-sm opacity-90">{{ worker.specialty }}</p>
            </div>

            <div class="absolute top-0 right-0 bg-yellow-500 text-green-900 text-xs font-bold px-3 py-1 rounded-bl-lg">
                {{ worker.rating }} &#9733;
            </div>
        </div>

        <!-- <div class="p-4 bg-white text-center"> -->
            <!-- <button class="w-full bg-green-600 hover:bg-green-700 text-white font-semibold py-2 rounded-md text-sm transition-all duration-300">
                Lihat Profil
            </button>
        </div> -->
      </div>

        
      </div>
      <div v-if="showAllButton" class="flex-shrink-0 snap-center w-64 md:w-72 flex items-center justify-center m-auto mt-5">
            <button class="bg-green-600 hover:bg-green-700 text-white font-bold py-3 px-8 rounded-full text-lg shadow-md hover:shadow-lg transition-all duration-300 transform hover:scale-105">
                Lihat Semua
            </button>
        </div>
    </div>
  </section>
</template>

<script setup>
import { defineProps } from 'vue';

const props = defineProps({
  sectionTitle: {
    type: String,
    default: 'Rekomendasi Pekerja',
  },
  workers: {
    type: Array,
    required: true,
    default: () => [],
  },
  showAllButton: {
    type: Boolean,
    default: true,
  }
});
</script>

<style scoped>
/* Tambahkan gaya untuk scrollbar horizontal jika dibutuhkan */
/* Contoh untuk menyembunyikan scrollbar tapi tetap bisa di-scroll: */
/* .overflow-x-auto::-webkit-scrollbar {
  display: none;
}
.overflow-x-auto {
  -ms-overflow-style: none;  /* IE and Edge */
  /* scrollbar-width: none;  /* Firefox */
/* } */
</style>