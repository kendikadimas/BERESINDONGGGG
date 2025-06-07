<script setup>
import { ref } from 'vue'; // 1. Impor 'ref' untuk state management
import { Head, useForm } from '@inertiajs/vue3';
import AppLayout from '@/layouts/AppLayout.vue';
import SuccessModal from '@/components/SuccessModal.vue'; // 2. Impor komponen modal kita

// Impor ikon-ikon yang akan kita gunakan
import { ChevronDown, FileText, Globe } from 'lucide-vue-next';

// State untuk mengontrol visibilitas modal
const showSuccessModal = ref(false); // 3. Buat state untuk menampilkan/menyembunyikan modal

const form = useForm({
  name: '',
  description: '',
  proof_photo: null,
});

const fileInput = ref(null);

function handleFileChange(event) {
  const file = event.target.files[0];
  if (!file) return;
  form.proof_photo = file;
}

const submit = () => {
  form.post(route('warranty.claim.store'), {
    onSuccess: () => {
      form.reset(); // Reset form setelah berhasil
      showSuccessModal.value = true; // 4. Tampilkan modal saat sukses!
    },
  });
};

// Fungsi untuk menutup modal
const closeModal = () => { // 5. Buat fungsi untuk menutup modal
    showSuccessModal.value = false;
};
</script>

<template>
  <Head title="Bantuan Darurat" />

  <AppLayout>
    <div class="bg-gray-100 flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
      
      <div class="w-full max-w-lg bg-white p-8 md:p-10 rounded-xl shadow-lg space-y-8">
        <h2 class="text-3xl font-bold text-center text-gray-900">
          Emergency Help Form
        </h2>
        <form @submit.prevent="submit" class="space-y-6">
          <div class="relative w-full">
            <select
              class="w-full bg-gray-100 border-2 border-gray-200 rounded-lg p-4 text-gray-700 appearance-none focus:outline-none focus:ring-2 focus:ring-green-800 focus:border-transparent"
            >
              <option disabled selected>Pilih Kategori Layanan</option>
              <option value="pipa-bocor">Pipa Bocor</option>
              <option value="listrik-padam">Listrik Padam</option>
              <option value="kunci-rusak">Kunci Rusak</option>
              <option value="lainnya">Lainnya</option>
            </select>
            <ChevronDown class="absolute right-4 top-1/2 -translate-y-1/2 w-6 h-6 text-gray-400 pointer-events-none" />
          </div>

          <div class="flex items-start bg-gray-100 border-2 border-gray-200 rounded-lg p-4 gap-4 focus-within:ring-2 focus-within:ring-green-800 focus-within:border-transparent">
            <FileText class="w-6 h-6 text-gray-400 mt-1 flex-shrink-0" />
            <textarea 
              placeholder="Isi Deskripsi Masalah"
              class="w-full h-32 bg-transparent outline-none text-gray-700 placeholder-gray-500 resize-none"
              rows="4"
            ></textarea>
          </div>

          <div class="border-2 border-gray-200 rounded-lg p-4 space-y-3">
            <div class="flex items-center gap-4">
              <Globe class="w-6 h-6 text-gray-400" />
              <span class="text-gray-700 font-medium">Pilih Lokasi</span>
            </div>
            <div class="w-full h-56 rounded-md overflow-hidden">
              <img src="/images/map-placeholder.png" alt="Peta Lokasi" class="w-full h-full object-cover">
            </div>
          </div>
          
          <button
            type="submit"
            :disabled="form.processing"
            class="w-full bg-[#2A3C2D] text-white font-bold py-4 px-4 rounded-lg text-lg hover:bg-[#38503D] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-800 transition-all duration-300"
          >
            Kirim Bantuan Segera
          </button>
        </form>
      </div>
    </div>
  </AppLayout>

  <SuccessModal 
    :show="showSuccessModal" 
    message="Bantuan akan segera dikirimkan!"
    @close="closeModal"
  />

</template>