<template>
  <div class="min-h-screen flex items-center justify-center bg-[#344C36] p-4">
    <div class="flex flex-wrap md:flex-nowrap w-full max-w-3xl lg:max-w-4xl rounded-lg overflow-hidden shadow-xl">
      
      <div class="w-full md:w-5/12 flex items-center justify-center bg-gray-100 p-4"> 
        <img src="../../../public/images/pictregist.png" alt="Beresin Dong Tools" 
            class="object-contain w-full max-h-[550px] lg:max-h-[600px]"> </div>

      <div class="w-full md:w-7/12 bg-white p-8 sm:p-10 lg:p-12">
        <div class="w-full max-w-md space-y-6 mx-auto">
          
          <div class="text-center">
            <h2 class="text-2xl font-bold font-poppins text-gray-800">Buat Akun</h2>
          </div>
          
          <form class="space-y-6" @submit.prevent="register">
            <div class="space-y-5">
              <div>
                <label for="username" class="block text-sm font-medium text-gray-700 mb-1">Username</label>
                <input 
                  id="username" 
                  name="username" 
                  type="text" 
                  required
                  v-model="form.username"
                  class="mt-1 block w-full px-4 py-3 border border-gray-300 rounded-full shadow-sm focus:outline-none focus:ring-2 focus:ring-[#38503D] focus:border-[#38503D] sm:text-sm"
                >
              </div>
              
              <div>
                <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                <input 
                  id="email" 
                  name="email" 
                  type="email" 
                  required
                  v-model="form.email"
                  class="mt-1 block w-full px-4 py-3 border border-gray-300 rounded-full shadow-sm focus:outline-none focus:ring-2 focus:ring-[#38503D] focus:border-[#38503D] sm:text-sm"
                >
              </div>
              
              <div>
                <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                <input 
                  id="password" 
                  name="password" 
                  type="password" 
                  required
                  minlength="8"
                  v-model="form.password"
                  class="mt-1 block w-full px-4 py-3 border border-gray-300 rounded-full shadow-sm focus:outline-none focus:ring-2 focus:ring-[#38503D] focus:border-[#38503D] sm:text-sm"
                >
              </div>
            </div>

            <div>
              <button 
                type="submit" 
                class="w-full flex justify-center py-3 px-4 border border-transparent text-sm font-medium rounded-full text-white bg-[#2A3C2D] hover:bg-[#38503D] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#38503D] transition-colors duration-200"
                :disabled="isLoading"
              >
                <span v-if="!isLoading">Daftar</span>
                <span v-else class="flex items-center justify-center">
                  <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                  </svg>
                  Mendaftar...
                </span>
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  // data() {
  //   return {
  //     form: {
  //       username: '',
  //       email: '',
  //       password: ''
  //     },
  //     isLoading: false
  //   }
  // },
  // methods: {
  //   async register() {
  //     this.isLoading = true;
  //     try {
  //       // Ganti dengan pemanggilan API Anda yang sebenarnya
  //       // const response = await axios.post('/api/register', this.form);
  //       console.log('Registering with:', this.form);
        
  //       // Simulasi delay API
  //       await new Promise(resolve => setTimeout(resolve, 1500));
        
  //       alert('Registrasi berhasil!');
  //       this.form.username = '';
  //       this.form.email = '';
  //       this.form.password = '';

  //     } catch (error) {
  //       console.error('Registration error:', error);
  //       alert('Registrasi gagal. Silakan coba lagi.');
  //     } finally {
  //       this.isLoading = false;
  //     }
  //   }
  // }
}
</script>

<style scoped>
/* Anda bisa menambahkan style scoped khusus di sini jika diperlukan,
   namun sebagian besar styling sudah menggunakan kelas Tailwind CSS. */
</style>