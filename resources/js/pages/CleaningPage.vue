<template>
  <AppLayout>
    <ServiceHeroSection
      title="Siap Menyulap Rumah Anda Menjadi Bersih Seperti Baru"
      subtitle="Pilih pekerja terbaik Anda disini."
      background-image="/images/heroclean.png"
      button-text="Pilih Layanan"
    />

    <ServiceCategoryGrid
      section-title="Layanan Cleaning"
      :categories="cleaningCategories"
    />

    <WorkerRecommendation
      section-title="Rekomendasi Tukang"
      :workers="cleaningWorkers"
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
const cleaningCategories = [
  { name: 'Kamar', icon: '/images/kamar.svg' },
  { name: 'Kasur', icon: '/images/kasur.svg' },
  { name: 'Sofa', icon: '/images/sofa.svg' },
  { name: 'Toilet', icon: '/images/toilet.svg' },
  { name: 'Karpet', icon: '/images/karpet.svg' },
  { name: 'Tandon', icon: '/images/tandon.svg' },
  { name: 'Dapur', icon: '/images/dapur.svg' },
  { name: 'Garasi', icon: '/images/garasi.svg' },
  { name: 'Atap', icon: '/images/atap.svg' },
  { name: 'Halaman', icon: '/images/halaman.svg' },
];

const cleaningWorkers = [
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