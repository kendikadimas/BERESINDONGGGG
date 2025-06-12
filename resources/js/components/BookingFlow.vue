<template>

      <h2 class="text-3xl  text-green-800 md:text-4xl font-bold text-center m-12 mt-15">
        Alur Pemesanan
      </h2>
  <section class="bg-[#344C36] text-white py-16 md:py-20">
    <div class="container mx-auto px-4">

        <div class="relative grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-x-8 gap-y-12 justify-items-center items-start text-center max-w-6xl mx-auto">
            <div class="relative flex flex-col items-center">
                <div class="bg-yellow-500 p-4 rounded-full mb-3 shadow-lg">
                    <img :src="'/images/layanan.svg'" alt="Pilih Layanan" class="h-8 w-8 text-green-900">
                </div>
                <p class="font-semibold text-lg">Pilih Layanan</p>
                <p class="text-sm opacity-80 mt-1">Pilih jenis layanan yang Anda butuhkan.</p>
                <div class="absolute right-0 top-1/2 transform -translate-y-1/2 translate-x-1/2 hidden lg:block">
                    <svg class="w-8 h-8 text-yellow-500" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                    </svg>
                </div>
            </div>

            <div class="relative flex flex-col items-center">
                <div class="bg-yellow-500 p-4 rounded-full mb-3 shadow-lg">
                    <img :src="'/images/pekerja.svg'" alt="Cari Pekerja" class="h-8 w-8 text-green-900">
                </div>
                <p class="font-semibold text-lg">Cari Pekerja</p>
                <p class="text-sm opacity-80 mt-1">Sistem akan merekomendasikan pekerja terbaik.</p>
                <div class="absolute right-0 top-1/2 transform -translate-y-1/2 translate-x-1/2 hidden lg:block">
                    <svg class="w-8 h-8 text-yellow-500" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                    </svg>
                </div>
            </div>

            <div class="relative flex flex-col items-center">
                <div class="bg-yellow-500 p-4 rounded-full mb-3 shadow-lg">
                    <img :src="'/images/pesanan.svg'" alt="Buat Pesanan" class="h-8 w-8 text-green-900">
                </div>
                <p class="font-semibold text-lg">Buat Pesanan</p>
                <p class="text-sm opacity-80 mt-1">Konfirmasi detail pesanan Anda.</p>
                <div class="absolute right-0 top-1/2 transform -translate-y-1/2 translate-x-1/2 hidden lg:block">
                    <svg class="w-8 h-8 text-yellow-500" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                    </svg>
                </div>
            </div>

            <div class="relative flex flex-col items-center">
                <div class="bg-yellow-500 p-4 rounded-full mb-3 shadow-lg">
                    <img :src="'/images/terimapesanan.svg'" alt="Pekerja Menerima Pesanan" class="h-8 w-8 text-green-900">
                </div>
                <p class="font-semibold text-lg">Pekerja Menerima Pesanan</p>
                <p class="text-sm opacity-80 mt-1">Pekerja akan segera menerima dan mengkonfirmasi pesanan Anda.</p>
            </div>
            <div class="relative flex flex-col items-center">
                <div class="bg-yellow-500 p-4 rounded-full mb-3 shadow-lg">
                    <img :src="'/images/datang.svg'" alt="Pekerja Datang" class="h-8 w-8 text-green-900">
                </div>
                <p class="font-semibold text-lg">Pekerja Datang</p>
                <p class="text-sm opacity-80 mt-1">Pekerja tiba di lokasi Anda.</p>
                <div class="absolute right-0 top-1/2 transform -translate-y-1/2 translate-x-1/2 hidden lg:block">
                    <svg class="w-8 h-8 text-yellow-500" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                    </svg>
                </div>
            </div>
            <div class="relative flex flex-col items-center">
                <div class="bg-yellow-500 p-4 rounded-full mb-3 shadow-lg">
                    <img :src="'/images/mulaikerja.svg'" alt="Pekerjaan Dimulai" class="h-8 w-8 text-green-900">
                </div>
                <p class="font-semibold text-lg">Pekerjaan Dimulai</p>
                <p class="text-sm opacity-80 mt-1">Pekerja segera memulai tugasnya.</p>
                <div class="absolute right-0 top-1/2 transform -translate-y-1/2 translate-x-1/2 hidden lg:block">
                    <svg class="w-8 h-8 text-yellow-500" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                    </svg>
                </div>
            </div>
            <div class="relative flex flex-col items-center">
                <div class="bg-yellow-500 p-4 rounded-full mb-3 shadow-lg">
                    <img :src="'/images/selesai.svg'" alt="Pekerjaan Selesai" class="h-8 w-8 text-green-900">
                </div>
                <p class="font-semibold text-lg">Pekerjaan Selesai</p>
                <p class="text-sm opacity-80 mt-1">Pekerja menyelesaikan tugas Anda.</p>
                <div class="absolute right-0 top-1/2 transform -translate-y-1/2 translate-x-1/2 hidden lg:block">
                    <svg class="w-8 h-8 text-yellow-500" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                    </svg>
                </div>
            </div>
            <div class="relative flex flex-col items-center">
                <div class="bg-yellow-500 p-4 rounded-full mb-3 shadow-lg">
                    <img :src="'/images/bayar.svg'" alt="Rating" class="h-8 w-8 text-green-900">
                </div>
                <p class="font-semibold text-lg">Pekerjaan Selesai & Rating</p>
                <p class="text-sm opacity-80 mt-1">Berikan penilaian setelah tugas selesai.</p>
                </div>
        </div>
    </div>
  </section>
</template>

<script>
export default {
  name: 'BookingFlow',
};
</script>

<style scoped>
/* Styling untuk garis panah */
/* Untuk panah vertikal pada mobile, Anda bisa menggunakan transform rotate */
/* .arrow-down {
  transform: rotate(90deg);
} */
</style>