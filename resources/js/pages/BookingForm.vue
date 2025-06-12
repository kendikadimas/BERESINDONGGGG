<script setup>
import { Head, useForm } from '@inertiajs/vue3';
import AppLayout from '../../js/components/layouts/AppLayout.vue';
import { Calendar, Clock, User, Wrench, MessageSquareText, MapPin, CircleDollarSign } from 'lucide-vue-next';

// Terima props dari controller
const props = defineProps({
    selectedService: Object,
    selectedTukang: Object,
    offeringPrice: Number,
});

// Inisialisasi form
const form = useForm({
    service_id: props.selectedService?.id,
    tukang_id: props.selectedTukang?.id,
    schedule_date: '',
    schedule_time: '',
    problem_description: '',
    location: '',
    total_price: props.offeringPrice,
});

// Fungsi submit yang akan mengirim data ke backend
const submit = () => {
  // Cek sekali lagi jika ID tidak ada, mencegah error
  if (!form.service_id || !form.tukang_id) {
    alert('Informasi layanan atau tukang tidak lengkap. Silakan kembali dan pilih lagi.');
    return;
  }
  
  form.post(route('booking.store'), {
    preserveScroll: true,
    onSuccess: () => {
      // Tidak perlu melakukan apa-apa di sini, karena alur pembayaran
      // akan ditangani oleh AppLayout setelah controller me-redirect
      // dengan membawa snap_token.
    },
  });
};
</script>

<template>
    <Head title="Booking Form" />
    <AppLayout>
        <div class="bg-gray-50 flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
            <div class="w-full max-w-lg bg-white p-8 rounded-xl shadow-lg space-y-6">
                
                <h2 class="text-3xl font-bold text-center text-gray-800">Booking Form</h2>

                <form v-if="selectedService && selectedTukang" @submit.prevent="submit" class="space-y-5">
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="flex items-center bg-gray-100 rounded-lg p-4 gap-3 border">
                            <Wrench class="w-5 h-5 text-gray-500" />
                            <span class="text-gray-800 font-medium">{{ selectedService.name }}</span>
                        </div>
                        <div class="flex items-center bg-gray-100 rounded-lg p-4 gap-3 border">
                            <User class="w-5 h-5 text-gray-500" />
                            <span class="text-gray-800 font-medium">{{ selectedTukang.name }}</span>
                        </div>
                    </div>

                    <div class="flex items-center bg-green-50 border border-green-200 rounded-lg p-4 gap-3">
                        <CircleDollarSign class="w-5 h-5 text-green-600" />
                        <span class="text-green-800 font-semibold">Harga Layanan: Rp {{ offeringPrice.toLocaleString('id-ID') }}</span>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label for="schedule_date" class="text-sm font-medium text-gray-700">Pilih Jadwal</label>
                            <div class="relative mt-1">
                                <Calendar class="absolute left-4 top-1/2 -translate-y-1/2 w-5 h-5 text-gray-400 pointer-events-none" />
                                <input v-model="form.schedule_date" id="schedule_date" type="date" required class="w-full bg-gray-100 border-2 rounded-lg p-4 pl-12 text-gray-700 focus:ring-2 focus:ring-green-800 focus:border-transparent transition">
                            </div>
                        </div>
                         <div>
                            <label for="schedule_time" class="text-sm font-medium text-gray-700">Pilih Waktu</label>
                            <div class="relative mt-1">
                                <Clock class="absolute left-4 top-1/2 -translate-y-1/2 w-5 h-5 text-gray-400 pointer-events-none" />
                                <input v-model="form.schedule_time" id="schedule_time" type="time" required class="w-full bg-gray-100 border-2 rounded-lg p-4 pl-12 text-gray-700 focus:ring-2 focus:ring-green-800 focus:border-transparent transition">
                            </div>
                        </div>
                    </div>

                    <div>
                        <label for="description" class="text-sm font-medium text-gray-700">Isi deskripsi masalah anda</label>
                        <textarea v-model="form.problem_description" id="description" placeholder="Contoh: AC tidak dingin..." required rows="4" class="mt-1 w-full bg-gray-100 border-2 rounded-lg p-4 text-gray-700 focus:ring-2 focus:ring-green-800 ..."></textarea>
                         <p v-if="form.errors.problem_description" class="text-sm text-red-600 mt-1">{{ form.errors.problem_description }}</p>
                    </div>
                     <div>
                        <label for="location" class="text-sm font-medium text-gray-700">Isi alamat lengkap Anda</label>
                        <input v-model="form.location" id="location" type="text" placeholder="Contoh: Jl. Merdeka No. 12..." required class="mt-1 w-full bg-gray-100 border-2 rounded-lg p-4 ...">
                         <p v-if="form.errors.location" class="text-sm text-red-600 mt-1">{{ form.errors.location }}</p>
                    </div>
                    
                    <button type="submit" :disabled="form.processing" class="w-full bg-[#2A3C2D] text-white font-bold py-3 ...">
                        <span v-if="form.processing">Memproses...</span>
                        <span v-else>Lanjut ke Pembayaran</span>
                    </button>
                </form>
                 <div v-else class="text-center text-red-600 border border-red-300 p-4 rounded-lg">
                    <p class="font-bold">Error: Data Tidak Lengkap</p>
                    <p class="text-sm">Silakan kembali dan pilih layanan serta tukang terlebih dahulu.</p>
                </div>
            </div>
        </div>
    </AppLayout>
</template>