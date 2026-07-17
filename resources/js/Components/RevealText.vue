<script setup>
import { ref, onMounted } from 'vue'

const props = defineProps({
    text: { type: String, required: true },
    tag: { type: String, default: 'h2' },
    stagger: { type: Number, default: 35 },
})

const revealed = ref(false)
const chars = ref([])

onMounted(() => {
    chars.value = props.text.split('').map((c, i) => ({ char: c, delay: i * props.stagger }))
    const el = document.getElementById('reveal-' + props.text.replace(/\s/g, '-').toLowerCase())
    if (el) {
        const observer = new IntersectionObserver(([entry]) => {
            if (entry.isIntersecting) { revealed.value = true; observer.unobserve(el) }
        }, { threshold: 0.3 })
        observer.observe(el)
    }
})
</script>

<template>
    <component :is="tag" :id="'reveal-' + text.replace(/\s/g, '-').toLowerCase()" class="reveal-text">
        <span v-for="(c, i) in chars" :key="i" class="char" :class="{ shown: revealed }" :style="{ transitionDelay: c.delay + 'ms' }">
            {{ c.char === ' ' ? '\u00A0' : c.char }}
        </span>
    </component>
</template>

<style scoped>
.reveal-text{display:inline;}
.char{display:inline; opacity:0; transform:translateY(20px); transition:opacity .4s ease, transform .4s ease;}
.char.shown{opacity:1; transform:translateY(0);}
</style>
