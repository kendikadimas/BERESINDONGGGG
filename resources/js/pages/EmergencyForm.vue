<script setup>
import { Head, useForm } from '@inertiajs/vue3';
import AppLayout from '../../js/components/layouts/AppLayout.vue';
import { FileText, Camera } from 'lucide-vue-next';

// Form hanya berisi deskripsi dan foto
const form = useForm({
  description: '',
  photo: null, // untuk menampung file foto
});

const submit = () => {
  // Kirim data ke route 'emergency.store' yang sudah kita buat
  form.post(route('emergency.store'), {
    // Setelah sukses, kita bisa arahkan user ke halaman lain atau tampilkan notifikasi
    onSuccess: () => alert('Permintaan Terkirim!'),
  });
};
</script>

<template>
    <Head title="Bantuan Darurat" />

    <AppLayout>
        <div class="bg-gray-100 flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
            <div class="w-full max-w-lg bg-white p-8 md:p-10 rounded-xl shadow-lg space-y-8">
                <h2 class="text-3xl font-bold text-center text-gray-900">
                    Form Bantuan Darurat
                </h2>
                <p class="text-center text-gray-600">Jelaskan masalah Anda. Permintaan akan dikirim ke semua tukang yang tersedia.</p>

                <form @submit.prevent="submit" class="space-y-6">
                    <div>
                        <label for="description" class="font-medium text-gray-700">Deskripsi Masalah (Wajib)</label>
                        <div class="mt-2 flex items-start bg-gray-100 border-2 border-gray-200 rounded-lg p-4 gap-4 focus-within:ring-2 focus-within:ring-green-800">
                            <FileText class="w-6 h-6 text-gray-400 mt-1 flex-shrink-0" />
                            <textarea
                                v-model="form.description"
                                id="description"
                                required
                                placeholder="Contoh: Terjadi korsleting listrik di ruang utama, meteran turun terus."
                                class="w-full h-32 bg-transparent outline-none text-gray-700 placeholder-gray-500 resize-none"
                            ></textarea>
                        </div>
                         <p v-if="form.errors.description" class="text-sm text-red-600 mt-1">{{ form.errors.description }}</p>
                    </div>

                    <div>
                        <label for="photo" class="font-medium text-gray-700">Upload Foto Bukti (Opsional)</label>
                        <div class="mt-2 flex items-center justify-center w-full">
                            <label for="photo" class="flex flex-col items-center justify-center w-full h-40 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 hover:bg-gray-100">
                                <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                    <Camera class="w-10 h-10 mb-3 text-gray-400" />
                                    <p v-if="!form.photo" class="mb-2 text-sm text-gray-500"><span class="font-semibold">Klik untuk upload</span> atau seret file</p>
                                    <p v-if="form.photo" class="mb-2 text-sm text-green-600 font-semibold">{{ form.photo.name }}</p>
                                    <p class="text-xs text-gray-400">PNG, JPG, atau JPEG (MAX. 2MB)</p>
                                </div>
                                <input id="photo" type="file" @input="form.photo = $event.target.files[0]" class="hidden" />
                            </label>
                        </div>
                        <p v-if="form.errors.photo" class="text-sm text-red-600 mt-1">{{ form.errors.photo }}</p>
                    </div>
                    
                    <button type="submit" :disabled="form.processing" class="w-full bg-[#2A3C2D] text-white ...">
                        Kirim Permintaan Segera
                    </button>
                </form>
            </div>
        </div>
    </AppLayout>
</template>