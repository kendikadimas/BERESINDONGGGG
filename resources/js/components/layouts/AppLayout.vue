<script setup>
import { computed, watch } from 'vue';
import { Link, usePage, router } from '@inertiajs/vue3';

// Mengambil data user yang sedang login dari props global Inertia
const user = computed(() => usePage().props.auth.user);

// "Listener" ini akan mengawasi snap_token dari Midtrans
watch(
  () => usePage().props.flash,
  (flash) => {
    // TES 1: Cek apakah watcher ini berjalan
    console.log("--- Watcher di AppLayout Berjalan ---");
    console.log("Data flash yang diterima:", flash);

    if (flash && flash.snap_token) {
      // TES 2: Cek apakah snap_token terdeteksi
      console.log("✅ SNAP TOKEN DITEMUKAN:", flash.snap_token);

      // TES 3: Cek apakah library Midtrans (snap) sudah siap
      if (window.snap) {
        console.log("✅ window.snap SIAP. Memanggil popup...");
        window.snap.pay(flash.snap_token, {
          onSuccess: (result) => {
            alert("Pembayaran Berhasil!");
            router.visit(route('profile'));
          },
          // ... callback lainnya
        });
      } else {
        console.error("❌ ERROR: window.snap tidak ditemukan. Periksa script Midtrans di app.blade.php.");
      }
    } else {
      console.log("ℹ️ Tidak ada snap_token di dalam flash message kali ini.");
    }
  },
  { deep: true }
);

// Fungsi logout
const handleLogout = () => {
    router.post(route('logout'));
};
</script>

<template>
  <div class="flex flex-col min-h-screen font-sans">
    <header class="bg-[#344C36] shadow-md py-4 sticky top-0 z-50">
      <div class="container mx-auto px-6 flex items-center justify-between">
        
        <div class="flex-shrink-0">
          <Link :href="route('home')">
            <div class="flex items-center">
              <div class="text-2xl font-bold text-white">BERESIN</div>
              <span class="text-2xl font-bold text-[#F9AD19]">DONG</span>
            </div>
          </Link>
        </div>

        <nav class="hidden md:flex flex-grow justify-center">
          <ul class="flex items-center space-x-8 text-base">
            <li><Link :href="route('repairing')" class="text-white hover:text-yellow-400 transition-colors">Repairing</Link></li>
            <li><Link :href="route('cleaning')" class="text-white hover:text-yellow-400 transition-colors">Cleaning</Link></li>
            <li><Link :href="route('partner.apply')" class="text-white hover:text-yellow-400 transition-colors">Jadi Mitra</Link></li>
            <li><Link :href="route('about')" class="text-white hover:text-yellow-400 transition-colors">About Us</Link></li>
          </ul>
        </nav>
        
        <div class="hidden md:flex w-64 flex-shrink-0 items-center justify-end">
          
          <div v-if="user" class="flex items-center space-x-4">
            <span class="text-white text-sm font-medium truncate">Halo, {{ user.name }}</span>
            <Link :href="route('profile')">
               <img 
                  :src="user.avatar_path ? user.avatar_path : '/images/default.jpg'" 
                  alt="Avatar" 
                  class="w-11 h-11 rounded-full object-cover border-2 border-yellow-500"
               >
            </Link>
            </div>

          <div v-else class="flex items-center space-x-4">
            <Link :href="route('login')">
              <button class="bg-yellow-500 hover:bg-yellow-600 text-green-900 font-semibold py-2 px-6 rounded-full text-sm shadow-md transition-all">
                Login
              </button>
            </Link>
            <Link :href="route('register')">
              <button class="bg-transparent border border-yellow-500 text-yellow-500 hover:bg-yellow-500 hover:text-green-900 font-semibold py-2 px-6 rounded-full text-sm transition-all">
                Register
              </button>
            </Link>
          </div>
        </div>

        <div class="md:hidden">
          <button class="text-white focus:outline-none">
            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path></svg>
          </button>
        </div>

      </div>
    </header>

    <main class="flex-grow">
      <slot></slot>
    </main>

    <footer class="bg-[#344C36] text-white py-8">
      <div class="container mx-auto px-4">
      <hr class="border-white my-6">
      <div class="flex justify-between items-start my-10 ml-15">
          <div class="flex items-center ml-10 mt-16">
              <h1 class="text-5xl font-bold mb-2 p-3/4 text-white">BERESIN</h1>
                <span class="text-5xl text-[#F9AD19] mb-2 p-3/4 font-bold">DONG</span>
          </div>
          <div class="max-w-md mx-auto my-3 mr-25">
            <div class="text-white space-y-4">
              <p class="flex items-center text-sm font-medium">
              <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 384 512" class="mr-3" fill="#F9AD19"><path d="M215.7 499.2C267 435 384 279.4 384 192C384 86 298 0 192 0S0 86 0 192c0 87.4 117 243 168.3 307.2c12.3 15.3 35.1 15.3 47.4 0zM192 128a64 64 0 1 1 0 128 64 64 0 1 1 0-128z"/></svg>
              Jl. Raya Mayjen Sungkono No.KM 5, Dusun 2, Blater, Kec. Kalimanah, Kabupaten Purbalingga, Jawa Tengah 53371
            </p>
              
            <div class="flex items-center text-sm font-medium py-6">
              <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512" width="24" height="24" class="mr-3" fill="#F9AD19">
                <path d="M208 352c114.9 0 208-78.8 208-176S322.9 0 208 0S0 78.8 0 176c0 38.6 14.7 74.3 39.6 103.4c-3.5 9.4-8.7 17.7-14.2 24.7c-4.8 6.2-9.7 11-13.3 14.3c-1.8 1.6-3.3 2.9-4.3 3.7c-.5 .4-.9 .7-1.1 .8l-.2 .2s0 0 0 0s0 0 0 0C1 327.2-1.4 334.4 .8 340.9S9.1 352 16 352c21.8 0 43.8-5.6 62.1-12.5c9.2-3.5 17.8-7.4 25.2-11.4C134.1 343.3 169.8 352 208 352zM448 176c0 112.3-99.1 196.9-216.5 207C255.8 457.4 336.4 512 432 512c38.2 0 73.9-8.7 104.7-23.9c7.5 4 16 7.9 25.2 11.4c18.3 6.9 40.3 12.5 62.1 12.5c6.9 0 13.1-4.5 15.2-11.1c2.1-6.6-.2-13.8-5.8-17.9c0 0 0 0 0 0s0 0 0 0l-.2-.2c-.2-.2-.6-.4-1.1-.8c-1-.8-2.5-2-4.3-3.7c-3.6-3.3-8.5-8.1-13.3-14.3c-5.5-7-10.7-15.4-14.2-24.7c24.9-29 39.6-64.7 39.6-103.4c0-92.8-84.9-168.9-192.6-175.5c.4 5.1 .6 10.3 .6 15.5z"/>
              </svg>
              <span class="mr-2">(123) 456-7890</span> <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" width="22" height="22" class="ml-25 mr-3" fill="#F9AD19">
                <path d="M164.9 24.6c-7.7-18.6-28-28.5-47.4-23.2l-88 24C12.1 30.2 0 46 0 64C0 311.4 200.6 512 448 512c18 0 33.8-12.1 38.6-29.5l24-88c5.3-19.4-4.6-39.7-23.2-47.4l-96-40c-16.3-6.8-35.2-2.1-46.3 11.6L304.7 368C234.3 334.7 177.3 277.7 144 207.3L193.3 167c13.7-11.2 18.4-30 11.6-46.3l-40-96z"/>
              </svg>
              <span>+62 8586-6077-520</span>
            </div>
              
             <div class="pt-2">
            <div class="flex items-center gap-x-4">
              <p class="text-sm font-semibold mr-2">Social Media</p>
              <a href="#">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" class="w-6 h-6 text-[#F9AD19] hover:text-[#F9AD19]">
                  <path fill="currentColor" d="M512 256C512 114.6 397.4 0 256 0S0 114.6 0 256C0 376 82.7 476.8 194.2 504.5V334.2H141.4V256h52.8V222.3c0-87.1 39.4-127.5 125-127.5c16.2 0 44.2 3.2 55.7 6.4V172c-6-.6-16.5-1-29.6-1c-42 0-58.2 15.9-58.2 57.2V256h83.6l-14.4 78.2H287V510.1C413.8 494.8 512 386.9 512 256h0z"/>
                </svg>
              </a>
              <a href="#">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" class="w-6 h-6 text-[#F9AD19] hover:text-[#F9AD19]">
                  <path fill="currentColor" d="M64 32C28.7 32 0 60.7 0 96V416c0 35.3 28.7 64 64 64H384c35.3 0 64-28.7 64-64V96c0-35.3-28.7-64-64-64H64zm297.1 84L257.3 234.6 379.4 396H283.8L209 298.1 123.3 396H75.8l111-126.9L69.7 116h98l67.7 89.5L313.6 116h47.5zM323.3 367.6L153.4 142.9H125.1L296.9 367.6h26.3z"/>
                </svg>
              </a>
              <a href="#">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" class="w-6 h-6 text-[#F9AD19] hover:text-[#F9AD19]">
                  <path fill="currentColor" d="M416 32H31.9C14.3 32 0 46.5 0 64.3v383.4C0 465.5 14.3 480 31.9 480H416c17.6 0 32-14.5 32-32.3V64.3c0-17.8-14.4-32.3-32-32.3zM135.4 416H69V202.2h66.5V416zm-33.2-243c-21.3 0-38.5-17.3-38.5-38.5S80.9 96 102.2 96c21.2 0 38.5 17.3 38.5 38.5 0 21.3-17.2 38.5-38.5 38.5zm282.1 243h-66.4V312c0-24.8-.5-56.7-34.5-56.7-34.6 0-39.9 27-39.9 54.9V416h-66.4V202.2h63.7v29.2h.9c8.9-16.8 30.6-34.5 62.9-34.5 67.2 0 79.7 44.3 79.7 101.9V416z"/>
                </svg>
              </a>
              <a href="#">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" class="w-6 h-6 text-[#F9AD19] hover:text-[#F9AD19]">
                  <path fill="currentColor" d="M549.7 124.1c-6.3-23.7-24.8-42.3-48.3-48.6C458.8 64 288 64 288 64S117.2 64 74.6 75.5c-23.5 6.3-42 24.9-48.3 48.6-11.4 42.9-11.4 132.3-11.4 132.3s0 89.4 11.4 132.3c6.3 23.7 24.8 41.5 48.3 47.8C117.2 448 288 448 288 448s170.8 0 213.4-11.5c23.5-6.3 42-24.2 48.3-47.8 11.4-42.9 11.4-132.3 11.4-132.3s0-89.4-11.4-132.3zm-317.5 213.5V175.2l142.7 81.2-142.7 81.2z"/>
                </svg>
              </a>
              <a href="#">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" class="w-6 h-6 text-[#F9AD19] hover:text-[#F9AD19]">
                  <path fill="currentColor" d="M194.4 211.7a53.3 53.3 0 1 0 59.3 88.7 53.3 53.3 0 1 0 -59.3-88.7zm142.3-68.4c-5.2-5.2-11.5-9.3-18.4-12c-18.1-7.1-57.6-6.8-83.1-6.5c-4.1 0-7.9 .1-11.2 .1c-3.3 0-7.2 0-11.4-.1c-25.5-.3-64.8-.7-82.9 6.5c-6.9 2.7-13.1 6.8-18.4 12s-9.3 11.5-12 18.4c-7.1 18.1-6.7 57.7-6.5 83.2c0 4.1 .1 7.9 .1 11.1s0 7-.1 11.1c-.2 25.5-.6 65.1 6.5 83.2c2.7 6.9 6.8 13.1 12 18.4s11.5 9.3 18.4 12c18.1 7.1 57.6 6.8 83.1 6.5c4.1 0 7.9-.1 11.2-.1c3.3 0 7.2 0 11.4 .1c25.5 .3 64.8 .7 82.9-6.5c6.9-2.7 13.1-6.8 18.4-12s9.3-11.5 12-18.4c7.2-18 6.8-57.4 6.5-83c0-4.2-.1-8.1-.1-11.4s0-7.1 .1-11.4c.3-25.5 .7-64.9-6.5-83l0 0c-2.7-6.9-6.8-13.1-12-18.4zm-67.1 44.5A82 82 0 1 1 178.4 324.2a82 82 0 1 1 91.1-136.4zm29.2-1.3c-3.1-2.1-5.6-5.1-7.1-8.6s-1.8-7.3-1.1-11.1s2.6-7.1 5.2-9.8s6.1-4.5 9.8-5.2s7.6-.4 11.1 1.1s6.5 3.9 8.6 7s3.2 6.8 3.2 10.6c0 2.5-.5 5-1.4 7.3s-2.4 4.4-4.1 6.2s-3.9 3.2-6.2 4.2s-4.8 1.5-7.3 1.5l0 0c-3.8 0-7.5-1.1-10.6-3.2zM448 96c0-35.3-28.7-64-64-64H64C28.7 32 0 60.7 0 96V416c0 35.3 28.7 64 64 64H384c35.3 0 64-28.7 64-64V96zM357 389c-18.7 18.7-41.4 24.6-67 25.9c-26.4 1.5-105.6 1.5-132 0c-25.6-1.3-48.3-7.2-67-25.9s-24.6-41.4-25.8-67c-1.5-26.4-1.5-105.6 0-132c1.3-25.6 7.1-48.3 25.8-67s41.5-24.6 67-25.8c26.4-1.5 105.6-1.5 132 0c25.6 1.3 48.3 7.1 67 25.8s24.6 41.4 25.8 67c1.5 26.3 1.5 105.4 0 131.9c-1.3 25.6-7.1 48.3-25.8 67z"/>
                </svg>
              </a>
            </div>
          </div>
            </div>
          </div>
          </div>
          <hr class="border-white my-6">

          <div class="text-center flex justify-around">

          <div class="text-xs items-center gap-x-15 mb-6 mr-70 flex">
            <a href="#" class="hover:text-yellow-400 transition-colors">ABOUT US</a>
            <a href="#" class="hover:text-yellow-400 transition-colors">CONTACT US</a>
            <a href="#" class="hover:text-yellow-400 transition-colors">HELP</a>
            <a href="#" class="hover:text-yellow-400 transition-colors">PRIVACY POLICY</a>
            <a href="#" class="hover:text-yellow-400 transition-colors">DISCUSSION</a>
          </div>

          <p class="text-xs text-gray-400 gap-x-6">Copyright ©2021 U.S.Publisher.</p>
          </div>
        </div>
    </footer>
  </div>
</template>