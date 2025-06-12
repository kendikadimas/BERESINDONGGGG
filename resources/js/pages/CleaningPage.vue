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

    <!-- <WorkerRecommendation
      section-title="Rekomendasi Tukang"
      :workers="cleaningWorkers"
    /> -->

    <WarrantySection />

    </AppLayout>
</template>

<script setup>
import AppLayout from '../../js/components/layouts/AppLayout.vue'; // Pastikan path ini benar
import ServiceHeroSection from '@/components/ServiceHeroSection.vue';
import ServiceCategoryGrid from '@/components/ServiceCategoryGrid.vue';
import WorkerRecommendation from '@/components/WorkerRecommendation.vue';
import WarrantySection from '@/components/WarrantySection.vue';

// 1. Hapus array statis 'cleaningCategories' dan 'cleaningWorkers'
// const cleaningCategories = [ ... ]; // <-- HAPUS
// const cleaningWorkers = [ ... ]; // <-- HAPUS

// 2. Terima data dari Controller sebagai props
const props = defineProps({
  cleaningCategories: {
    type: Array,
    required: true,
  },
  cleaningWorkers: {
    type: Array,
    required: true,
  }
});
</script>

<style scoped>
/* ... */
</style>