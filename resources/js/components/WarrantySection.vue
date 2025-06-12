<template>
  <section class="bg-[#344C36] text-white p-4 py-16 md:py-20 relative overflow-hidden mb-36">
    
    <div class="absolute mt-6 top-1/2 -translate-y-1/2 w-2/5 md:w-1/3 lg:w-1/4 opacity-10 md:opacity-100 transform translate-x-1/4 md:translate-x-1/3">
       <img
           :src="warrantyBadgeImage"
           alt="1 Year Warranty Badge"
           class="w-full h-auto"
       >
   </div>

    <div class="container mx-auto px-4 flex items-center relative z-10">
        <div class="w-0 md:w-1/3 lg:w-2/5"></div>

        <div class="w-2/3 md:w-2/3 lg:w-3/5 text-center md:text-left">
            <h3 class="text-3xl lg:text-4xl font-bold mb-4">{{ title }}</h3>
            <p class="text-lg leading-relaxed mb-6 opacity-90">
                {{ description }}
            </p>
            <!-- <Link v-if="buttonText" :href="route('warranty.claim.create')">
              <button class="bg-yellow-500 hover:bg-yellow-600 text-green-900 font-bold py-3 px-8 rounded-full text-lg shadow-xl hover:shadow-2xl transition-all duration-300">
                  {{ buttonText }}
              </button>
            </Link> -->
        </div>
    </div>
  </section>
</template>

<script setup>
import { defineProps } from 'vue';
import { Link } from '@inertiajs/vue3'; // Impor Link untuk tombol

const props = defineProps({
  title: {
    type: String,
    default: 'Layanan Kami Bergaransi!',
  },
  description: {
    type: String,
    default: 'Menyediakan garansi maksimal 7 hari setelah pekerjaan selesai. Apabila ada pengerjaan yang belum benar, terselesaikan Klaim garansi Anda disini!',
  },
  warrantyBadgeImage: {
    type: String,
    default: '/images/warranty.png', // Pastikan gambar ini ada di public/images
  },
  buttonText: {
    type: String,
    default: 'Klaim Garansi',
  },
});
</script>