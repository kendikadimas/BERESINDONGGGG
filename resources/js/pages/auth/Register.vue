<script setup lang="ts">
import { Head, useForm } from '@inertiajs/vue3';
import { LoaderCircle } from 'lucide-vue-next';

import InputError from '@/components/InputError.vue';
import TextLink from '@/components/TextLink.vue';
import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';

const form = useForm({
    name: '',
    email: '',
    password: '',
    password_confirmation: '',
});

const submit = () => {
    form.post(route('register'), {
        onFinish: () => form.reset('password', 'password_confirmation'),
    });
};
</script>

<template>
    <Head title="Register" />

    <div class="min-h-screen flex items-center justify-center bg-[#344C36] p-4">
        <div class="flex flex-wrap md:flex-nowrap w-full max-w-3xl lg:max-w-4xl rounded-lg overflow-hidden shadow-xl">
            
            <div class="w-full md:w-5/12 flex items-center justify-center bg-gray-100 p-4">
                <img src="/images/pictregist.png" alt="Beresin Dong Register"
                    class="object-contain w-full max-h-[550px] lg:max-h-[600px]">
            </div>

            <div class="w-full md:w-7/12 bg-white p-8 sm:p-10 lg:p-12">
                <div class="w-full max-w-md space-y-6 mx-auto">
                    
                    <div class="text-center">
                        <h2 class="text-2xl font-bold font-poppins text-gray-800">Buat Akun Baru</h2>
                    </div>
                    
                    <form @submit.prevent="submit" class="space-y-6">
                        <div class="space-y-5">
                            <div>
                                <Label for="name" class="block text-sm font-medium text-gray-700 mb-1">Nama Lengkap</Label>
                                <Input 
                                    id="name" 
                                    type="text" 
                                    required 
                                    autofocus 
                                    autocomplete="name" 
                                    v-model="form.name" 
                                    placeholder="Nama Lengkap Anda"
                                    class="mt-1 block w-full px-4 py-3 h-auto border-gray-300 rounded-full shadow-sm focus:outline-none focus:ring-2 focus:ring-[#38503D] focus:border-[#38503D] sm:text-sm"
                                />
                                <InputError :message="form.errors.name" class="mt-2" />
                            </div>

                            <div>
                                <Label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</Label>
                                <Input 
                                    id="email" 
                                    type="email" 
                                    required 
                                    autocomplete="email" 
                                    v-model="form.email" 
                                    placeholder="email@example.com"
                                    class="mt-1 block w-full px-4 py-3 h-auto border-gray-300 rounded-full shadow-sm focus:outline-none focus:ring-2 focus:ring-[#38503D] focus:border-[#38503D] sm:text-sm"
                                />
                                <InputError :message="form.errors.email" class="mt-2" />
                            </div>
                            
                            <div>
                                <Label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password</Label>
                                <Input
                                    id="password"
                                    type="password"
                                    required
                                    autocomplete="new-password"
                                    v-model="form.password"
                                    placeholder="Password"
                                    class="mt-1 block w-full px-4 py-3 h-auto border-gray-300 rounded-full shadow-sm focus:outline-none focus:ring-2 focus:ring-[#38503D] focus:border-[#38503D] sm:text-sm"
                                />
                                <InputError :message="form.errors.password" class="mt-2" />
                            </div>

                            <div>
                                <Label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-1">Konfirmasi Password</Label>
                                <Input
                                    id="password_confirmation"
                                    type="password"
                                    required
                                    autocomplete="new-password"
                                    v-model="form.password_confirmation"
                                    placeholder="Konfirmasi Password"
                                    class="mt-1 block w-full px-4 py-3 h-auto border-gray-300 rounded-full shadow-sm focus:outline-none focus:ring-2 focus:ring-[#38503D] focus:border-[#38503D] sm:text-sm"
                                />
                                <InputError :message="form.errors.password_confirmation" class="mt-2" />
                            </div>
                        </div>

                        <div>
                            <Button
                                type="submit"
                                class="w-full flex justify-center py-3 px-4 border border-transparent text-sm font-medium rounded-full text-white bg-[#2A3C2D] hover:bg-[#38503D] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#38503D] transition-colors duration-200 h-auto"
                                :disabled="form.processing"
                            >
                                <LoaderCircle v-if="form.processing" class="animate-spin -ml-1 mr-3 h-5 w-5" />
                                <span v-else>Daftar</span>
                            </Button>
                        </div>

                        <div class="text-center text-sm text-gray-600">
                            Sudah punya akun?
                            <TextLink :href="route('login')">Login di sini</TextLink>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template> 