<template>
  <AppLayout>
    <ServiceHeroSection
      :title="'Pekerja Terbaik untuk Layanan ' + service.name"
      subtitle="Pilih pekerja yang paling sesuai untuk Anda."
      background-image="/images/heroclean.png"
    />

    <div class="container mx-auto px-4 py-16">
      <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8">
        <div v-for="worker in workers" :key="worker.id">
          <Link :href="route('booking.create', { service: service.id, tukang: worker.id })">
            <WorkerCard 
                :name="worker.name" 
                :specialty="worker.skill"
                :rating="worker.rating"
                :imageUrl="worker.avatar_path"
            />
          </Link>
        </div>
      </div>
    </div>
  </AppLayout>
</template>

<script setup>
import AppLayout from '../../js/components/layouts/AppLayout.vue';
import ServiceHeroSection from '@/components/ServiceHeroSection.vue';
import WorkerCard from '@/components/WorkersCard.vue'; // Gunakan komponen kartu yang sudah kita buat
import { Link } from '@inertiajs/vue3';

// Menerima data service dan workers dari controller
defineProps({
  service: Object,
  workers: Array,
});
</script>