<script setup>
import { Head, useForm } from '@inertiajs/vue3';
import AppLayout from '../../js/components/layouts/AppLayout.vue';
import { Upload } from 'lucide-vue-next';

const form = useForm({
    identity_document: null,
    profile_photo: null,
});

const submit = () => {
    form.post(route('partner.store'));
};
</script>

<template>
    <Head title="Jadi Mitra" />
    <AppLayout>
        <div class="min-h-screen flex items-center justify-center bg-gray-100 p-4">
            <div class="flex w-full max-w-3xl lg:max-w-4xl rounded-lg overflow-hidden shadow-2xl bg-white">
                <div class="w-full md:w-5/12 flex items-center justify-center bg-white p-4">
                    <img src="/images/pictregist.png" alt="Jadi Mitra" class="object-contain w-full">
                </div>
                <div class="w-full md:w-7/12 bg-white p-8 sm:p-10 lg:p-12">
                    <div class="w-full max-w-md space-y-6 mx-auto">
                        <div class="text-center">
                            <h2 class="text-2xl font-bold text-gray-800">Ajukan Diri Sebagai Mitra</h2>
                            <p class="text-sm text-gray-500 mt-2">Upload dokumen yang diperlukan untuk verifikasi.</p>
                        </div>
                        <form @submit.prevent="submit" class="space-y-6">
                            <div>
                                <label for="profile_photo" class="block text-sm font-medium text-gray-700 mb-1">Foto Profil</label>
                                <input type="file" @input="form.profile_photo = $event.target.files[0]" required class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-green-50 file:text-green-700 hover:file:bg-green-100"/>
                                <p v-if="form.errors.profile_photo" class="text-sm text-red-600 mt-1">{{ form.errors.profile_photo }}</p>
                            </div>
                            <div>
                                <label for="identity_document" class="block text-sm font-medium text-gray-700 mb-1">Kartu Identitas (KTP)</label>
                                <input type="file" @input="form.identity_document = $event.target.files[0]" required class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-green-50 file:text-green-700 hover:file:bg-green-100"/>
                                <p v-if="form.errors.identity_document" class="text-sm text-red-600 mt-1">{{ form.errors.identity_document }}</p>
                            </div>
                            <div>
                                <div v-if="form.progress" class="w-full bg-gray-200 rounded-full mt-2">
                                    <div class="bg-green-600 text-xs font-medium text-blue-100 text-center p-0.5 leading-none rounded-full" :style="{ width: form.progress.percentage + '%' }"> {{ form.progress.percentage }}%</div>
                                </div>
                                <button type="submit" :disabled="form.processing" class="w-full flex justify-center py-3 px-4 bg-green-600 hover:bg-green-700 text-white font-bold py-4 px-10 rounded-full mt-5 text-lg shadow-md hover:shadow-lg transition-all duration-300 transform hover:scale-105">
                                    Kirim Pengajuan
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>