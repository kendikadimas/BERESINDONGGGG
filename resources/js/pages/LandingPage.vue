<script setup>
// Impor semua komponen yang akan digunakan
import AppLayout from '../../js/components/layouts/AppLayout.vue';
import HeroSection from '../components/HeroSection.vue';
import WhyChooseUs from '../components/WhyChooseUs.vue';
import ServicesSection from '../components/ServicesSection.vue';
// import FeaturedWorkers from '../components/FeaturedWorkers.vue';
import BookingFlow from '../components/BookingFlow.vue';
import EmergencyHelp from '../components/EmergencyHelp.vue';
import CustomerTestimonials from '../components/CustomerTestimonials.vue';
// 1. Terima data dari LandingPageController sebagai props
// Nama props harus sama dengan kunci array yang Anda kirim dari Inertia::render()
const props = defineProps({
  testimonials: {
    type: Array,
    required: true,
  },
  featuredWorkers: {
    type: Array,
    required: true,
  },
});
</script>

<template>
  <AppLayout>
    <HeroSection />
    <WhyChooseUs />
    <ServicesSection />
    
    <FeaturedWorkers :workers="featuredWorkers" />

    <BookingFlow />
    <EmergencyHelp />

    <CustomerTestimonials :testimonials="testimonials" />
  </AppLayout>
</template>