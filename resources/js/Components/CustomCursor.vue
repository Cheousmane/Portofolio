<script setup>
import { ref, onMounted, onUnmounted } from 'vue'

const cursor = ref({ x: -100, y: -100 })
const dot = ref({ x: -100, y: -100 })
const isVisible = ref(false)

function move(e) {
    dot.value = { x: e.clientX, y: e.clientY }
    setTimeout(() => { cursor.value = { x: e.clientX, y: e.clientY } }, 60)
}

function onLeave() { isVisible.value = false }
function onEnter() { isVisible.value = true }

onMounted(() => {
    window.addEventListener('mousemove', move)
    document.addEventListener('mouseleave', onLeave)
    document.addEventListener('mouseenter', onEnter)
})
onUnmounted(() => {
    window.removeEventListener('mousemove', move)
    document.removeEventListener('mouseleave', onLeave)
    document.removeEventListener('mouseenter', onEnter)
})
</script>

<template>
    <div class="custom-cursor" :class="{ visible: isVisible }">
        <div class="cursor-dot" :style="{ left: dot.x + 'px', top: dot.y + 'px' }"></div>
        <div class="cursor-ring" :style="{ left: cursor.x + 'px', top: cursor.y + 'px' }"></div>
    </div>
</template>

<style scoped>
.custom-cursor{position:fixed; inset:0; z-index:9999; pointer-events:none;}
.cursor-dot{
    position:absolute; width:6px; height:6px; border-radius:50%;
    background:var(--teal); transform:translate(-50%,-50%);
    transition:opacity .3s ease; opacity:0;
}
.cursor-ring{
    position:absolute; width:40px; height:40px; border-radius:50%;
    border:2px solid var(--cursor-color);
    transform:translate(-50%,-50%);
    transition:width .2s ease, height .2s ease, opacity .3s ease, border-color .2s ease;
    opacity:0;
}
.visible .cursor-dot{opacity:1;}
.visible .cursor-ring{opacity:1;}
@media (hover:none) and (pointer:coarse){ .custom-cursor{display:none;} }
</style>
