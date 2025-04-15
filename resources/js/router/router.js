import { createRouter, createWebHistory } from 'vue-router';
import app from '../layouts/app.vue';
import clients from '../layouts/clients.vue';
import pricing from '../layouts/pricing.vue';
import projects from '../layouts/projects.vue';

const routes = [
  { path: '/app', name: 'app', component: app },
  { path: '/clients', name: 'clients', component: clients },
  { path: '/pricing', name: 'pricing', component: pricing },
  { path: '/projects', name: 'projects', component: projects }
];

const router = createRouter({
  history: createWebHistory(),
  routes,
});

export default router;