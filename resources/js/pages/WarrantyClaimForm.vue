<script setup>
import { ref } from 'vue';
import { Head, useForm } from '@inertiajs/vue3';
import AppLayout from '@/layouts/AppLayout.vue'; // Opsional, jika Anda mau ada header/footer

// Impor ikon dari lucide-vue-next
import { UploadCloud, PencilLine } from 'lucide-vue-next';

// Menggunakan useForm dari Inertia. Untuk file, inisialisasi dengan null.
const form = useForm({
  name: '',
  description: '',
  proof_photo: null, // Untuk menampung file yang di-upload
});

// ref untuk mengakses elemen input file secara terprogram
const fileInput = ref(null);

// Fungsi untuk menampilkan preview gambar dan menyimpannya di form state
function handleFileChange(event) {
  const file = event.target.files[0];
  if (!file) return;
  
  form.proof_photo = file;
}

// Fungsi yang akan dipanggil saat form di-submit
const submit = () => {
  // Inertia secara otomatis akan mengirim form sebagai multipart/form-data
  // karena ada objek File di dalamnya.
  form.post(route('warranty.claim.store'), {
    onSuccess: () => form.reset(), // Reset form jika berhasil
  });
};
</script>

<template>
  <Head title="Ajukan Klaim Garansi" />

  <AppLayout>
    <div class="flex items-center justify-center min-h-screen bg-[#344C36] py-12 px-4 sm:px-6 lg:px-8">
      
      <div class="w-full max-w-3xl space-y-8">
        
        <h1 class="text-3xl md:text-4xl font-bold text-white text-center">
          Ajukan Klaim Garansi
        </h1>

        <form @submit.prevent="submit" class="mt-8 space-y-6">
          
          <div class="flex justify-center">
            <input 
              v-model="form.name"
              type="text" 
              required
              placeholder="Isi nama anda"
              class="w-full md:w-2/3 bg-gray-200 border-none rounded-full px-6 py-4 text-gray-800 placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-yellow-500 transition"
            >
          </div>

          <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            
            <div class="bg-gray-200 rounded-2xl p-6 flex flex-col space-y-4">
              <h3 class="font-bold text-gray-800">Upload Bukti Kerusakan</h3>
              <div 
                @click="fileInput.click()" 
                class="flex-1 border-2 border-dashed border-gray-400 rounded-xl flex flex-col justify-center items-center text-center p-6 cursor-pointer hover:bg-gray-300 transition"
              >
                <img v-if="form.proof_photo" :src="URL.createObjectURL(form.proof_photo)" class="max-h-48 mb-4 rounded-md object-contain" alt="Preview Bukti">
                
                <div v-else class="space-y-2">
                    <button type="button" class="bg-[#2A3C2D] text-white font-semibold py-2 px-6 rounded-lg hover:bg-[#38503D] transition">
                        Upload Foto
                    </button>
                </div>
                <input type="file" ref="fileInput" @change="handleFileChange" class="hidden" accept="image/*">
              </div>
            </div>

            <div class="bg-gray-200 rounded-2xl p-6 flex flex-col space-y-4">
              <h3 class="font-bold text-gray-800">Deskripsi Kerusakan</h3>
              <div class="flex-1 bg-white rounded-xl p-4">
                <textarea 
                  v-model="form.description"
                  required
                  placeholder="Jelaskan detail kerusakan di sini..."
                  class="w-full h-full bg-transparent outline-none text-gray-700 placeholder-gray-500 resize-none"
                ></textarea>
              </div>
            </div>
          </div>
          
          <div class="flex justify-end pt-4">
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