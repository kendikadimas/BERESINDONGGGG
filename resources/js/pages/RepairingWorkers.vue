<template>
  <AppLayout>
    <ServiceHeroSection
      title="Tangani Kerusakan Rumah Anda Dengan Pekerja Terbaik Kami!!"
      subtitle="Pilih pekerja terbaik Anda disini."
      background-image="/images/herorepair.png"
      button-text="Pilih Layanan"
    />

    <FeaturedWorkers
      :workers="cleaningWorkers"
    />

    </AppLayout>
</template>

<script setup>
import AppLayout from '../../js/components/layouts/AppLayout.vue';
import ServiceHeroSection from '../components/ServiceHeroSection.vue';
import FeaturedWorkers from '@/components/FeaturedWorkers.vue';
// Data spesifik untuk halaman Repairing

const cleaningWorkers = [
  { id: 1, name: 'Abdul Jaenul', rating: 4.5, specialty: 'Spesialis Perbaikan Umum', imageUrl: '/images/tukang1.png' },
  { id: 2, name: 'Budi Santoso', rating: 4.8, specialty: 'Ahli Listrik & Pipa', imageUrl: '/images/tukang2.png' },
  { id: 3, name: 'Citra Dewi', rating: 4.7, specialty: 'Pakar Renovasi Rumah', imageUrl: '/images/tukang3.png' },
  { id: 4, name: 'Citra Dewi', rating: 4.7, specialty: 'Pakar Renovasi Rumah', imageUrl: '/images/tukang3.png' },
  { id: 5, name: 'Citra Dewi', rating: 4.7, specialty: 'Pakar Renovasi Rumah', imageUrl: '/images/tukang3.png' }, 
  { id: 6, name: 'Citra Dewi', rating: 4.7, specialty: 'Pakar Renovasi Rumah', imageUrl: '/images/tukang3.png' }, 
  // Tambahkan data pekerja lain sesuai kebutuhan
];


</script>

<style scoped>
/* ... */
</style>