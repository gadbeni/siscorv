import Vue from 'vue'
import Router from 'vue-router'

Vue.use(Router)

const Tramites = () => import('../views/frontend/tramites.vue')
const Treeview = () => import('../views/frontend/tree.vue')

export default new Router({
	mode: 'history',
	routes: [
		{
			path: '/tramites',
			component: Tramites
		},
		{
			path: '/tree',
			component: Treeview
		}
	]
})