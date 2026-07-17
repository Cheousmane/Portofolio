<script setup>
import { ref, computed, onMounted } from 'vue'

const isDark = ref(false)

onMounted(() => {
    isDark.value = document.documentElement.getAttribute('data-theme') === 'dark'
})

const label = computed(() => isDark.value ? 'Mode clair' : 'Mode sombre')

function toggle() {
    isDark.value = !isDark.value
    document.documentElement.setAttribute('data-theme', isDark.value ? 'dark' : 'light')
    localStorage.setItem('theme', isDark.value ? 'dark' : 'light')
}
</script>

<template>
    <button class="theme-toggle" @click="toggle" :title="label">
        <svg class="icon-sun" viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <circle cx="12" cy="12" r="5"/>
            <line x1="12" y1="1" x2="12" y2="3"/>
            <line x1="12" y1="21" x2="12" y2="23"/>
            <line x1="4.22" y1="4.22" x2="5.64" y2="5.64"/>
            <line x1="18.36" y1="18.36" x2="19.78" y2="19.78"/>
            <line x1="1" y1="12" x2="3" y2="12"/>
            <line x1="21" y1="12" x2="23" y2="12"/>
            <line x1="4.22" y1="19.78" x2="5.64" y2="18.36"/>
            <line x1="18.36" y1="5.64" x2="19.78" y2="4.22"/>
        </svg>
        <svg class="icon-moon" viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M21 12.79A9 9 0 1 1 11.21 3 7 7 0 0 0 21 12.79z"/>
        </svg>
    </button>
</template>

<style scoped>
.theme-toggle{
    background:var(--glass-bg); border:1px solid var(--glass-border);
    backdrop-filter:blur(10px); -webkit-backdrop-filter:blur(10px);
    width:36px; height:36px; border-radius:50%; display:flex; align-items:center; justify-content:center;
    cursor:pointer; color:var(--navy); transition:all .3s ease;
}
.theme-toggle:hover{transform:scale(1.1); border-color:var(--teal); color:var(--teal);}
.icon-sun{display:block;}
.icon-moon{display:none;}
[data-theme="dark"] .icon-sun{display:none;}
[data-theme="dark"] .icon-moon{display:block;}
</style>
