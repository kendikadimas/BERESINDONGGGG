<script setup>
import { useForm } from '@inertiajs/vue3';
import { X } from 'lucide-vue-next'; // Ikon untuk tombol close

// Komponen ini menerima prop 'show' untuk mengontrol visibilitasnya
defineProps({
  show: {
    type: Boolean,
    default: false,
  },
});

// Komponen akan mengirim event 'close' saat modal ingin ditutup
const emit = defineEmits(['close']);

// Inisialisasi form Inertia
const form = useForm({
  comment: '',
});

// Fungsi submit sekarang juga akan menutup modal saat sukses
const submit = () => {
  form.post(route('testimonials.store'), {
    preserveScroll: true,
    onSuccess: () => {
      emit('close'); // Kirim event 'close' ke parent
    //   alert('Terima kasih! Testimoni Anda akan direview.');
      form.reset();
    },
  });
};
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
    <div v-if="show" class="fixed inset-0 z-50 flex items-center justify-center bg-black/70 backdrop-blur-sm p-4">
      
      <div class="w-full max-w-lg bg-white p-8 rounded-2xl shadow-xl relative">
        
        <button @click="emit('close')" class="absolute top-4 right-4 text-gray-400 hover:text-gray-700">
          <X class="w-6 h-6" />
        </button>

        <div class="space-y-6">
          <h2 class="text-3xl font-bold text-[#344c36] text-center">Bagikan Pengalaman Anda</h2>
          
          <form @submit.prevent="submit" class="mt-8 space-y-6">
            <div>
              <textarea 
                v-model="form.comment"
                rows="6"
                required
                placeholder="Tuliskan pengalaman Anda menggunakan layanan kami..."
                class="w-full bg-gray-200 border-none rounded-2xl px-6 py-4 text-gray-800 placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-yellow-500"
              ></textarea>
              <p v-if="form.errors.comment" class="text-sm text-red-600 mt-2">{{ form.errors.comment }}</p>
            </div>
            <div class="flex justify-end">
              <button type="submit" :disabled="form.processing" class="px-8 py-3 bg-yellow-500 text-white font-bold rounded-full hover:bg-yellow-600 transition-colors">
                Kirim Testimoni
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </Transition>
</template>