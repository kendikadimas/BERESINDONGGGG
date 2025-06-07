<script setup>
import { ref } from 'vue';

// Komponen ini menerima 'props' untuk mengontrol visibilitasnya
defineProps({
  show: {
    type: Boolean,
    default: false,
  },
});

// Komponen ini akan mengirim event 'close' dan 'submit'
const emit = defineEmits(['close', 'submit']);

// State internal untuk komponen ini
const rating = ref(0); // Menyimpan rating yang sudah diklik
const hoverRating = ref(0); // Menyimpan rating saat mouse hover
const comment = ref(''); // Menyimpan isi textarea

// Fungsi untuk mengatur rating saat bintang diklik
function setRating(value) {
  rating.value = value;
}

// Fungsi untuk mengirim data rating dan menutup modal
function submitRating() {
  if (rating.value === 0) {
    alert('Mohon berikan minimal 1 bintang.');
    return;
  }
  emit('submit', {
    rating: rating.value,
    comment: comment.value,
  });
}
</script>

<template>
  <Transition
    enter-active-class="transition ease-out duration-200"
    enter-from-class="transform opacity-0"
    enter-to-class="transform opacity-100"
    leave-active-class="transition ease-in duration-200"
    leave-from-class="transform opacity-100"
    leave-to-class="transform opacity-0"
  >
    <div v-if="show" @click.self="emit('close')" class="fixed inset-0 z-50 flex items-center justify-center bg-black/70 backdrop-blur-sm p-4">
      
      <div class="w-full max-w-md bg-[#344C36] p-8 rounded-2xl shadow-xl text-center flex flex-col items-center">
        
        <h2 class="text-2xl font-bold text-white mb-6">Rating Pekerjaan Tukang</h2>
        
        <div class="flex items-center space-x-2 mb-6" @mouseleave="hoverRating = 0">
          <svg 
            v-for="star in 5" 
            :key="star"
            @mouseover="hoverRating = star"
            @click="setRating(star)"
            xmlns="http://www.w3.org/2000/svg" 
            viewBox="0 0 24 24" 
            fill="currentColor" 
            class="w-10 h-10 md:w-12 md:h-12 cursor-pointer transition-colors duration-150"
            :class="star <= (hoverRating || rating) ? 'text-yellow-400' : 'text-gray-400'"
          >
            <path fill-rule="evenodd" d="M10.788 3.21c.448-1.077 1.976-1.077 2.424 0l2.082 5.007 5.404.433c1.164.093 1.636 1.545.749 2.305l-4.117 3.527 1.257 5.273c.271 1.136-.964 2.033-1.96 1.425L12 18.354 7.373 21.18c-.996.608-2.231-.29-1.96-1.425l1.257-5.273-4.117-3.527c-.887-.76-.415-2.212.749-2.305l5.404-.433 2.082-5.007z" clip-rule="evenodd" />
          </svg>
        </div>
        
        <textarea 
          v-model="comment"
          placeholder="Tambahkan Pesan"
          rows="4"
          class="w-full bg-gray-200 border-none rounded-xl p-4 text-gray-800 placeholder-gray-500 resize-none focus:outline-none focus:ring-2 focus:ring-yellow-500 transition"
        ></textarea>

        <div class="w-full flex justify-end mt-6">
          <button 
            @click="submitRating"
            class="px-8 py-2.5 bg-yellow-500 text-gray-900 font-bold rounded-full hover:bg-yellow-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-800 focus:ring-yellow-500 transition-colors duration-300"
          >
            Kirim
          </button>
        </div>
      </div>
    </div>
  </Transition>
</template>