<script setup>
import { ref } from 'vue';
import { usePage, Link } from '@inertiajs/vue3';
import TestimonialModal from './TestimonialModal.vue';

// Impor komponen dari library carousel
import { Carousel, Slide, Navigation } from 'vue3-carousel';

// Menerima data testimoni dari halaman induk (LandingPage.vue)
defineProps({
    testimonials: Array,
});

// Mengambil data user yang login untuk menampilkan/menyembunyikan tombol
const user = usePage().props.auth.user;

const showTestimonialModal = ref(false);
const openModal = () => { showTestimonialModal.value = true; };
const closeModal = () => { showTestimonialModal.value = false; };

// Pengaturan untuk carousel
const carouselSettings = {
  itemsToShow: 1,
  snapAlign: 'center',
};
const carouselBreakpoints = {
  768: { // Lebar layar 768px ke atas
    itemsToShow: 2,
    snapAlign: 'start',
  },
};
</script>

<template>
  <section class="bg-white text-[#344C36] py-16 md:py-20">
    <div class="container mx-auto px-4">
      <h2 class="text-3xl font-bold text-center mb-12">Testimoni Customer</h2>

      <Carousel v-if="testimonials && testimonials.length > 0" v-bind="carouselSettings" :breakpoints="carouselBreakpoints" :wrap-around="true">
        
        <Slide v-for="testimonial in testimonials" :key="testimonial.id">
          <div class="p-4 w-full h-full">
            <div class="bg-slate-50 rounded-xl shadow-lg p-8 h-full flex flex-col relative overflow-hidden text-left">
              
              <svg class="absolute top-4 left-4 w-16 h-16 text-slate-200 opacity-50 transform -translate-x-4 -translate-y-4" fill="currentColor" viewBox="0 0 32 32">
                <path d="M9.09,11.53c0-2.23,1.35-3.63,3.43-3.63c1.89,0,2.83,1.04,2.83,2.53c0,1.06-0.5,1.8-1.54,2.94L12,15.3c-1.42,1.54-2.1,2.8-2.1,4.41h2.83c0-1.25,0.36-2.13,1.08-3.09l2.2-2.38c1.39-1.49,2.33-2.96,2.33-5.06c0-2.88-2.12-4.94-5.58-4.94c-3.4,0-5.48,2.1-5.48,5.13H9.09z M20.3,11.53c0-2.23,1.35-3.63,3.43-3.63c1.89,0,2.83,1.04,2.83,2.53c0,1.06-0.5,1.8-1.54,2.94L23.23,15.3c-1.42,1.54-2.1,2.8-2.1,4.41h2.83c0-1.25,0.36-2.13,1.08-3.09l2.2-2.38c1.39-1.49,2.33-2.96,2.33-5.06c0-2.88-2.12-4.94-5.58-4.94c-3.4,0-5.48,2.1-5.48,5.13H20.3z"></path>
              </svg>

              <p class="text-gray-700 text-base leading-relaxed mb-6 flex-grow z-10 relative">
                {{ testimonial.comment }}
              </p>
              
              <footer class="mt-auto border-t border-slate-200 pt-4 z-10">
                <div class="flex items-center">
                    <img :src="testimonial.user.avatar_path || '/images/default.jpg'" :alt="testimonial.user.name" class="w-12 h-12 rounded-full object-cover mr-4">
                    <div>
                        <p class="font-semibold text-gray-900">{{ testimonial.user.name }}</p>
                        <p class="text-sm text-gray-500">Customer</p>
                    </div>
                </div>
              </footer>
            </div>
          </div>
        </Slide>

        <template #addons>
          <Navigation />
        </template>

      </Carousel>
      
      <div v-else class="text-center text-gray-500 py-10">
        Belum ada testimoni. Jadilah yang pertama!
      </div>

      <div class="text-center mt-12">
        <button v-if="user" @click="openModal" class="bg-yellow-500 hover:bg-yellow-600 text-white font-bold py-3 px-8 rounded-full text-lg shadow-xl">
            Tambah Testimoni
        </button>
      </div>
    </div>
  </section>

  <TestimonialModal :show="showTestimonialModal" @close="closeModal" />
</template>

<style>
/* Kustomisasi tampilan panah navigasi carousel agar sesuai tema */
.carousel__prev,
.carousel__next {
  background-color: #344C36;
  border-radius: 50%;
  color: white;
  width: 2.5rem; /* 40px */
  height: 2.5rem; /* 40px */
  margin: 0 -20px; /* Sedikit keluar dari container carousel */
}

.carousel__prev:hover,
.carousel__next:hover {
  background-color: #2A3C2D;
}

.carousel__icon {
    width: 1.5em;
    height: 1.5em;
}
</style>