<script setup lang="ts">
import { Head, useForm } from '@inertiajs/vue3';
import { LoaderCircle } from 'lucide-vue-next';

import InputError from '@/components/InputError.vue';
import TextLink from '@/components/TextLink.vue';
import { Button } from '@/components/ui/button';
import { Checkbox } from '@/components/ui/checkbox';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';

defineProps<{
    status?: string;
    canResetPassword: boolean;
}>();

const form = useForm({
    email: '',
    password: '',
    remember: false,
});

const submit = () => {
    form.post(route('login'), {
        onFinish: () => form.reset('password'),
    });
};
</script>

<template>
    <Head title="Login" />

    <div class="min-h-screen flex items-center justify-center bg-[#344C36] p-4">
        <div class="flex flex-wrap md:flex-nowrap w-full max-w-3xl lg:max-w-4xl rounded-lg overflow-hidden shadow-xl">
            
            <div class="w-full md:w-5/12 flex items-center justify-center bg-gray-100 p-4">
                <img src="/images/pictregist.png" alt="Beresin Dong Login"
                    class="object-contain w-full max-h-[550px] lg:max-h-[600px]">
            </div>

            <div class="w-full md:w-7/12 bg-white p-8 sm:p-10 lg:p-12">
                <div class="w-full max-w-md space-y-6 mx-auto">
                    
                    <div class="text-center">
                        <h2 class="text-2xl font-bold font-poppins text-gray-800">Login ke Akun Anda</h2>
                        <p v-if="status" class="mt-2 text-sm font-medium text-green-600">
                            {{ status }}
                        </p>
                    </div>
                    
                    <form @submit.prevent="submit" class="space-y-6">
                        <div class="space-y-5">
                            <div>
                                <Label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</Label>
                                <Input
                                    id="email"
                                    type="email"
                                    required
                                    autofocus
                                    autocomplete="email"
                                    v-model="form.email"
                                    placeholder="email@example.com"
                                    class="mt-1 block w-full px-4 py-3 h-auto border-gray-300 rounded-full shadow-sm focus:outline-none focus:ring-2 focus:ring-[#38503D] focus:border-[#38503D] sm:text-sm"
                                />
                                <InputError :message="form.errors.email" class="mt-2" />
                            </div>
                            
                            <div>
                                <div class="flex items-center justify-between mb-1">
                                    <Label for="password" class="text-sm font-medium text-gray-700">Password</Label>
                                    <TextLink v-if="canResetPassword" :href="route('password.request')" class="text-sm">
                                        Lupa password?
                                    </TextLink>
                                </div>
                                <Input
                                    id="password"
                                    type="password"
                                    required
                                    autocomplete="current-password"
                                    v-model="form.password"
                                    placeholder="Password"
                                    class="mt-1 block w-full px-4 py-3 h-auto border-gray-300 rounded-full shadow-sm focus:outline-none focus:ring-2 focus:ring-[#38503D] focus:border-[#38503D] sm:text-sm"
                                />
                                <InputError :message="form.errors.password" class="mt-2" />
                            </div>
                        </div>

                        <div class="flex items-center">
                            <Checkbox id="remember" v-model:checked="form.remember" />
                            <Label for="remember" class="ml-2 block text-sm text-gray-900">
                                Ingat saya
                            </Label>
                        </div>

                        <div>
                            <Button
                                type="submit"
                                class="w-full flex justify-center py-3 px-4 border border-transparent text-sm font-medium rounded-full text-white bg-[#2A3C2D] hover:bg-[#38503D] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#38503D] transition-colors duration-200 h-auto"
                                :disabled="form.processing"
                            >
                                <LoaderCircle v-if="form.processing" class="animate-spin -ml-1 mr-3 h-5 w-5" />
                                <span v-else>Login</span>
                            </Button>
                        </div>

                        <div class="text-center text-sm text-gray-600">
                            Belum punya akun?
                            <TextLink :href="route('register')">Daftar sekarang</TextLink>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>