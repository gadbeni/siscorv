import Vue from 'vue'
import Router from 'vue-router'

Vue.use(Router)

const Tramites = () => import('../views/frontend/tramites.vue')
const Personerias = () => import('../views/frontend/personeria.vue')
const Requitems = () => import('../views/frontend/requirement.vue')
export default new Router({
	mode: 'history',
	routes: [
		{
			path: '/tramites',
			component: Tramites
		},
		{
			path: '/personerias',
			component: Personerias
		},
		{ 
			path: '/requisitos',
			component: Requitems
		}
	]
})