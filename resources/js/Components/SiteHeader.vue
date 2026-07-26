<script setup>
import { ref, onMounted, onUnmounted } from 'vue'
import LogoMark from './LogoMark.vue';
import DarkModeToggle from './DarkModeToggle.vue';

const activeSection = ref('hero')
const scrolled = ref(false)
const mobileOpen = ref(false)

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

function closeMobile() { mobileOpen.value = false }

onMounted(() => {
    window.addEventListener('scroll', onScroll, { passive: true })
    document.addEventListener('click', closeMobile)
})
onUnmounted(() => {
    window.removeEventListener('scroll', onScroll)
    document.removeEventListener('click', closeMobile)
})
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
                <a href="#contact" class="btn header-btn">Demander un devis</a>
                <button class="hamburger" :class="{ active: mobileOpen }" @click.stop="mobileOpen = !mobileOpen" aria-label="Menu">
                    <span></span><span></span><span></span>
                </button>
            </div>
        </nav>
        <div class="mobile-menu" :class="{ open: mobileOpen }" @click.stop>
            <a href="#services" @click="closeMobile" :class="{ active: activeSection === 'services' }">Services</a>
            <a href="#apropos" @click="closeMobile" :class="{ active: activeSection === 'apropos' }">À propos</a>
            <a href="#experience" @click="closeMobile" :class="{ active: activeSection === 'experience' }">Expérience</a>
            <a href="#projets" @click="closeMobile" :class="{ active: activeSection === 'projets' }">Réalisations</a>
            <a href="#pourquoi" @click="closeMobile" :class="{ active: activeSection === 'pourquoi' }">Pourquoi moi</a>
            <a href="#contact" @click="closeMobile" :class="{ active: activeSection === 'contact' }" class="mobile-cta">Contact</a>
        </div>
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

.hamburger{
    display:none; flex-direction:column; gap:4px; cursor:pointer;
    background:none; border:none; padding:4px; z-index:25;
}
.hamburger span{
    display:block; width:22px; height:2px; background:var(--navy);
    border-radius:2px; transition:all .3s ease;
}
.hamburger.active span:nth-child(1){transform:rotate(45deg) translate(4px,4px);}
.hamburger.active span:nth-child(2){opacity:0;}
.hamburger.active span:nth-child(3){transform:rotate(-45deg) translate(4px,-4px);}

.mobile-menu{
    display:none; position:fixed; top:0; right:-100%; width:280px; height:100vh;
    background:var(--card); flex-direction:column; gap:8px;
    padding:88px 28px 32px; box-shadow:-8px 0 32px var(--glass-shadow);
    transition:right .35s ease; z-index:24;
}
.mobile-menu.open{right:0;}
.mobile-menu a{
    font-size:16px; font-weight:500; color:var(--navy-2); padding:12px 0;
    border-bottom:1px solid var(--line); transition:color .2s;
}
.mobile-menu a:hover, .mobile-menu a.active{color:var(--teal);}
.mobile-cta{color:var(--teal) !important; font-weight:700;}

@media (max-width:720px){
    .navlinks{display:none;}
    .avail-badge{display:none;}
    .hamburger{display:flex;}
    .mobile-menu{display:flex;}
}
@media (max-width:480px){
    .header-btn{display:none;}
    nav{padding:12px 20px;}
    header.compact nav{padding:8px 20px;}
    .brand{font-size:17px;}
}
@media (max-width:400px){
    nav{padding:10px 12px;}
    header.compact nav{padding:6px 12px;}
    .brand{font-size:15px; gap:6px;}
    .brand small{font-size:9px;}
    .mobile-menu{width:100%;}
    .header-right{gap:10px;}
}
</style>
