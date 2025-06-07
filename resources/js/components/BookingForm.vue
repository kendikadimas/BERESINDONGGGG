<script setup>
import { Head } from '@inertiajs/vue3';
import AppLayout from '@components/layouts/AppLayout.vue'; // Asumsi Anda menggunakan layout ini

// Impor ikon dari lucide-vue-next
import {
  ChevronDown,
  Calendar,
  Clock,
  User,
  MapPin,
  Send,
  BookUser,
  Wrench,
  MessageSquareText,
} from 'lucide-vue-next';
</script>

<template>
  <Head title="Booking Form" />

  <AppLayout>
    <div class="bg-gray-50 flex items-center justify-center py-12 px-4">
      
      <div class="w-full max-w-2xl bg-white p-8 rounded-xl shadow-lg space-y-6">

        <h2 class="text-2xl font-bold text-center text-gray-800">Booking Form</h2>

        <div class="relative w-full">
          <select class="w-full bg-gray-100 border-none rounded-lg p-4 pl-5 text-gray-700 appearance-none focus:ring-2 focus:ring-green-800">
            <option disabled selected>Layanan yang dipilih</option>
            <option>Perbaikan Saluran Air</option>
            <option>Perbaikan Atap Bocor</option>
            <option>Pemasangan Keramik</option>
          </select>
          <ChevronDown class="absolute right-4 top-1/2 -translate-y-1/2 w-5 h-5 text-gray-400 pointer-events-none" />
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
          <div class="flex items-center bg-gray-100 rounded-lg p-4 gap-3">
            <Calendar class="w-5 h-5 text-gray-400" />
            <span class="text-gray-700">Pilih Jadwal</span>
          </div>
          <div class="flex items-center bg-gray-100 rounded-lg p-4 gap-3">
            <Clock class="w-5 h-5 text-gray-400" />
            <span class="text-gray-700">Pilih Waktu</span>
          </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
          <div class="flex items-center justify-between bg-gray-100 rounded-lg p-4">
            <div class="flex items-center gap-3">
              <User class="w-5 h-5 text-gray-400" />
              <span class="text-gray-700 font-medium">Abdul Jaenul</span>
            </div>
            <span class="text-sm font-bold text-gray-600">4.5</span>
          </div>
          <div class="flex items-center bg-gray-100 rounded-lg p-4 gap-3">
            <Wrench class="w-5 h-5 text-gray-400" />
            <span class="text-gray-700">Saluran Air</span>
          </div>
        </div>

        <div class="flex items-start bg-gray-100 rounded-lg p-4 gap-3">
          <MessageSquareText class="w-5 h-5 text-gray-400 mt-1 flex-shrink-0" />
          <textarea 
            placeholder="Isi deskripsi masalah anda"
            class="w-full bg-transparent outline-none text-gray-700 placeholder-gray-500 resize-none"
            rows="4"
          ></textarea>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 items-center">
          <div class="space-y-4">
            <div class="flex items-center bg-gray-100 rounded-lg p-4 gap-3">
              <BookUser class="w-5 h-5 text-gray-400" />
              <span class="text-gray-700">Dimas Kendika</span>
            </div>
            <div class="flex items-center bg-gray-100 rounded-lg p-4 gap-3">
              <MapPin class="w-5 h-5 text-gray-400" />
              <span class="text-gray-700">Jalan Belimbing, Karangkemiri</span>
            </div>
            <div class="flex items-center bg-gray-100 rounded-lg p-4 gap-3">
              <Send class="w-5 h-5 text-gray-400" />
              <span class="text-gray-700">Sebelah Balai Desa</span>
            </div>
          </div>
          <div class="w-full h-48 md:h-full rounded-lg overflow-hidden">
            <img src="/images/map-placeholder.png" alt="Peta Lokasi" class="w-full h-full object-cover">
          </div>
        </div>

        <button class="w-full bg-[#2A3C2D] text-white font-semibold py-4 rounded-lg text-lg hover:bg-[#38503D] transition-colors duration-300">
          Buat Pesanan
        </button>

      </div>
    </div>
  </AppLayout>
</template>

<style scoped>
/* Menghilangkan panah default pada select box di beberapa browser */
select {
  -webkit-appearance: none;
  -moz-appearance: none;
  appearance: none;
}
</style>