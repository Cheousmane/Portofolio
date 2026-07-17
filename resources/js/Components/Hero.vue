<script setup>
import { ref, onMounted } from 'vue'

const props = defineProps({
    stats: { type: Array, required: true },
    typingStrings: { type: Array, required: true },
})

const displayText = ref('')
const isVisible = ref(true)

let charIndex = 0
let strIndex = 0
let isDeleting = false

function rand(min, max) {
    return Math.floor(Math.random() * (max - min + 1)) + min
}

function typeLoop() {
    const current = props.typingStrings[strIndex]
    if (isDeleting) {
        displayText.value = current.substring(0, charIndex--)
        if (charIndex < 0) {
            isDeleting = false
            strIndex = (strIndex + 1) % props.typingStrings.length
            isVisible.value = false
            setTimeout(() => {
                isVisible.value = true
                setTimeout(typeLoop, 350)
            }, 300)
            return
        }
        setTimeout(typeLoop, rand(25, 55))
    } else {
        displayText.value = current.substring(0, ++charIndex)
        if (charIndex === current.length) {
            isDeleting = true
            setTimeout(typeLoop, rand(1800, 2800))
            return
        }
        setTimeout(typeLoop, rand(60, 140))
    }
}

onMounted(() => {
    setTimeout(typeLoop, 600)
})
</script>

<template>
    <section id="hero">
        <div class="hero-bg"></div>
        <div class="liquid-glass">
            <div class="blob blob-1"></div>
            <div class="blob blob-2"></div>
            <div class="blob blob-3"></div>
            <div class="blob blob-4"></div>
            <div class="glass-shine"></div>
        </div>
        <div class="wrap hero-grid">
            <div>
                <div class="eyebrow">Freelance · Bamako, Mali</div>
                <h1>Deux métiers, une seule promesse&nbsp;: que votre <em>technologie</em> ne vous ralentisse jamais.</h1>
                <p class="lead">
                    <span class="typed-wrap"><span class="typed-text" :class="{ 'hide-cursor': !isVisible }">{{ displayText }}</span><span class="cursor" :class="{ 'hide-cursor': !isVisible }"></span></span>.
                    Des infrastructures réseau maîtrisées aux applications web sur mesure, je construis et maintiens des solutions qui tiennent la route — sans overhead, sans intermédiaire.
                </p>
                <div class="hero-ctas">
                    <a href="#contact" class="btn amber">Discuter de mon projet</a>
                    <a href="#services" class="btn ghost">Voir les services</a>
                </div>
                <div class="stats">
                    <div class="stat" v-for="stat in stats" :key="stat.label">
                        <b class="mono">{{ stat.value }}</b>
                        <span>{{ stat.label }}</span>
                    </div>
                </div>
            </div>
            <div class="hero-art">
                <svg viewBox="0 0 300 300" class="hero-svg">
                    <defs>
                        <linearGradient id="grad1" x1="0%" y1="0%" x2="100%" y2="100%">
                            <stop offset="0%" stop-color="var(--logo-bg)" />
                            <stop offset="100%" stop-color="#1a4a7a" />
                        </linearGradient>
                    </defs>
                    <circle cx="150" cy="150" r="140" fill="url(#grad1)" class="circle-base" />
                    <circle cx="150" cy="150" r="120" fill="none" stroke="var(--teal)" stroke-width="2" opacity="0.35" class="circle-ring" />
                    <circle cx="150" cy="150" r="100" fill="none" stroke="var(--teal)" stroke-width="1" opacity="0.15" class="circle-ring-2" />
                    <circle cx="150" cy="150" r="60" fill="none" stroke="var(--amber)" stroke-width="1" opacity="0.2" class="circle-ring-3" />
                    <path
                        d="M195,95 C170,90 130,95 122,115 C114,133 130,142 152,148 C174,154 190,163 182,183 C174,203 135,210 105,205"
                        fill="none" stroke="var(--teal)" stroke-width="17" stroke-linecap="round" class="svg-path"
                    />
                    <circle cx="195" cy="95" r="10" fill="var(--teal)" class="dot-start" />
                    <circle cx="105" cy="205" r="15" fill="var(--amber)" class="dot-end-main" />
                    <circle cx="105" cy="205" r="15" fill="none" stroke="var(--navy)" stroke-width="3" class="dot-end-ring" />
                    <circle cx="150" cy="70" r="3" fill="var(--teal)" opacity="0.6" class="particle p1" />
                    <circle cx="230" cy="130" r="2" fill="var(--amber)" opacity="0.5" class="particle p2" />
                    <circle cx="80" cy="100" r="2.5" fill="var(--navy)" opacity="0.3" class="particle p3" />
                    <circle cx="220" cy="200" r="2" fill="var(--teal)" opacity="0.4" class="particle p4" />
                </svg>
            </div>
        </div>
    </section>
</template>

<style scoped>
#hero{
    padding-top:96px; padding-bottom:80px;
    position:relative; overflow:hidden;
}
.hero-bg{
    position:absolute; inset:0; z-index:0;
    background:linear-gradient(160deg, var(--hero-bg) 0%, var(--hero-bg-2) 40%, var(--hero-bg-3) 100%);
}
.liquid-glass{
    position:absolute; inset:0; z-index:0;
    overflow:hidden; pointer-events:none;
}
.blob{
    position:absolute; border-radius:50%;
    filter:blur(60px);
    will-change:transform, border-radius;
}
.blob-1{
    width:480px; height:480px;
    background:radial-gradient(circle, rgba(20,184,166,0.12) 0%, rgba(20,184,166,0) 70%);
    top:-120px; left:-80px;
    animation:morphBlob 18s ease-in-out infinite;
}
.blob-2{
    width:360px; height:360px;
    background:radial-gradient(circle, rgba(244,166,35,0.10) 0%, rgba(244,166,35,0) 70%);
    bottom:-80px; right:-60px;
    animation:morphBlob 22s ease-in-out infinite reverse;
}
.blob-3{
    width:300px; height:300px;
    background:radial-gradient(circle, rgba(20,184,166,0.08) 0%, rgba(20,184,166,0) 70%);
    top:40%; left:55%;
    animation:morphBlob 20s ease-in-out infinite 3s;
}
.blob-4{
    width:200px; height:200px;
    background:radial-gradient(circle, rgba(15,42,74,0.06) 0%, rgba(15,42,74,0) 70%);
    top:10%; right:30%;
    animation:morphBlob 16s ease-in-out infinite 5s;
}
.glass-shine{
    position:absolute; inset:0;
    background:linear-gradient(105deg, transparent 30%, rgba(255,255,255,0.08) 50%, transparent 70%);
    animation:glassSweep 8s ease-in-out infinite;
}
.hero-grid{display:grid; grid-template-columns:1.15fr 0.85fr; gap:56px; align-items:center; position:relative; z-index:1;}
#hero h1{font-size:clamp(32px,4.6vw,54px); line-height:1.08; margin-bottom:22px;}
#hero h1 em{font-style:normal; color:var(--teal);}
.lead{font-size:18px; color:var(--gray); max-width:64ch; margin-bottom:32px;}
.typed-wrap{display:inline-flex; align-items:center; gap:2px;}
.typed-text{
    background:linear-gradient(135deg, #14B8A6 0%, #0D9488 50%, #F4A623 100%);
    -webkit-background-clip:text;
    -webkit-text-fill-color:transparent;
    background-clip:text;
    font-weight:700;
    transition:opacity .25s ease;
}
.typed-text.hide-cursor{opacity:0;}
.cursor{
    display:inline-block; width:3px; height:1.15em;
    background:linear-gradient(180deg, #14B8A6, #F4A623);
    border-radius:2px;
    animation:blink .7s infinite;
    vertical-align:text-bottom;
    box-shadow:0 0 8px rgba(20,184,166,0.5);
    transition:opacity .25s ease;
}
.cursor.hide-cursor{opacity:0;}
@keyframes blink{0%,100%{opacity:1;} 50%{opacity:0;}}
@keyframes morphBlob{
    0%,100%{border-radius:50% 50% 50% 50% / 50% 50% 50% 50%; transform:translate(0,0) scale(1);}
    25%{border-radius:40% 60% 55% 45% / 50% 45% 55% 50%; transform:translate(40px,-30px) scale(1.05);}
    50%{border-radius:55% 45% 45% 55% / 45% 55% 45% 55%; transform:translate(-20px,40px) scale(0.95);}
    75%{border-radius:45% 55% 50% 50% / 55% 50% 50% 45%; transform:translate(30px,20px) scale(1.02);}
}
@keyframes glassSweep{
    0%,100%{transform:translateX(-100%);}
    50%{transform:translateX(100%);}
}
.hero-ctas{display:flex; gap:14px; flex-wrap:wrap; margin-bottom:44px;}
.stats{display:flex; gap:36px; flex-wrap:wrap;}
.stat b{display:block; font-family:'JetBrains Mono',monospace; font-size:26px; color:var(--navy);}
.stat span{font-size:13px; color:var(--gray);}
.hero-art{display:flex; align-items:center; justify-content:center;}
.hero-svg{width:100%; max-width:340px; height:auto;}

.hero-svg .circle-base{animation:float 6s ease-in-out infinite;}
.hero-svg .circle-ring{animation:spin-slow 20s linear infinite; transform-origin:150px 150px;}
.hero-svg .circle-ring-2{animation:spin-slow 30s linear infinite reverse; transform-origin:150px 150px;}
.hero-svg .circle-ring-3{animation:spin-slow 15s linear infinite; transform-origin:150px 150px;}
.hero-svg .svg-path{stroke-dasharray:400; animation:draw 3s ease forwards;}
.hero-svg .dot-start{animation:pulse-dot 3s ease-in-out infinite;}
.hero-svg .dot-end-main{animation:pulse-dot 2s ease-in-out infinite 1s;}
.hero-svg .dot-end-ring{animation:pulse-dot 2s ease-in-out infinite 1s;}
.hero-svg .particle{animation:twinkle 3s ease-in-out infinite;}
.hero-svg .p1{animation-delay:0s;}
.hero-svg .p2{animation-delay:0.8s;}
.hero-svg .p3{animation-delay:1.6s;}
.hero-svg .p4{animation-delay:2.4s;}

@keyframes float{
    0%,100%{transform:translateY(0);}
    50%{transform:translateY(-8px);}
}
@keyframes spin-slow{
    to{transform:rotate(360deg);}
}
@keyframes draw{
    to{stroke-dashoffset:0;}
}
@keyframes pulse-dot{
    0%,100%{opacity:1; transform:scale(1);}
    50%{opacity:0.7; transform:scale(1.1);}
}
@keyframes twinkle{
    0%,100%{opacity:0.2;}
    50%{opacity:0.8;}
}

@media (max-width:900px){
    .hero-grid{grid-template-columns:1fr;}
    .hero-art{order:-1; max-width:220px; margin:0 auto 12px;}
}
</style>
