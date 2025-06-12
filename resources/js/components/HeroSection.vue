<template>
  <section class="bg-gradient-to-r from-white to-white text-white md:py-24 overflow-hidden relative py-16 px-15">
    <div class="container mx-auto px-4 flex flex-col md:flex-row items-center justify-between relative z-10">
      <div class="md:w-1/2 text-center md:text-left mb-10 md:mb-0">
        <h1 class="text-4xl md:text-5xl lg:text-6xl font-extrabold leading-tight mb-6 animate__animated animate__fadeInUp text-black">
          Beresin <span class="text-yellow-400">kerjaan</span> di rumahmu dengan kami!
        </h1>
        <p class="text-lg md:text-xl mb-8 opacity-90 animate__animated animate__fadeInUp animate__delay-0.5s text-black">
          Kami menyediakan solusi kebersihan terintegrasi untuk kenyamanan rumah Anda.
        </p>
        <a href="/repairing" class="bg-yellow-500 hover:bg-yellow-600 text-white font-bold py-3 px-8 rounded-full text-lg shadow-xl hover:shadow-2xl transition-all duration-300 transform hover:scale-105 animate__animated animate__zoomIn animate__delay-1s"  >
          Pesan Sekarang
        </a>
        <a href="/about" class="ml-5 bg-yellow-500 hover:bg-yellow-600 text-white font-bold py-3 px-8 rounded-full text-lg shadow-xl hover:shadow-2xl transition-all duration-300 transform hover:scale-105 animate__animated animate__zoomIn animate__delay-1s"  >
          About
        </a>
      </div>
      <div class="md:w-1/2 flex justify-center md:justify-end animate__animated animate__fadeInRight animate__delay-0.8s">
        <img :src="'/images/hero1.png'" alt="Pekerja Beresindong Ilustrasi" class="w-3/4 h-auto object-contain">
      </div>
    </div>
    
  </section>
</template>

<script>
export default {
  name: 'HeroSection',
  // Jika Anda ingin animasi, Anda bisa mengintegrasikan library seperti Animate.css
  // Pastikan Anda telah menginstal dan mengimpornya di app.js atau di sini.
};
</script>

<style scoped>
/* Anda bisa menambahkan gaya kustom jika diperlukan, tapi Tailwind seharusnya cukup */
/* Jika menggunakan Animate.css, pastikan untuk mengimpor CSS-nya di app.css */
</style>