import { createRouter, createWebHistory } from "vue-router";

import itemIndex from '../components/items/index.vue'

import loginIndex from '../components/login/index.vue'
import logout from '../components/login/logout.vue'
import home from '../components/home/index.vue'
import sales from '../components/sales/index.vue'
import saleEntry from '../components/sales/saleEntry.vue'

import notFound from '../components/NotFound.vue'


const routes = [
    {
        path:'/',
        component: loginIndex,
      
    },
    {
        path:'/home',
        component: home,
        meta: {
            requiresAuth: true
        }
    },
    {
        path:'/items',
        component: itemIndex,
        meta: {
            requiresAuth: true
        }
    },
    {
        path:'/login',
        component: loginIndex
    },
    {
        path:'/sales',
        component: sales,
        meta: {
            requiresAuth: true
        }
    },
    {
        path:'/saleEntry',
        component: saleEntry,
        meta: {
            requiresAuth: true
        }
    },
    {
        path:'/logout',
        component: logout,
        
    },
    {
        path:'/:pathMatch(.*)*',
        component: notFound
    }
]

const router = createRouter({
    history: createWebHistory(),
    routes
})

// Meta Handling
router.beforeEach((to, from, next) => {
    if (to.matched.some(record => record.meta.requiresAuth)) {
      if (localStorage.getItem('usersession') == null) {
        next({
          path: '/login',
          params: { nextUrl: to.fullPath }
        })
      } else {
        let user = JSON.parse(localStorage.getItem('user'))
        if (to.matched.some(record => record.meta.is_admin)) {
          if (user.is_admin == 1) {
            next()
          } else {
            next({ name: 'userboard' })
          }
        } else {
          next()
        }
      }
    } else if (to.matched.some(record => record.meta.guest)) {
      if (localStorage.getItem('usersession') == null) {
        next()
      } else {
        next({ name: 'userboard' })
      }
    } else {
      next()
    }
  })
  
  export default router