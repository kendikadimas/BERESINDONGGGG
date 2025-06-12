<script setup>
import { ref } from 'vue';
import { Head, Link, router } from '@inertiajs/vue3';
import AppLayout from '../../js/components/layouts/AppLayout.vue'; // Pastikan path ini benar
import RatingModal from '@/components/RatingModal.vue';

// 1. Terima data 'user' dan 'orders' dari controller sebagai props
const props = defineProps({
    user: Object,
    orders: Array,
});

// State untuk mengontrol modal tetap sama
const showRatingModal = ref(false);
const selectedOrder = ref(null);

function openRatingModal(order) {
  selectedOrder.value = order;
  showRatingModal.value = true;
}

function closeModal() {
    showRatingModal.value = false;
    selectedOrder.value = null;
}

function handleRatingSubmit(ratingData) {
  if (!selectedOrder.value) return;
  
  // Mengirim data rating ke backend menggunakan Inertia
  router.post(route('ratings.store', selectedOrder.value.id), {
      ...ratingData, // Kirim rating dan comment
  }, {
      preserveScroll: true, // Agar halaman tidak scroll ke atas setelah submit
      onSuccess: () => {
        // Tutup modal dan refresh halaman untuk melihat perubahan
        closeModal();
      }
  });
}

// Fungsi untuk logout
function logout() {
    router.post(route('logout'));
}
</script>

<template>
    <Head :title="user.name + ' - Profil'" />
    <AppLayout>
        <div class="bg-gray-100">
            <div class="flex flex-col md:flex-row gap-8 p-4 md:p-8 lg:p-12">
                
                <div class="w-full md:w-1/4 bg-white rounded-lg shadow p-6 h-fit">
                    <h2 class="text-xl font-semibold mb-4">Profil</h2>
                    
                    <div class="mb-6">
                        <h3 class="font-medium text-lg mb-2">Profil Anda</h3>
                        <div class="space-y-2 text-gray-700 break-words">
                            <p><strong>Username:</strong> {{ user.name }}</p>
                            <p><strong>Email:</strong> {{ user.email }}</p>
                        </div>
                    </div>

                    <button @click="logout" class="w-full py-2 bg-red-500 text-white rounded hover:bg-red-600 transition">
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

                    <div v-if="orders.length > 0">
                        <div v-for="order in orders" :key="order.id" class="grid grid-cols-1 md:grid-cols-5 ...">
                        <div class="font-semibold">{{ order.worker.name }}</div>
                        <div>{{ new Date(order.schedule).toLocaleDateString('id-ID') }}</div>
                        <div>{{ order.service.category.name }}</div>
                        <div>{{ order.service.name }}</div>
                        <div class="text-center">

                            <div v-if="order.status === 'completed' && order.payment_status === 'unpaid'">
                                <Link 
                                    :href="route('checkout.create', order.id)" 
                                    method="post" 
                                    as="button"
                                    class="px-4 py-1.5 bg-green-600 text-white text-xs font-semibold rounded-md hover:bg-green-700 transition"
                                >
                                    Bayar Sekarang
                                </Link>
                            </div>

                            <div v-else-if="order.payment_status === 'paid'">
                                <span class="px-3 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">
                                    Lunas
                                </span>
                            </div>

                            <div v-else class="text-xs text-gray-500 capitalize">
                                {{ order.status }}
                            </div>

                        </div>
                    </div>
                    </div>
                    <div v-else class="text-center text-gray-500 py-8">
                        Anda belum memiliki riwayat pesanan.
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