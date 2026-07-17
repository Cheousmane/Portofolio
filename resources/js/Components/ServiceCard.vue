<script setup>
defineProps({
    num: { type: String, required: true },
    title: { type: String, required: true },
    tagline: { type: String, required: true },
    items: { type: Array, required: true },
    stack: { type: Array, required: true },
    dark: { type: Boolean, default: false },
});
</script>

<template>
    <div class="service-card glass hover-glow" :class="{ dark }">
        <span class="service-num">{{ num }}</span>
        <h3>{{ title }}</h3>
        <p>{{ tagline }}</p>
        <ul>
            <li v-for="item in items" :key="item">{{ item }}</li>
        </ul>
        <div class="stack">
            <span v-for="tech in stack" :key="tech">{{ tech }}</span>
        </div>
    </div>
</template>

<style scoped>
.service-card{
    padding:36px; display:flex; flex-direction:column; gap:18px; height:100%;
    border-radius:var(--radius);
    position:relative;
}
.service-card.dark{--glass-bg:rgba(15,42,74,0.7);}
.service-card.dark h3, .service-card.dark .service-num{color:#fff;}
.service-card.dark p{color:#C9D6E4;}
.service-num{font-family:'JetBrains Mono',monospace; font-size:13px; color:var(--teal); font-weight:500;}
h3{font-size:23px;}
ul{list-style:none; display:flex; flex-direction:column; gap:10px; font-size:14.5px;}
p{color:var(--gray); font-size:14.5px;}
li{display:flex; gap:10px; align-items:flex-start;}
li::before{content:''; width:6px; height:6px; border-radius:50%; background:var(--amber); margin-top:8px; flex:0 0 auto;}
.stack{display:flex; gap:8px; flex-wrap:wrap; margin-top:auto; padding-top:8px;}
.stack span{
    font-family:'JetBrains Mono',monospace; font-size:11.5px; padding:4px 10px; border-radius:6px;
    background:var(--stack-bg); color:var(--stack-text);
}
.service-card.dark .stack span{background:rgba(255,255,255,0.08); color:rgba(255,255,255,0.85);}
</style>
