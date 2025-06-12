<script setup>
defineProps({
  name: {
    type: String,
    required: true,
  },
  specialty: {
    type: String,
    required: true,
  },
  imageUrl: {
    type: [String, null],
    required: false,
  },
  rating: {
    type: Number,
    required: true,
  },
});
</script>

<template>
  <div class="group relative aspect-[3/4] w-full overflow-hidden rounded-xl shadow-lg transition-all duration-300 hover:shadow-2xl hover:scale-105">
    
    <div 
      class="absolute inset-0 bg-cover bg-center transition-transform duration-300 group-hover:scale-110"
      :style="{ backgroundImage: `url(${imageUrl || '/images/default-avatar.png'})` }" 
    >
      </div>

    <div class="absolute top-3 right-3 flex items-center gap-1 rounded-full bg-black/50 px-3 py-1 text-white backdrop-blur-sm">
      <span class="font-bold">{{ rating }}</span>
      <span class="text-yellow-400 text-lg">★</span>
    </div>

    <div class="absolute inset-0 flex flex-col justify-end bg-gradient-to-t from-black/80 via-black/40 to-transparent p-4 md:p-6">
      <div class="text-white">
        <h3 class="text-xl md:text-2xl font-bold leading-tight">{{ name }}</h3>
        <p class="mt-1 text-sm md:text-base opacity-90">{{ specialty }}</p>
      </div>
    </div>
  </div>
</template>