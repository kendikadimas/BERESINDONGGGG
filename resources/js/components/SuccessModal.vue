<script setup>
import { Check } from 'lucide-vue-next';
import { Transition } from 'vue';

// Komponen ini menerima 'props' untuk mengontrol visibilitas dan pesannya
defineProps({
  show: {
    type: Boolean,
    default: false,
  },
  title: {
    type: String,
    default: 'Berhasil!',
  },
  message: {
    type: String,
    required: true,
  },
});

// Komponen ini akan mengirim event 'close' saat tombol "Kembali" diklik
const emit = defineEmits(['close']);
</script>

<template>
  <Transition
    enter-active-class="transition ease-out duration-200"
    enter-from-class="transform opacity-0 scale-95"
    enter-to-class="transform opacity-100 scale-100"
    leave-active-class="transition ease-in duration-75"
    leave-from-class="transform opacity-100 scale-100"
    leave-to-class="transform opacity-0 scale-95"
  >
    <div v-if="show" class="fixed inset-0 z-50 flex items-center justify-center bg-black/60 backdrop-blur-sm">
      
      <div class="w-full max-w-md bg-white p-8 rounded-2xl shadow-xl text-center flex flex-col items-center">
        
        <div class="bg-[#2A3C2D] p-5 rounded-2xl inline-block mb-4">
          <Check class="w-12 h-12 text-white" />
        </div>
        
        <h2 class="text-3xl font-bold text-gray-900 mb-2">{{ title }}</h2>
        
        <p class="text-lg text-gray-600 mb-8">
          {{ message }}
        </p>
        
        <button
          @click="emit('close')"
          class="bg-[#2A3C2D] text-white font-semibold py-3 px-10 rounded-lg hover:bg-[#38503D] transition-colors duration-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-800"
        >
          Kembali
        </button>

      </div>
    </div>
  </Transition>
</template>