import { createMemoryHistory, createRouter } from 'vue-router'
import MyHome from '../components/MyHome.vue';
import MyBody from '../components/MyBody.vue';


const routes = [
  { path: '/', name:'home', component: MyHome },
  { path: '/categories', name:'categories', component: MyBody },
]

const router = createRouter({
  history: createMemoryHistory(),
  routes,
})



export default router;
