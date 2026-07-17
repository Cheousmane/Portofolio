<script setup>
import { ref, onMounted } from 'vue'

const props = defineProps({
    value: { type: String, required: true },
    duration: { type: Number, default: 1800 },
})

const display = ref('0')

function animate() {
    const el = document.getElementById('counter-' + props.value.replace(/\D/g, ''))
    if (!el) return
    const raw = props.value.replace('+', '')
    const target = parseInt(raw, 10)
    if (isNaN(target)) { display.value = props.value; return }
    const start = performance.now()
    function frame(now) {
        const elapsed = now - start
        const progress = Math.min(elapsed / props.duration, 1)
        const eased = 1 - Math.pow(1 - progress, 3)
        display.value = Math.floor(eased * target) + '+'
        if (progress < 1) requestAnimationFrame(frame)
    }
    requestAnimationFrame(frame)
}

onMounted(() => {
    const el = document.getElementById('counter-' + props.value.replace(/\D/g, ''))
    if (el) {
        const observer = new IntersectionObserver(([entry]) => {
            if (entry.isIntersecting) { animate(); observer.unobserve(el) }
        }, { threshold: 0.5 })
        observer.observe(el)
    }
})
</script>

<template>
    <span :id="'counter-' + value.replace(/\D/g, '')" class="counter">{{ display }}</span>
</template>

<style scoped>
.counter{display:inline;}
</style>
