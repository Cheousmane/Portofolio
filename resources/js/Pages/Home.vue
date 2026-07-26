<script setup>
import { onMounted } from 'vue'
import ConnectorSpine from '@/Components/ConnectorSpine.vue';
import SiteHeader from '@/Components/SiteHeader.vue';
import Hero from '@/Components/Hero.vue';
import ServiceCard from '@/Components/ServiceCard.vue';
import WhyGrid from '@/Components/WhyGrid.vue';
import ContactForm from '@/Components/ContactForm.vue';
import SiteFooter from '@/Components/SiteFooter.vue';
import AnimatedCounter from '@/Components/AnimatedCounter.vue';
import RevealText from '@/Components/RevealText.vue';

defineProps({
    stats: { type: Array, required: true },
    typingStrings: { type: Array, required: true },
    languages: { type: Array, required: true },
    services: { type: Array, required: true },
    why: { type: Array, required: true },
    contact: { type: Object, required: true },
    skills: { type: Array, required: true },
    projectStats: { type: Array, required: true },
    projects: { type: Array, required: true },
    socials: { type: Array, required: true },
});

onMounted(() => {
    const observer = new IntersectionObserver(
        (entries) => {
            entries.forEach((entry) => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('revealed')
                }
            })
        },
        { threshold: 0.15, rootMargin: '0px 0px -40px 0px' }
    )
    document.querySelectorAll('.reveal, .reveal-left, .reveal-right').forEach((el) => observer.observe(el))
})
</script>

<template>
    <ConnectorSpine />
    <SiteHeader />

    <main>
        <Hero :stats="stats" :typing-strings="typingStrings" />

        <section id="apropos">
            <div class="wrap about-grid">
                <div class="reveal-left">
                    <div class="eyebrow">À propos</div>
                    <RevealText text="Un profil hybride, formé sous pression" tag="h2" class="h2" />
                </div>
                <div class="reveal-right">
                    <p>Depuis <strong>5 ans</strong>, j'opère sur deux fronts complémentaires&nbsp;: l'infrastructure réseau et le développement web. Chez <strong>Call Me Mali</strong> (400+ employés), je tiens le support IT de première ligne — réseau, postes, Google Workspace, reporting — sous une charge quotidienne de 50+ utilisateurs.</p>
                    <p>En parallèle, je conçois et livre des applications web complètes avec Laravel, Vue.js et Inertia.js&nbsp;: SaaS facturation/stock, messagerie interne, gestion de parc informatique. Chaque projet est pensé pour résoudre un vrai problème métier, pas pour faire joli.</p>
                    <p>Titulaire d'une Licence en SIG (IUG Bamako) et en cours de certification <strong>CCNA</strong>, je parle couramment français, anglais et bambara. Cette double casquette fait que je ne refile pas la responsabilité au «&nbsp;service réseau&nbsp;» — je suis les deux bouts de la chaîne.</p>
                    <div class="langs">
                        <span class="chip" v-for="lang in languages" :key="lang.label">{{ lang.flag }} {{ lang.label }}</span>
                    </div>
                    <div class="skills-compact">
                        <div v-for="group in skills" :key="group.category" class="skill-group">
                            <strong>{{ group.category }}</strong>
                            <span v-for="item in group.items" :key="item" class="chip">{{ item }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section id="services">
            <div class="wrap">
                <div class="eyebrow reveal">Services</div>
                <RevealText text="Ce que je vous apporte" tag="h2" class="h2" />
                <p class="intro reveal">De l'infrastructure réseau au design graphique, en passant par le développement web — un seul interlocuteur pour tous vos besoins digitaux.</p>

                <div class="services-grid">
                    <ServiceCard v-for="(service, i) in services" :key="service.title" v-bind="service" :style="{ transitionDelay: `${i * 0.12}s` }" class="reveal" />
                </div>
            </div>
        </section>

        <section id="projets">
            <div class="wrap">
                <div class="eyebrow reveal">Réalisations</div>
                <RevealText text="Projets concrets, résultats visibles" tag="h2" class="h2" />
                <div class="projects-grid">
                    <div v-for="(proj, i) in projects" :key="proj.title" class="project-card glass hover-glow reveal" :style="{ transitionDelay: `${i * 0.12}s` }">
                        <span class="project-tag">{{ proj.tag }}</span>
                        <h3>{{ proj.title }}</h3>
                        <p>{{ proj.description }}</p>
                        <div class="project-stack">
                            <span v-for="tech in proj.stack" :key="tech" class="chip">{{ tech }}</span>
                        </div>
                    </div>
                </div>

                <h2 class="h2 reveal" style="margin-top:60px;">Chiffres clés</h2>
                <div class="project-stats">
                    <div v-for="(p, i) in projectStats" :key="p.label" class="project-stat-box reveal" :style="{ transitionDelay: `${i * 0.15}s` }">
                        <div class="stat-icon-wrap">
                            <i :class="'uil uil-' + p.icon"></i>
                        </div>
                        <h3><AnimatedCounter :value="p.value" /></h3>
                        <label>{{ p.label }}</label>
                    </div>
                </div>
            </div>
        </section>

        <section id="pourquoi">
            <div class="wrap">
                <div class="eyebrow reveal">Pourquoi moi</div>
                <RevealText text="Ce que ça change pour vous" tag="h2" class="h2" />
                <WhyGrid :items="why" />
            </div>
        </section>

        <ContactForm :contact="contact" />
    </main>

    <SiteFooter :socials="socials" :contact="contact" />
</template>

<style scoped>
.h2{font-size:30px;}
@media (max-width:480px){ .h2{font-size:24px;} }
.about-grid{display:grid; grid-template-columns:0.9fr 1.1fr; gap:56px; align-items:start;}
.about-grid p{color:var(--gray); margin-bottom:16px; max-width:60ch;}
.langs{display:flex; gap:10px; flex-wrap:wrap; margin-top:18px;}
.skills-compact{display:flex; flex-wrap:wrap; gap:20px; margin-top:24px; padding-top:24px; border-top:1px solid var(--line);}
.skill-group{display:flex; flex-wrap:wrap; align-items:center; gap:8px;}
.skill-group strong{font-size:12px; text-transform:uppercase; letter-spacing:0.06em; color:var(--teal); min-width:90px;}
@media (max-width:900px){ .about-grid{grid-template-columns:1fr; gap:32px;} }
@media (max-width:480px){ .about-grid{gap:24px;} .skill-group strong{min-width:70px;font-size:11px;} }
@media (max-width:400px){ .about-grid{gap:16px;} .skill-group{gap:4px;} .skill-group strong{min-width:100%;margin-bottom:2px;} }

.intro{color:var(--gray); max-width:60ch; margin-bottom:36px;}
.services-grid{display:grid; grid-template-columns:repeat(3,1fr); gap:24px;}
@media (max-width:900px){ .services-grid{grid-template-columns:1fr 1fr;} }
@media (max-width:600px){ .services-grid{grid-template-columns:1fr;} }

.projects-grid{display:grid; grid-template-columns:repeat(3,1fr); gap:24px; margin-top:32px;}
.project-card{
    padding:28px; border-radius:var(--radius); display:flex; flex-direction:column; gap:12px;
    transition:transform .3s ease, box-shadow .3s ease, opacity .7s ease, transform .7s ease;
}
.project-card:hover{
    transform:translateY(-4px) scale(1.01);
    box-shadow:0 12px 32px rgba(0,0,0,0.06);
}
.project-tag{
    align-self:flex-start; font-size:11px; font-weight:700; text-transform:uppercase; letter-spacing:0.08em;
    padding:3px 10px; border-radius:999px; background:var(--tag-bg); color:var(--tag-text);
}
.project-card h3{font-size:17px; color:var(--navy);}
.project-card p{font-size:14px; color:var(--gray); line-height:1.6;}
.project-stack{display:flex; flex-wrap:wrap; gap:6px; margin-top:auto;}
.project-stack .chip{font-size:11px;}
@media (max-width:800px){ .projects-grid{grid-template-columns:1fr;} }

.project-stats{display:flex; gap:24px;}
.project-stat-box{
    flex:1; display:flex; flex-direction:column; align-items:center; gap:12px;
    padding:48px 24px 40px;
    border-radius:var(--radius); text-align:center;
    position:relative; overflow:hidden;
    transition:transform .3s ease, box-shadow .3s ease, opacity .7s ease, transform .7s ease;
}
.project-stat-box:nth-child(1){
    background:linear-gradient(145deg, var(--stat-navy) 0%, var(--stat-navy-2) 100%);
}
.project-stat-box:nth-child(2){
    background:linear-gradient(145deg, var(--stat-teal-bg) 0%, var(--stat-teal) 100%);
}
.project-stat-box:nth-child(3){
    background:linear-gradient(145deg, var(--stat-amber-bg) 0%, var(--stat-amber) 100%);
}
.project-stat-box::before{
    content:''; position:absolute; top:-40%; right:-20%;
    width:180px; height:180px; border-radius:50%;
    background:rgba(255,255,255,0.04);
}
.project-stat-box::after{
    content:''; position:absolute; bottom:-30%; left:-10%;
    width:120px; height:120px; border-radius:50%;
    background:rgba(255,255,255,0.03);
}
.project-stat-box:hover{
    transform:translateY(-6px) scale(1.02);
    box-shadow:0 20px 48px rgba(0,0,0,0.15);
}
.stat-icon-wrap{
    display:flex; align-items:center; justify-content:center;
    width:56px; height:56px; border-radius:50%;
    background:rgba(255,255,255,0.12);
    position:relative; z-index:1;
}
.project-stat-box i{font-size:26px; color:#fff;}
.project-stat-box h3{
    font-size:28px; color:#fff; font-family:'Space Grotesk',sans-serif;
    position:relative; z-index:1;
}
.project-stat-box label{
    font-size:14px; color:rgba(255,255,255,0.75); font-weight:500;
    position:relative; z-index:1;
}
@media (max-width:700px){ .project-stats{flex-direction:column; gap:16px;} }
@media (max-width:480px){
    .project-stat-box{padding:36px 20px 32px;}
    .project-stat-box h3{font-size:24px;}
}
@media (max-width:400px){
    .project-card{padding:20px 16px;}
    .project-card h3{font-size:16px;}
    .project-card p{font-size:13px;}
}
</style>
