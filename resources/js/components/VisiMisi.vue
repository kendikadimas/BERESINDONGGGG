<script setup>
// Komponen ini menerima dua props: 'visi' (sebuah string) dan 'misi' (sebuah array)
defineProps({
  visi: {
    type: String,
    required: true,
  },
  misi: {
    type: Array,
    required: true,
  },
});
</script>

<template>
  <section>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
      <div class="bg-[#344C36] text-white p-8 rounded-lg shadow-md">
        <h3 class="text-2xl font-bold mb-4">Visi</h3>
        <p class="opacity-90 leading-relaxed">{{ visi }}</p>
      </div>
      <div class="bg-[#344C36] text-white p-8 rounded-lg shadow-md">
        <h3 class="text-2xl font-bold mb-4">Misi</h3>
        <ul class="space-y-2 list-disc list-inside opacity-90">
          <li v-for="(item, index) in misi" :key="index">{{ item }}</li>
        </ul>
      </div>
    </div>
  </section>
</template>