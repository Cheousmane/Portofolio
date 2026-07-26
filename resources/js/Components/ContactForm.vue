<script setup>
import { useForm, usePage } from '@inertiajs/vue3';

defineProps({
    contact: { type: Object, required: true },
});

const page = usePage();

const form = useForm({
    name: '',
    email: '',
    service: '',
    message: '',
});

function submit() {
    form.post(route('contact.store'), {
        preserveScroll: true,
        onSuccess: () => form.reset(),
    });
}
</script>

<template>
    <section id="contact">
        <div class="wrap contact-grid">
            <div>
                <div class="eyebrow">Contact</div>
                <h2 class="title">Parlons de votre besoin</h2>
                <div class="contact-info">
                    <a :href="`mailto:${contact.email}`">✉️ {{ contact.email }}</a>
                    <a :href="`tel:${contact.phone_href}`">📞 {{ contact.phone }}</a>
                    <span class="location">📍 {{ contact.location }}</span>
                </div>
                <div class="avail">Disponible immédiatement · Support à distance ou intervention sur site à Bamako.</div>
            </div>

            <div>
                <p v-if="page.props.flash?.success" class="success-banner">
                    {{ page.props.flash.success }}
                </p>

                <form @submit.prevent="submit">
                    <div>
                        <label for="name">Nom</label>
                        <input id="name" v-model="form.name" type="text" required>
                        <p v-if="form.errors.name" class="error">{{ form.errors.name }}</p>
                    </div>
                    <div>
                        <label for="email">Email</label>
                        <input id="email" v-model="form.email" type="email" required>
                        <p v-if="form.errors.email" class="error">{{ form.errors.email }}</p>
                    </div>
                    <div>
                        <label for="service">Besoin</label>
                        <input id="service" v-model="form.service" type="text" placeholder="Support IT, développement web, les deux...">
                    </div>
                    <div>
                        <label for="message">Message</label>
                        <textarea id="message" v-model="form.message" required placeholder="Décrivez votre projet ou votre problème technique en quelques lignes."></textarea>
                        <p v-if="form.errors.message" class="error">{{ form.errors.message }}</p>
                    </div>
                    <button type="submit" class="btn amber submit-btn" :disabled="form.processing">
                        {{ form.processing ? 'Envoi...' : 'Envoyer le message' }}
                    </button>
                </form>
            </div>
        </div>
    </section>
</template>

<style scoped>
.title{font-size:30px;margin-bottom:18px;}
.contact-grid{display:grid; grid-template-columns:0.85fr 1.15fr; gap:56px;}
.contact-info a, .contact-info .location{display:flex; align-items:center; gap:12px; padding:12px 0; border-bottom:1px solid var(--line); font-size:15px;}
.contact-info a:hover{color:var(--teal);}
.avail{
    margin-top:24px; padding:16px 18px; background:var(--contact-avail-bg); border:1px solid var(--contact-avail-border);
    border-radius:10px; font-size:13.5px; color:var(--contact-avail-text);
}
.success-banner{
    margin-bottom:16px; padding:14px 16px; background:var(--contact-success-bg); border:1px solid var(--contact-success-border);
    border-radius:10px; font-size:14px; color:var(--contact-success-text);
}
form{display:flex; flex-direction:column; gap:14px;}
label{font-size:13px; font-weight:600; color:var(--navy-2); margin-bottom:6px; display:block;}
input, textarea{
    width:100%; padding:13px 14px; border:1px solid var(--line); border-radius:10px;
    font-family:'Inter',sans-serif; font-size:14.5px; background:var(--contact-input-bg); color:var(--navy);
}
input:focus, textarea:focus{border-color:var(--teal); outline:none;}
textarea{resize:vertical; min-height:120px;}
.error{color:#C0392B; font-size:12.5px; margin-top:4px;}
.submit-btn{align-self:flex-start; margin-top:6px;}
.submit-btn:disabled{opacity:0.6; cursor:default;}
@media (max-width:900px){ .contact-grid{grid-template-columns:1fr; gap:32px;} }
@media (max-width:480px){
    .title{font-size:24px;}
    input, textarea{padding:11px 12px; font-size:14px;}
    .submit-btn{width:100%; justify-content:center;}
}
</style>
