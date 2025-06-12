<script setup>
// 1. Impor komponen Link dari Inertia untuk navigasi
import { Link } from '@inertiajs/vue3';
</script>

<template>
  <section class="bg-white py-16 md:py-20">
    <div class="container mx-auto px-4">
      <h2 class="text-3xl md:text-4xl font-bold text-center text-green-800 mb-12">
        Emergency Help
      </h2>

      <div class="bg-[#344C36] rounded-lg w-full max-w-5xl mx-auto h-auto md:h-[350px] shadow-xl flex flex-col md:flex-row items-center">
          <div class="md:w-1/2 text-white p-8 md:p-12 text-center md:text-left">
              <h3 class="text-2xl font-bold mb-4">Butuh Bantuan Cepat?</h3>
              <p class="text-lg leading-relaxed mb-6">
                  Kami siap membantu Anda dalam situasi darurat dengan layanan respons cepat 24/7.
                  Baik itu kebocoran, listrik padam mendadak, atau masalah mendesak lainnya.
              </p>
          </div>

          <div class="md:w-1/2 h-64 md:h-full flex justify-center items-center overflow-hidden">
              <img :src="'/images/emergency.png'" alt="Emergency Sign" class="w-full h-full object-cover md:rounded-r-lg">
          </div>
      </div>
      
      <div class="mt-8">
        <div class="flex justify-center">
          <Link :href="route('emergency.create')">
            <button class="bg-green-600 hover:bg-green-700 text-white font-bold py-4 px-10 rounded-full text-lg shadow-md hover:shadow-lg transition-all duration-300 transform hover:scale-105">
              Hubungi Sekarang
            </button>
          </Link>
        </div>
      </div>
    </div>
  </section>
</template>

<style scoped>
/* Gaya khusus jika diperlukan */
</style>