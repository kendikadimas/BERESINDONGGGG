<template>
  <AppLayout>
    <HeroSection />
    <WhyChooseUs />
    <ServicesSection />
    <FeaturedWorkers />
    <BookingFlow />
    <EmergencyHelp />
    <CustomerTestimonials />
  </AppLayout>
</template>

<script>
// Impor semua komponen yang akan digunakan
import AppLayout from '../../js/components/layouts/AppLayout.vue';
import HeroSection from '../components/HeroSection.vue';
import WhyChooseUs from '../components/WhyChooseUs.vue';
import ServicesSection from '../components/ServicesSection.vue';
import FeaturedWorkers from '../components/FeaturedWorkers.vue';
import BookingFlow from '../components/BookingFlow.vue';
import EmergencyHelp from '../components/EmergencyHelp.vue';
import CustomerTestimonials from '../components/CustomerTestimonials.vue';

export default {
  name: 'AppComponent',
  components: {
    AppLayout,
    HeroSection,
    WhyChooseUs,
    ServicesSection,
    FeaturedWorkers,
    BookingFlow,
    EmergencyHelp,
    CustomerTestimonials,
  },
};
</script>

<style scoped>
/* Tidak ada gaya khusus di sini, karena AppLayout dan section sudah memiliki gayanya masing-masing */
</style>