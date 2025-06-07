<script setup>
import { ref } from 'vue';
import AppLayout from '@/layouts/AppLayout.vue'; // Pastikan path ini benar
import RatingModal from '@/components/RatingModal.vue'; // 1. Impor komponen modal

// State untuk mengontrol modal
const showRatingModal = ref(false);
const selectedOrder = ref(null);

// Data riwayat pesanan (dummy)
// Di aplikasi nyata, ini akan datang dari controller sebagai props
const orders = ref([
    { id: 1, worker: 'Ahmad Jaenal', date: '12/12/24', category: 'Repairing', service: 'Tembok', rated: false, rating: 0 },
    { id: 2, worker: 'Siti Aminah', date: '15/11/24', category: 'Cleaning', service: 'Full House', rated: true, rating: 5 },
    { id: 3, worker: 'Budi Perkasa', date: '01/10/24', category: 'Repairing', service: 'Pipa Air', rated: false, rating: 0 },
]);

// Fungsi untuk membuka modal dan menyimpan data pesanan yang dipilih
function openRatingModal(order) {
  selectedOrder.value = order;
  showRatingModal.value = true;
}

// Fungsi yang dipanggil saat rating dari modal dikirim
function handleRatingSubmit(ratingData) {
  console.log('Rating diterima:', ratingData);
  console.log('Untuk pesanan ID:', selectedOrder.value.id);

  // Di sini Anda akan mengirim data ke backend menggunakan Inertia.post()
  // Contoh: router.post(route('orders.rate', selectedOrder.value.id), ratingData)

  // Untuk sekarang, kita hanya simulasikan di frontend
  const orderToUpdate = orders.value.find(o => o.id === selectedOrder.value.id);
  if (orderToUpdate) {
    orderToUpdate.rated = true;
    orderToUpdate.rating = ratingData.rating;
  }
  
  // Tutup modal setelah submit
  closeModal();
}

function closeModal() {
    showRatingModal.value = false;
    selectedOrder.value = null;
}
</script>

<template>
    <AppLayout>
        <div class="bg-gray-100">
            <div class="flex flex-col md:flex-row gap-8 p-4 md:p-8 lg:p-12">
                <div class="w-full md:w-1/4 bg-white rounded-lg shadow p-6 h-fit">
                <h2 class="text-xl font-semibold mb-4">Profil</h2>
                
                <div class="mb-6">
                    <h3 class="font-medium text-lg mb-2">Profil Anda</h3>
                    <div class="space-y-2 text-gray-700">
                    <p>Username: Dimas Kendika</p>
                    <p>Email: dimas.k@example.com</p>
                    <a href="#" class="block text-blue-600 hover:underline text-sm">Edit Profil</a>
                    </div>
                </div>

                <button class="w-full py-2 bg-red-500 text-white rounded hover:bg-red-600 transition">
                    LOGOUT
                </button>
                </div>

                <div class="w-full md:w-3/4 bg-white rounded-lg shadow p-6">
                <h2 class="text-xl font-semibold mb-6">Riwayat Pesanan</h2>

                <div class="hidden md:grid grid-cols-5 gap-4 font-bold text-gray-600 mb-4 pb-2 border-b">
                    <div>Pekerja</div>
                    <div>Tanggal</div>
                    <div>Kategori</div>
                    <div>Layanan</div>
                    <div class="text-center">Rating</div>
                </div>

                <div v-for="order in orders" :key="order.id" class="grid grid-cols-1 md:grid-cols-5 gap-4 py-4 border-b items-center text-sm text-gray-800">
                    <div class="font-semibold">{{ order.worker }}</div>
                    <div>{{ order.date }}</div>
                    <div>{{ order.category }}</div>
                    <div>{{ order.service }}</div>
                    <div class="text-center">
                    <button v-if="!order.rated" @click="openRatingModal(order)" class="px-4 py-1.5 bg-blue-500 text-white text-xs font-semibold rounded-md hover:bg-blue-600 transition">
                        Rate
                    </button>
                    <div v-else class="flex items-center justify-center text-yellow-400 font-bold gap-1">
                        {{ order.rating }} <span class="text-lg">★</span>
                    </div>
                    </div>
                </div>
                </div>
            </div>
        </div>
    </AppLayout>

    <RatingModal 
        :show="showRatingModal"
        @close="closeModal"
        @submit="handleRatingSubmit"
    />
</template>