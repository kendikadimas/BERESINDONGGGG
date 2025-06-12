<template>
  <section class="bg-gray-100 py-16 md:py-20">
    <div class="container mx-auto px-4">
      <h2 class="text-3xl md:text-4xl font-bold text-center text-green-800 mb-12">
        Memberikan yang terbaik untuk <span class="text-yellow-500">Anda!</span>
      </h2>

      <carousel :items-to-show="1" :wrap-around="true">
        <slide v-for="slide in slides" :key="slide.id">
          <div class="bg-[#344C36] w-[60%] h-[80%] rounded-lg shadow-xl px-24 md:p-12 flex flex-col md:flex-row items-center space-y-8 md:space-y-0 md:space-x-12">
            <div class="w-1/3 md:w-1/2  text-center md:text-left">
              <p class="text-white text-lg md:text-s leading-relaxed mb-6">
                {{ slide.description }}
              </p>
              <ul class="text-white space-y-3 text-base">
                <li v-for="feature in slide.features" :key="feature" class="flex items-start">
                  <span class="text-green-600 mr-3 mt-1">&#10003;</span>
                  {{ feature }}
                </li>
              </ul>
            </div>
            <div class="md:w-1/2 flex justify-center">
              <img :src="slide.image" :alt="slide.alt" class="max-w-full h-auto object-cover">
            </div>
          </div>
        </slide>

        <template #addons>
          <navigation />
          <pagination />
        </template>
      </carousel>
    </div>
  </section>
</template>

<script>
// Import komponen dari vue3-carousel
import 'vue3-carousel/dist/carousel.css';
import { Carousel, Slide, Pagination, Navigation } from 'vue3-carousel';

export default {
  name: 'WhyChooseUs',
  components: {
    Carousel,
    Slide,
    Pagination,
    Navigation,
  },
  data() {
    return {
      slides: [
        {
          id: 1,
          description: 'Kami berkomitmen untuk memberikan layanan kebersihan profesional dengan hasil yang memuaskan dan harga yang kompetitif.',
          features: [
            'Profesional & Terlatih: Tim kami ahli di bidangnya.',
            'Peralatan Modern: Menggunakan teknologi terbaru untuk hasil optimal.',
            'Jaminan Kepuasan: Kami tidak puas sampai Anda puas.',
            'Harga Transparan: Tidak ada biaya tersembunyi.',
          ],
          image: '/images/tool.png',
          alt: 'Smiling man',
        },
        {
          id: 2,
          description: 'Kami selalu berinovasi untuk memberikan pelayanan terbaik dan termudah untuk kebutuhan kebersihan rumah Anda.',
          features: [
            'Booking Mudah: Pesan layanan hanya dengan beberapa klik.',
            'Dukungan Pelanggan: Siap membantu 24/7.',
            'Layanan Kustom: Sesuaikan paket kebersihan Anda.',
            'Pembayaran Aman: Berbagai opsi pembayaran tersedia.',
          ],
          image: '/images/trusted.png', // Ganti dengan gambar lain yang relevan
          alt: 'Cleaning service illustration',
        },
        // Tambahkan slide lain di sini jika diperlukan
      ],
    };
  },
};
</script>

<style scoped>
/* Anda bisa menambahkan gaya kustom untuk carousel di sini jika diperlukan,
   tapi vue3-carousel sudah menyediakan gaya default yang bagus. */

/* Contoh penyesuaian jika diperlukan */
/*
.carousel__pagination-button--active {
  background-color: #2D6A4F !important; // Warna hijau gelap BERESINDONG
}
*/
</style>