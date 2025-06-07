<script setup lang="ts">
import { Avatar, AvatarFallback, AvatarImage } from '@/components/ui/avatar';
import { useInitials } from '@/composables/useInitials';
import type { User } from '@/types';
import { computed } from 'vue';
import { Link } from '@inertiajs/vue3'; // 1. Impor komponen Link untuk tombol Login/Logout

interface Props {
    // 2. Izinkan 'user' untuk menjadi 'User' ATAU 'null'
    user: User | null;
    showEmail?: boolean;
}

const props = withDefaults(defineProps<Props>(), {
    showEmail: false,
});

const { getInitials } = useInitials();

// 3. Gunakan "optional chaining" (?.) untuk keamanan saat user null
const showAvatar = computed(() => props.user?.avatar && props.user?.avatar !== '');
</script>

<template>
    <div v-if="user" class="flex w-full items-center gap-3">
        <Avatar class="h-8 w-8 overflow-hidden rounded-lg">
            <AvatarImage v-if="showAvatar" :src="user.avatar" :alt="user.name" />
            <AvatarFallback class="rounded-lg text-black dark:text-white">
                {{ getInitials(user.name) }}
            </AvatarFallback>
        </Avatar>

        <div class="grid flex-1 text-left text-sm leading-tight">
            <span class="truncate font-medium">{{ user.name }}</span>
            <span v-if="showEmail" class="truncate text-xs text-muted-foreground">{{ user.email }}</span>
        </div>
    </div>

    <div v-else>
        <Link :href="route('login')" class="text-sm font-medium hover:underline">
            Login
        </Link>
    </div>
</template>