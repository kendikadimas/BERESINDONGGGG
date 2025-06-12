<script setup>
import { Head } from '@inertiajs/vue3';
import AppLayout from '@/components/layouts/AppLayout.vue';

// 1. Impor komponen-komponen baru kita
import VisiMisi from '@/components/VisiMisi.vue';
import CTABlock from '@/components/CTABlock.vue';

// 2. Definisikan data yang akan dikirim sebagai props
const visiText = "Menjadi solusi satu atap terdepan untuk perawatan rumah di Indonesia, dengan teknologi yang memudahkan dan layanan yang humanis.";
const misiItems = [
    "Meningkatkan kualitas melalui verifikasi ketat.",
    "Memberikan harga transparan tanpa hidden cost.",
    "Menciptakan hubungan saling percaya dengan pelanggan.",
    "Memberdayakan keahlian tukang yang berkualitas.",
];
</script>

<template>
    <Head title="Tentang Kami" />

    <AppLayout>
        <div class="bg-white py-12 md:py-20 px-4">
            <div class="max-w-4xl mx-auto space-y-16 md:space-y-20">

                <section class="text-center">
                    <h1 class="text-3xl md:text-4xl font-bold text-gray-800 mb-8">
                        Tentang Kami
                    </h1>
                    <div class="w-full h-auto  overflow-hidden shadow-lg">
                        <img src="/images/workers.png" alt="Tim Beresindong" class="w-full h-full object-cover">
                    </div>
                    <div class="mt-8 text-left max-w-3xl mx-auto">
                        <h2 class="text-2xl md:text-3xl font-bold text-gray-800">
                            BeresinDong merupakan website penyedia layanan jasa untuk perbaikan dan kebersihan rumah.
                        </h2>
                        <p class="mt-4 text-gray-600 leading-relaxed">
                            Platform terpercaya untuk segala kebutuhan perbaikan dan kebersihan rumah. Menghubungkan Anda dengan tukang profesional sejak 2024.
                        </p>
                    </div>
                </section>

                <VisiMisi :visi="visiText" :misi="misiItems" />

                <CTABlock 
                    title="Siap Menjadi Bagian dari Kami?"
                    description="Daftar untuk mendapatkan customer dan meningkatkan reputasi pekerjaan anda! Daftar gratis sekarang juga!"
                    buttonText="Daftar"
                    buttonRouteName="register"
                    imageUrl="/images/herorepair.png"
                    imagePosition="left"
                />

                <!-- <CTABlock 
                    title="Beresin Permasalahan Rumah Anda"
                    description="Pesan layanan sekarang agar permasalahan rumah anda beres sekarang juga!"
                    buttonText="Pesan"
                    buttonRouteName="home"
                    imageUrl="/images/pesan-layanan.jpg"
                    imagePosition="right"
                /> -->

            </div>
        </div>
    </AppLayout>
</template>