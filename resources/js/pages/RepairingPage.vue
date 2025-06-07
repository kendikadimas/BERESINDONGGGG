<template>
  <AppLayout>
    <ServiceHeroSection
      title="Tangani Kerusakan Rumah Anda Dengan Pekerja Terbaik Kami!!"
      subtitle="Pilih pekerja terbaik Anda disini."
      background-image="/images/herorepair.png"
      button-text="Pilih Layanan"
    />

    <ServiceCategoryGrid
      section-title="Layanan Repairing"
      :categories="repairingCategories"
    />

    <WorkerRecommendation
      section-title="Rekomendasi Tukang"
      :workers="repairingWorkers"
    />

    <WarrantySection />

    </AppLayout>
</template>

<script setup>
import AppLayout from '../../js/components/layouts/AppLayout.vue';
import ServiceHeroSection from '../components/ServiceHeroSection.vue';
import ServiceCategoryGrid from '../components/ServiceCategoryGrid.vue';
import WorkerRecommendation from '../components/WorkerRecommendation.vue';
import WarrantySection from '../components/WarrantySection.vue';

// Data spesifik untuk halaman Repairing
const repairingCategories = [
  { name: 'Kebocoran', icon: '/images/kebocoran.svg' },
  { name: 'Keramik', icon: '/images/keramik.svg' },
  { name: 'Listrik', icon: '/images/listrik.svg' },
  { name: 'Air', icon: '/images/air.svg' },
  { name: 'Pintu', icon: '/images/pintu.svg' },
  { name: 'Tembok', icon: '/images/tembok.svg' },
  { name: 'Toilet', icon: '/images/toilet.svg' },
  { name: 'Pagar', icon: '/images/pagar.svg' },
  { name: 'Kanopi', icon: '/images/kanopi.svg' },
  { name: 'Jendela', icon: '/images/jendela.svg' },
];

const repairingWorkers = [
  { id: 1, name: 'Abdul Jaenul', photo: '/images/tukang1.png', rating: 4.5, specialty: 'Spesialis Perbaikan Umum' },
  { id: 2, name: 'Budi Santoso', photo: '/images/tukang2.png', rating: 4.8, specialty: 'Ahli Listrik & Pipa' },
  { id: 3, name: 'Citra Dewi', photo: '/images/tukang3.png', rating: 4.7, specialty: 'Pakar Renovasi Rumah' },
  { id: 4, name: 'Citra Dewi', photo: '/images/tukang3.png', rating: 4.7, specialty: 'Pakar Renovasi Rumah' },
  { id: 5, name: 'Citra Dewi', photo: '/images/tukang3.png', rating: 4.7, specialty: 'Pakar Renovasi Rumah' },
  // Tambahkan data pekerja lain sesuai kebutuhan
];
</script>

<style scoped>
/* ... */
</style>