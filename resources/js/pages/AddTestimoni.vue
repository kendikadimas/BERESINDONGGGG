<script setup>
import { Head, useForm } from '@inertiajs/vue3';
import AppLayout from '@components/layouts/AppLayout.vue'; // Opsional, jika Anda mau ada header/footer

// Menggunakan useForm dari Inertia untuk menangani data dan state form
const form = useForm({
  name: '',
  message: '',
});

// Fungsi yang akan dipanggil saat form di-submit
const submit = () => {
  // Mengirim data form ke route Laravel yang bernama 'testimonials.store'
  // Anda perlu membuat route ini di file web.php
  form.post(route('testimonials.store'), {
    onSuccess: () => form.reset(), // Reset form jika berhasil
  });
};
</script>

<template>
  <Head title="Tambah Testimoni" />

  <AppLayout>
    <div class="flex items-center justify-center min-h-screen bg-[#344C36] py-12 px-4 sm:px-6 lg:px-8">
      
      <div class="w-full max-w-2xl space-y-8">
        
        <h1 class="text-3xl md:text-4xl font-bold text-white text-center">
          Tambah Testimoni Anda
        </h1>

        <form @submit.prevent="submit" class="mt-8 space-y-6">
          
          <div class="flex justify-center">
            <input 
              v-model="form.name"
              type="text" 
              name="name" 
              id="name" 
              required
              placeholder="Isi nama anda"
              class="w-full md:w-3/4 bg-gray-200 border-none rounded-full px-6 py-3 text-gray-800 placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-yellow-500 transition"
            >
          </div>

          <div>
            <textarea 
              v-model="form.message"
              name="message" 
              id="message" 
              rows="8"
              required
              placeholder="Isi pesan anda"
              class="w-full bg-gray-200 border-none rounded-2xl px-6 py-4 text-gray-800 placeholder-gray-500 resize-none focus:outline-none focus:ring-2 focus:ring-yellow-500 transition"
            ></textarea>
          </div>

          <div class="flex justify-end">
            <button 
              type="submit" 
              :disabled="form.processing"
              class="px-8 py-3 bg-yellow-500 text-gray-900 font-bold rounded-full hover:bg-yellow-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-800 focus:ring-yellow-500 transition-colors duration-300 disabled:opacity-50"
            >
              Kirim
            </button>
          </div>

        </form>
      </div>
    </div>
  </AppLayout>
</template>