
<script setup>
import AppLayout from '../../js/components/layouts/AppLayout.vue';
import ServiceHeroSection from '../components/ServiceHeroSection.vue';
import ServiceCategoryGrid from '../components/ServiceCategoryGrid.vue';
import WorkerRecommendation from '../components/WorkerRecommendation.vue';
import WarrantySection from '../components/WarrantySection.vue';
// 1. Hapus array statis
// const repairingCategories = [ ... ]; // <-- HAPUS
// const repairingWorkers = [ ... ]; // <-- HAPUS

// 2. Terima data dari Controller sebagai props
const props = defineProps({
  repairingCategories: String,                 
  repairingWorkers: Array
});
</script>

<template>
  <AppLayout>
    <ServiceHeroSection
      title="Solusi Cepat untuk Semua Kerusakan di Rumah Anda"
      subtitle="Temukan ahli perbaikan terpercaya di sini."
      background-image="/images/herorepair.png"
    />

    <ServiceCategoryGrid
      section-title="Layanan Repairing"
      :categories="repairingCategories"
    />

    <!-- <WorkerRecommendation
      section-title="Rekomendasi Tukang"
      :workers="repairingWorkers"
    /> -->

    <WarrantySection />
  </AppLayout>
</template>