<script setup>
defineProps({
    items: { type: Array, required: true },
});
</script>

<template>
    <div class="why-grid">
        <div
            class="why-card glass hover-glow reveal"
            v-for="(item, i) in items"
            :key="item.title"
            :style="{ transitionDelay: `${i * 0.12}s` }"
        >
            <h3>{{ item.icon }} {{ item.title }}</h3>
            <p>{{ item.text }}</p>
        </div>
    </div>
</template>

<style scoped>
.why-grid{display:grid; grid-template-columns:repeat(3,1fr); gap:24px; margin-top:36px;}
.why-card{
    padding:26px; border-radius:var(--radius);
    transition:transform .3s ease, box-shadow .3s ease, opacity .7s ease, transform .7s ease;
}
.why-card:hover{
    transform:translateY(-4px) scale(1.01);
    box-shadow:0 12px 32px rgba(0,0,0,0.06);
}
.why-card h3{font-size:16px; margin-bottom:8px;}
.why-card p{color:var(--gray); font-size:14px;}
@media (max-width:1024px){ .why-grid{grid-template-columns:repeat(2,1fr);} }
@media (max-width:600px){ .why-grid{grid-template-columns:1fr;} }
@media (max-width:480px){ .why-card{padding:22px 18px;} }
</style>
