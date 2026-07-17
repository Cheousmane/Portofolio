<script setup>
defineProps({
    size: { type: [Number, String], default: 30 },
});
</script>

<template>
    <svg :width="size" :height="size" viewBox="0 0 300 300" aria-hidden="true" class="logo-svg">
        <circle cx="150" cy="150" r="140" class="logo-bg" />
        <path
            d="M195,95 C170,90 130,95 122,115 C114,133 130,142 152,148 C174,154 190,163 182,183 C174,203 135,210 105,205"
            fill="none" stroke-width="17" stroke-linecap="round" class="logo-path"
        />
        <circle cx="195" cy="95" r="10" class="logo-dot-1" />
        <circle cx="105" cy="205" r="15" class="logo-dot-2" />
    </svg>
</template>

<style scoped>
.logo-bg{fill:var(--logo-bg); transition:fill .35s ease;}
.logo-path{stroke:var(--logo-stroke); transition:stroke .35s ease;}
.logo-dot-1{fill:var(--logo-stroke); transition:fill .35s ease;}
.logo-dot-2{fill:var(--logo-dot); transition:fill .35s ease;}
</style>
