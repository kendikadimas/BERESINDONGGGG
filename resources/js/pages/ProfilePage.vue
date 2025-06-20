<script setup>
import { ref } from 'vue';
import { Head, Link, router } from '@inertiajs/vue3';
import AppLayout from '../../js/components/layouts/AppLayout.vue';
import RatingModal from '@/components/RatingModal.vue';

const props = defineProps({
    user: Object,
    orders: Array,
});

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
  
  router.post(route('ratings.store', { order: selectedOrder.value.id }), {
      rating: ratingData.rating,
      comment: ratingData.comment,
  }, {
      preserveScroll: true,
      onSuccess: () => closeModal(),
  });
}

function logout() {
    router.post(route('logout'));
}

// Fungsi untuk menghasilkan array bintang
function getStarArray(rating) {
    const stars = [];
    for (let i = 1; i <= 5; i++) {
        stars.push(i <= rating ? 'filled' : 'empty');
    }
    return stars;
}
</script>

<template>
    <Head :title="user.name + ' - Profil'" />
    <AppLayout>
        <div class="bg-gray-100 min-h-screen">
            <div class="flex flex-col md:flex-row gap-8 p-4 md:p-8 lg:p-12">
                <!-- Bagian Informasi Akun -->
                <div class="w-full md:w-1/4 bg-white rounded-lg shadow p-6 h-fit">
                    <div class="flex flex-col items-center">
                        <img 
                            v-if="user.avatar_path" 
                            :src="user.avatar_path" 
                            alt="Avatar" 
                            class="w-24 h-24 rounded-full mb-4 object-cover"
                        />
                        <div v-else class="w-24 h-24 rounded-full mb-4 bg-gray-200 flex items-center justify-center">
                            <span class="text-2xl text-gray-500">{{ user.name.charAt(0).toUpperCase() }}</span>
                        </div>
                        <h2 class="text-xl text-gray-700 font-semibold">{{ user.name }}</h2>
                        <p class="text-gray-600">{{ user.email }}</p>
                        <p v-if="user.phone" class="text-gray-600">{{ user.phone }}</p>
                        <p v-if="user.address" class="text-gray-600 text-center">{{ user.address }}</p>
                        <p v-if="user.role === 'tukang' && user.skill" class="text-gray-600 mt-2">
                            Keahlian: {{ user.skill }}
                        </p>
                        <button 
                            @click="logout" 
                            class="mt-4 px-4 py-2 bg-red-500 text-white rounded-md hover:bg-red-600 transition"
                        >
                            Keluar
                        </button>
                    </div>
                </div>

                <!-- Bagian Riwayat Pesanan -->
                <div class="w-full md:w-3/4 bg-white rounded-lg shadow p-6">
                    <h2 class="text-xl font-semibold mb-6">Riwayat Pesanan</h2>

                    <div class="hidden md:grid grid-cols-5 gap-4 bg-gray-50 p-3 rounded-md font-semibold text-gray-600">
                        <div>Penyedia Jasa</div>
                        <div>Tanggal</div>
                        <div>Kategori</div>
                        <div>Layanan</div>
                        <div class="text-center">Rating</div>
                    </div>

                    <div v-if="orders.length > 0">
                        <div v-for="order in orders" :key="order.id" class="grid grid-cols-1 md:grid-cols-5 gap-4 p-3 border-b last:border-b-0 hover:bg-gray-50 text-gray-700">
                            <div class="font-semibold">{{ order.worker?.name ?? 'N/A' }}</div>
                            <div>{{ new Date(order.schedule).toLocaleDateString('id-ID') }}</div>
                            <div>{{ order.service?.category?.name ?? 'N/A' }}</div>
                            <div>{{ order.service?.name ?? 'N/A' }}</div>
                            <div class="text-center">
                                <div v-if="order.rating" class="flex items-center justify-center gap-1">
                                    <span v-for="(star, index) in getStarArray(order.rating.rating)" :key="index">
                                        <svg v-if="star === 'filled'" class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                        </svg>
                                        <svg v-else class="w-5 h-5 text-gray-300" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                        </svg>
                                    </span>
                                </div>
                                <button v-else @click="openRatingModal(order)" class="px-4 py-1.5 bg-blue-500 text-white text-xs font-semibold rounded-md hover:bg-blue-600 transition">
                                    Beri Rating
                                </button>
                            </div>
                        </div>
                    </div>
                    <div v-else class="text-center text-gray-500 py-8">
                        Belum ada riwayat pesanan
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