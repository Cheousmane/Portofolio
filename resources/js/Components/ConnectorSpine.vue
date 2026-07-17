<script setup>
import { onMounted, onUnmounted, ref } from 'vue';

const wrapEl = ref(null);
const pathEl = ref(null);
let pathLength = 0;

function setHeight() {
    const docH = document.documentElement.scrollHeight;
    if (!wrapEl.value || !pathEl.value) return;

    wrapEl.value.style.height = `${docH}px`;
    pathEl.value.closest('svg').setAttribute('viewBox', `0 0 4 ${docH}`);
    pathEl.value.setAttribute('d', `M2,0 L2,${docH}`);
    pathLength = pathEl.value.getTotalLength();
    pathEl.value.style.strokeDasharray = pathLength;
    updateProgress();
}

function updateProgress() {
    if (!pathEl.value || !pathLength) return;
    const scrollTop = window.scrollY || document.documentElement.scrollTop;
    const winH = window.innerHeight;
    const docH = document.documentElement.scrollHeight;
    const progress = Math.min(1, scrollTop / Math.max(1, docH - winH));
    pathEl.value.style.strokeDashoffset = pathLength * (1 - progress);
}

onMounted(() => {
    setHeight();
    window.addEventListener('resize', setHeight);
    window.addEventListener('scroll', updateProgress, { passive: true });
});

onUnmounted(() => {
    window.removeEventListener('resize', setHeight);
    window.removeEventListener('scroll', updateProgress);
});
</script>

<template>
    <div ref="wrapEl" id="spine" aria-hidden="true">
        <svg viewBox="0 0 4 800" preserveAspectRatio="none">
            <path ref="pathEl" id="spinePath" d="M2,0 L2,800" />
        </svg>
    </div>
</template>

<style scoped>
#spine{
    position:absolute; left:38px; top:0; width:2px; height:100%;
    z-index:0; pointer-events:none;
}
#spine svg{position:sticky; top:0; height:100vh;}
#spinePath{
    fill:none; stroke:var(--teal); stroke-width:2; stroke-linecap:round;
    stroke-dasharray:1; stroke-dashoffset:1; opacity:0.55;
}
@media (max-width: 900px){ #spine{display:none;} }
</style>
