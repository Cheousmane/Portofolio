<script setup>
defineProps({
    items: { type: Array, required: true },
});
</script>

<template>
    <div class="timeline">
        <div
            class="tl-item reveal glass"
            :class="{ now: item.now }"
            v-for="(item, i) in items"
            :key="item.title"
            :style="{ transitionDelay: `${i * 0.12}s` }"
        >
            <span class="tl-date mono">{{ item.date }}</span>
            <h3>{{ item.title }}</h3>
            <p>{{ item.description }}</p>
        </div>
    </div>
</template>

<style scoped>
.timeline{position:relative; margin-top:44px; padding-left:24px; border-left:2px solid var(--line);}
.tl-item{position:relative; padding:20px 24px; margin-bottom:20px; border-radius:var(--radius);}
.tl-item:last-child{padding-bottom:20px; margin-bottom:0;}
.tl-item::before{
    content:''; position:absolute; left:-20px; top:24px; width:12px; height:12px;
    border-radius:50%; background:var(--teal); border:3px solid var(--bg); box-shadow:0 0 0 2px var(--teal);
    transition:box-shadow .3s ease, background .3s ease;
    z-index:1;
}
.tl-item:hover::before{background:var(--amber); box-shadow:0 0 0 4px var(--teal);}
.tl-item.now::before{background:var(--amber); box-shadow:0 0 0 2px var(--amber);}
.tl-item.now:hover::before{box-shadow:0 0 0 4px var(--amber);}
.tl-date{font-size:12.5px; color:var(--teal); font-weight:500; margin-bottom:6px; display:block;}
.tl-item h3{font-size:18px; margin-bottom:4px;}
.tl-item p{color:var(--gray); font-size:14.5px;}
@media (max-width:600px){
    .timeline{padding-left:16px; margin-top:28px;}
    .tl-item{padding:16px 18px;}
    .tl-item::before{left:-14px; width:10px; height:10px;}
    .tl-item h3{font-size:16px;}
}
</style>
