<script setup>
import { ref, onMounted, onUnmounted } from 'vue'
import LogoMark from './LogoMark.vue';
import DarkModeToggle from './DarkModeToggle.vue';

const activeSection = ref('hero')
const scrolled = ref(false)

function onScroll() {
    scrolled.value = window.scrollY > 60
    const sections = ['hero', 'apropos', 'services', 'experience', 'projets', 'pourquoi', 'contact']
    for (const id of sections) {
        const el = document.getElementById(id)
        if (el) {
            const rect = el.getBoundingClientRect()
            if (rect.top <= 150 && rect.bottom >= 150) {
                activeSection.value = id
                break
            }
        }
    }
}

onMounted(() => window.addEventListener('scroll', onScroll, { passive: true }))
onUnmounted(() => window.removeEventListener('scroll', onScroll))
</script>

<template>
    <header :class="{ compact: scrolled }">
        <nav>
            <a href="#hero" class="brand">
                <LogoMark :size="30" />
                <span>SID-TECH<small>SIDIBE TECHNOLOGIES</small></span>
            </a>
            <div class="navlinks">
                <a href="#services" :class="{ active: activeSection === 'services' }">Services</a>
                <a href="#apropos" :class="{ active: activeSection === 'apropos' }">À propos</a>
                <a href="#experience" :class="{ active: activeSection === 'experience' }">Expérience</a>
                <a href="#contact" :class="{ active: activeSection === 'contact' }">Contact</a>
            </div>
            <div class="header-right">
                <DarkModeToggle />
                <span class="avail-badge"><span class="pulse-dot"></span> Disponible</span>
                <a href="#contact" class="btn">Demander un devis</a>
            </div>
        </nav>
    </header>
</template>

<style scoped>
header{
    position:sticky; top:0; z-index:20;
    background:transparent;
    backdrop-filter:blur(14px);
    -webkit-backdrop-filter:blur(14px);
    border-bottom:1px solid rgba(20,184,166,0.08);
    transition:padding .3s ease, box-shadow .3s ease, background .3s ease;
}
header.compact{
    background:var(--glass-bg);
    box-shadow:0 4px 30px var(--glass-shadow);
}
nav{
    max-width:1080px; margin:0 auto; padding:16px 28px;
    display:flex; align-items:center; justify-content:space-between;
    transition:padding .3s ease;
}
header.compact nav{padding:10px 28px;}
.brand{display:flex; align-items:center; gap:10px; font-family:'Space Grotesk',sans-serif; font-weight:700; font-size:19px;}
.brand small{display:block; font-family:'JetBrains Mono',monospace; font-weight:400; font-size:10px; letter-spacing:0.14em; color:var(--gray); text-transform:uppercase;}
.navlinks{display:flex; gap:28px; font-size:14px; font-weight:500; color:var(--navy-2);}
.navlinks a{position:relative; transition:color .2s;}
.navlinks a:hover{color:var(--teal);}
.navlinks a.active{color:var(--teal);}
.navlinks a.active::after{
    content:''; position:absolute; bottom:-4px; left:0; width:100%; height:2px;
    background:var(--teal); border-radius:1px;
}
.header-right{display:flex; align-items:center; gap:16px;}
.avail-badge{
    display:flex; align-items:center; gap:6px;
    font-size:12px; font-weight:600; color:var(--badge-text);
    background:var(--badge-bg); padding:5px 12px; border-radius:999px;
}
.pulse-dot{
    width:8px; height:8px; border-radius:50%; background:var(--badge-dot); display:inline-block;
    animation:pulse 2s ease-in-out infinite;
}
@keyframes pulse {
    0%, 100%{opacity:1; transform:scale(1);}
    50%{opacity:0.6; transform:scale(1.3);}
}

@media (max-width:720px){
    .navlinks{display:none;}
    .avail-badge{display:none;}
}
</style>
