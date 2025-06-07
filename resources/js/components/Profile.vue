<template>
    <div class="container mx-auto px-4 py-8">
        <!-- Header -->
        <header class="flex justify-between items-center mb-8">
            <h1 class="text-2xl font-bold text-gray-800">BERESINDONG</h1>
            <nav class="flex space-x-4">
                <a href="#" class="text-gray-600 hover:text-gray-900">Home</a>
                <a href="#" class="text-gray-600 hover:text-gray-900">Repairing</a>
                <a href="#" class="text-gray-600 hover:text-gray-900">Cleaning</a>
                <a href="#" class="text-gray-600 hover:text-gray-900">About Us</a>
            </nav>
        </header>

        <div class="flex flex-col md:flex-row gap-8">
            <!-- Left Sidebar -->
            <div class="w-full md:w-1/4 bg-white rounded-lg shadow p-6">
                <h2 class="text-xl font-semibold mb-4">Pesan</h2>
                
                <div class="mb-6">
                    <h3 class="font-medium text-lg mb-2">Profil Anda</h3>
                    <div class="space-y-2">
                        <a href="#" class="block text-blue-600">Update Foto</a>
                    </div>
                </div>

                <div class="mb-6">
                    <h3 class="font-medium text-lg mb-2">Profile Anda</h3>
                    <ul class="space-y-2">
                        <li>Username</li>
                        <li>Email</li>
                        <li>Phone</li>
                        <li>Real</li>
                        <li>Broom</li>
                    </ul>
                </div>

                <button class="w-full py-2 bg-red-500 text-white rounded hover:bg-red-600 transition">
                    LOGOUT
                </button>
            </div>

            <!-- Main Content -->
            <div class="w-full md:w-3/4 bg-white rounded-lg shadow p-6">
                <h2 class="text-xl font-semibold mb-6">Riwayat Pesanan</h2>
                
                <div class="grid grid-cols-5 gap-4 font-medium mb-4 pb-2 border-b">
                    <div>Pekerja</div>
                    <div>Tanggal</div>
                    <div>Kategori</div>
                    <div>Layanan</div>
                    <div>Rating</div>
                </div>

                <div v-for="(order, index) in orders" :key="index" class="grid grid-cols-5 gap-4 py-3 border-b">
                    <div>{{ order.worker }}</div>
                    <div>{{ order.date }}</div>
                    <div>{{ order.category }}</div>
                    <div>{{ order.service }}</div>
                    <div>
                        <button v-if="!order.rated" class="px-3 py-1 bg-blue-500 text-white rounded hover:bg-blue-600 transition">
                            Rate
                        </button>
                        <div v-else class="text-yellow-400">
                            ★★★★★
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Footer -->
        <footer class="mt-12 pt-8 border-t">
            <h2 class="text-xl font-bold mb-4">BERESINDONG</h2>
            <p class="text-gray-600">365 Railcenter Drive, Suite 4 - Charlottesville, CA, 12345</p>
            <p class="text-gray-600">(123) 456-7890</p>
            <p class="text-gray-600">(123) 456-7890</p>
            
            <div class="mt-4 flex space-x-4">
                <a href="#" class="text-gray-600 hover:text-blue-500">Facebook</a>
                <a href="#" class="text-gray-600 hover:text-blue-400">Twitter</a>
                <a href="#" class="text-gray-600 hover:text-pink-500">Instagram</a>
            </div>
        </footer>
    </div>
</template>

<script>
export default {
    data() {
        return {
            orders: [
                { worker: 'Ahmad Jaenal', date: '12/12/21', category: 'Repairing', service: 'Tembok', rated: false },
                { worker: 'Ahmad Jaenal', date: '12/12/21', category: 'Repairing', service: 'Tembok', rated: false },
                { worker: 'Ahmad Jaenal', date: '12/12/21', category: 'Repairing', service: 'Tembok', rated: false },
                { worker: 'Ahmad Jaenal', date: '12/12/21', category: 'Repairing', service: 'Tembok', rated: false },
                { worker: 'Ahmad Jaenal', date: '12/12/21', category: 'Repairing', service: 'Tembok', rated: false },
            ]
        }
    }
}
</script>

<style scoped>
/* Additional custom styles if needed */
</style>