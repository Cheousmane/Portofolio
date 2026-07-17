<script setup>
import LogoMark from './LogoMark.vue';

defineProps({
    socials: { type: Array, required: true },
    contact: { type: Object, required: true },
});
</script>

<template>
    <footer>
        <div class="wrap foot-grid">
            <div class="foot-col brand-col">
                <div class="foot-brand">
                    <LogoMark :size="32" />
                    <span>SID-TECH</span>
                </div>
                <p class="foot-tagline">La technologie au service de votre réussite. Support IT &amp; développement web sur mesure.</p>
                <div class="foot-socials" v-if="socials.length">
                    <a v-for="s in socials" :key="s.label" :href="s.url" class="social-icon" :title="s.label">
                        <i :class="s.icon"></i>
                    </a>
                </div>
            </div>
            <div class="foot-col">
                <h4>Navigation</h4>
                <a href="#services">Services</a>
                <a href="#apropos">À propos</a>
                <a href="#experience">Expérience</a>
                <a href="#projets">Réalisations</a>
                <a href="#contact">Contact</a>
            </div>
            <div class="foot-col">
                <h4>Contact</h4>
                <a :href="'mailto:' + contact.email">{{ contact.email }}</a>
                <a :href="'tel:' + contact.phone_href">{{ contact.phone }}</a>
                <span>{{ contact.location }}</span>
            </div>
        </div>
        <div class="foot-bottom">
            <div class="wrap">
                <p>&copy; {{ new Date().getFullYear() }} SIDIBE TECHNOLOGIES. Tous droits réservés.</p>
            </div>
        </div>
    </footer>
</template>

<style scoped>
footer{
    background:var(--footer-bg); border-top:1px solid var(--line);
    padding-top:56px;
}
.foot-grid{
    display:grid; grid-template-columns:1.4fr 0.8fr 0.8fr; gap:48px;
}
.foot-col{display:flex; flex-direction:column; gap:10px;}
.foot-brand{
    display:flex; align-items:center; gap:10px;
    font-family:'Space Grotesk',sans-serif; font-weight:700; font-size:20px;
}
.foot-tagline{color:var(--gray); font-size:14px; line-height:1.6; margin:4px 0 10px;}
.foot-socials{display:flex; gap:10px;}
.social-icon{
    display:flex; align-items:center; justify-content:center;
    width:36px; height:36px; border-radius:50%; border:1px solid var(--line);
    color:var(--gray); font-size:15px;
    transition:all .3s ease;
}
.social-icon:hover{
    color:var(--teal); border-color:var(--teal);
    transform:translateY(-3px) scale(1.1);
    box-shadow:0 6px 16px rgba(20,184,166,0.15);
}
.foot-col h4{
    font-size:13px; text-transform:uppercase; letter-spacing:0.1em;
    color:var(--navy); margin-bottom:2px;
}
.foot-col a, .foot-col span{
    font-size:14px; color:var(--gray); text-decoration:none;
    transition:color .2s;
}
.foot-col a:hover{color:var(--teal);}
.foot-bottom{
    margin-top:40px; padding:18px 0;
    border-top:1px solid var(--line);
}
.foot-bottom p{font-size:13px; color:var(--gray); text-align:center;}

@media (max-width:800px){
    .foot-grid{grid-template-columns:1fr 1fr; gap:32px;}
    .brand-col{grid-column:1 / -1;}
}
@media (max-width:480px){
    .foot-grid{grid-template-columns:1fr;}
}
</style>
