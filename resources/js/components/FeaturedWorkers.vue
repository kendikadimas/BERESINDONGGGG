<script setup>
import { ref } from 'vue';
import WorkerCard from './WorkersCard.vue'; // 1. Impor komponen kartu yang baru kita buat

// 2. Ini adalah data para pekerja (contoh pengisian props)
// Anda bisa mendapatkan data ini dari API/database di masa depan.
const workers = ref([
  {
    id: 1,
    name: 'Abdul Jaenul',
    specialty: 'Perbaiki Genteng Bocor, Keramik Hancur, Tembok Roboh',
    rating: 5,
    imageUrl: '/images/tukang1.png', // PASTIKAN GAMBAR INI ADA DI public/images/
  },
  {
    id: 2,
    name: 'Siti Aminah',
    specialty: 'Spesialis Cleaning, Disinfeksi, & Tata Taman',
    rating: 4.8,
    imageUrl: '/images/tukang2.png', // PASTIKAN GAMBAR INI ADA DI public/images/
  },
  {
    id: 3,
    name: 'Joko Susilo',
    specialty: 'Ahli Kelistrikan, Pipa Air, & Pemasangan AC',
    rating: 4.9,
    imageUrl: '/images/tukang3.png', // PASTIKAN GAMBAR INI ADA DI public/images/
  },
]);
</script>

<template>
  <section class="bg-gray-100 py-16 md:py-20 w-[75%] m-auto">
    <div class="container mx-auto px-4">
      <h2 class="text-3xl md:text-4xl font-extrabold text-left text-green-800 mb-12">
        Pekerja Kebanggaan Kami
      </h2>

      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        <WorkerCard
          v-for="worker in workers"
          :key="worker.id"
          :name="worker.name"
          :specialty="worker.specialty"
          :rating="worker.rating"
          :imageUrl="worker.imageUrl"
        />
      </div>
    </div>
  </section>
</template>