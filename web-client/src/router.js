import Vue from 'vue'
import Router from 'vue-router'
import Home from './views/Home.vue'
// import Users from './views/Administrator/Users.vue'
// import MyCustomers from './views/Administrator/Customers.vue'
// import Posts from './views/Administrator/Posts'
// import AppSubscription from './views/Administrator/AppSubscription.vue'
// import UserComplaints from './views/Administrator/UserComplaints.vue'
// import SignUp from './views/Account/SignUp.vue'
import Login from './views/Account/Login.vue'
import PasswordReset from './views/Account/PasswordReset.vue'
import MyProfile from './views/Account/MyProfile.vue'
import UserProfile from './views/Administrator/UserProfile.vue'
import UserTypes from './views/Administrator/UserTypes.vue'
import UserTypePermissions from './views/Administrator/UserTypePermissions.vue'
import UserAccounts from './views/Administrator/UserAccounts.vue'
import DistributorRegistration from './views/Administrator/DistributorRegistration.vue'
import MerchantRegistration from './views/Administrator/MerchantRegistration.vue'
import FieldTellerRegistration from './views/Administrator/FieldTellerRegistration.vue'
import TopUpDistributor from './views/Administrator/TopUpDistributor.vue'
import DistributorFloatTransfer from './views/Administrator/DistributorFloatTransfer.vue'
import DistributorFloatSales from './views/Administrator/DistributorFloatSales.vue'
import DistributorTransactions from './views/Administrator/DistributorTransactions.vue'
import FieldTellerMerchantPairing from './views/Administrator/FieldTellerMerchantPairing.vue'
import ActivePairs from './views/Administrator/ActivePairs.vue'
import MerchantCashPickupSchedule from './views/Administrator/MerchantCashPickupSchedule.vue'
import MerchantCashPickupRequest from './views/Administrator/MerchantCashPickupRequest.vue'
import MerchantManualSettlement from './views/Administrator/MerchantManualSettlement.vue'
import MerchantTransactions from './views/Administrator/MerchantTransactions.vue'
import FieldTellerFloatTransfer from './views/Administrator/FieldTellerFloatTransfer.vue'
import FieldTellerTransactions from './views/Administrator/FieldTellerTransactions.vue'
import FieldTellerCommissionSettlement from './views/Administrator/FieldTellerCommissionSettlement.vue'
import UserTransactions from './views/Administrator/UserTransactions.vue'

Vue.use(Router)

const router = new Router({
  routes: [
    {
      path: '/',
      name: 'home',
      component: Home
    },
    {
      path: '/usertypes',
      name: 'usertypes',
      component: UserTypes,
      props(route) {
        return { userGroup: route.params.userGroup }
      }
    },
    {
      path: '/distributorusertypes',
      name: 'distributorusertypes',
      component: UserTypes,
      props(route) {
        return { userGroup: route.params.userGroup }
      }
    },
    {
      path: '/merchantusertypes',
      name: 'merchantusertypes',
      component: UserTypes,
      props(route) {
        return { userGroup: route.params.userGroup }
      }
    },
    {
      path: '/fieldtellerusertypes',
      name: 'fieldtellerusertypes',
      component: UserTypes,
      props(route) {
        return { userGroup: route.params.userGroup }
      }
    },
    {
      path: '/usertypepermissions',
      name: 'usertypepermissions',
      component: UserTypePermissions,
      props(route) {
        return { userGroup: route.params.userGroup }
      }
    },
    {
      path: '/distributorusertypepermissions',
      name: 'distributorusertypepermissions',
      component: UserTypePermissions,
      props(route) {
        return { userGroup: route.params.userGroup }
      }
    },
    {
      path: '/merchantusertypepermissions',
      name: 'merchantusertypepermissions',
      component: UserTypePermissions,
      props(route) {
        return { userGroup: route.params.userGroup }
      }
    },
    {
      path: '/fieldtellerusertypepermissions',
      name: 'fieldtellerusertypepermissions',
      component: UserTypePermissions,
      props(route) {
        return { userGroup: route.params.userGroup }
      }
    },
    {
      path: '/useraccounts',
      name: 'useraccounts',
      component: UserAccounts,
      props(route) {
        return { userGroup: route.params.userGroup }
      }
    },
    {
      path: '/distributoruseraccounts',
      name: 'distributoruseraccounts',
      component: UserAccounts,
      props(route) {
        return { userGroup: route.params.userGroup }
      }
    },
    {
      path: '/fieldtelleruseraccounts',
      name: 'fieldtelleruseraccounts',
      component: UserAccounts,
      props(route) {
        return { userGroup: route.params.userGroup }
      }
    },
    {
      path: '/merchantuseraccounts',
      name: 'merchantuseraccounts',
      component: UserAccounts,
      props(route) {
        return { userGroup: route.params.userGroup }
      }
    },
    {
      path: '/distributorregistration',
      name: 'distributorregistration',
      component: DistributorRegistration
    },
    {
      path: '/merchantregistration',
      name: 'merchantregistration',
      component: MerchantRegistration
    },
    {
      path: '/fieldtellerregistration',
      name: 'fieldtellerregistration',
      component: FieldTellerRegistration
    },
    {
      path: '/topupdistributor',
      name: 'topupdistributor',
      component: TopUpDistributor
    },
    {
      path: '/distributorfloattransfer',
      name: 'distributorfloattransfer',
      component: DistributorFloatTransfer
    },
    {
      path: '/distributorfloatsales',
      name: 'distributorfloatsales',
      component: DistributorFloatSales
    },
    {
      path: '/distributortransactions',
      name: 'distributortransactions',
      component: DistributorTransactions
    },
    {
      path: '/fieldtellermerchantpairing',
      name: 'fieldtellermerchantpairing',
      component: FieldTellerMerchantPairing
    },
    {
      path: '/activepairs',
      name: 'activepairs',
      component: ActivePairs
    },
    {
      path: '/merchantcashpickupschedule',
      name: 'merchantcashpickupschedule',
      component: MerchantCashPickupSchedule
    },
    {
      path: '/merchantcashpickuprequest',
      name: 'merchantcashpickuprequest',
      component: MerchantCashPickupRequest
    },
    {
      path: '/merchantmanualsettlement',
      name: 'merchantmanualsettlement',
      component: MerchantManualSettlement
    },
    {
      path: '/merchanttransactions',
      name: 'merchanttransactions',
      component: MerchantTransactions
    },
    {
      path: '/fieldtellerfloattransfer',
      name: 'fieldtellerfloattransfer',
      component: FieldTellerFloatTransfer
    },
    {
      path: '/fieldtellertransactions',
      name: 'fieldtellertransactions',
      component: FieldTellerTransactions
    },
    {
      path: '/fieldtellercommissionsettlement',
      name: 'fieldtellercommissionsettlement',
      component: FieldTellerCommissionSettlement
    },
    {
      path: '/usertransactions',
      name: 'usertransactions',
      component: UserTransactions
    },
    // {
    //   path: '/users',
    //   name: 'users',
    //   component: Users
    // },
    // {
    //   path: '/mycustomers',
    //   name: 'mycustomers',
    //   component: MyCustomers
    // },
    // {
    //   path: '/posts',
    //   name: 'posts',
    //   component: Posts
    // },
    // {
    //   path: '/appsubscription',
    //   name: 'appsubscription',
    //   component: AppSubscription
    // },
    // {
    //   path: '/usercomplaints',
    //   name: 'usercomplaints',
    //   component: UserComplaints
    // },
    {
      path: '/myprofile',
      name: 'myprofile',
      component: MyProfile
    },
    {
      path: '/userprofile',
      name: 'userprofile',
      component: UserProfile
    },
    // {
    //   path: '/signup',
    //   name: 'signup',
    //   component: SignUp
    // },
    {
      path: '/login',
      name: 'login',
      component: Login
    },
    {
      path: '/passwordreset',
      name: 'passwordreset',
      component: PasswordReset
    },
    // {
    //   path: '/orders',
    //   name: 'orders',
    //   // route level code-splitting
    //   // this generates a separate chunk (about.[hash].js) for this route
    //   // which is lazy-loaded when the route is visited.
    //   component: () => import(/* webpackChunkName: "about" */ './views/Administrator/Orders.vue')
    // }
  ]
})

// router.beforeEach((to, from, next) => {
//   if (to.matched.some(record => record.meta.requiresAuth)) {
//     if (localStorage.getItem('access_token')==null) {
//       next({name: 'Login'})
//     } else {
//       if (to.matched.some(record => record.meta.adminOnly)) {
//         if (localStorage.getItem('user_role')!='Administrator') {
//           next({name: 'Login'})
//         } else {
//           next()
//         }
//       } else if (to.matched.some(record => record.meta.serviceProviderOnly)) {
//         if (localStorage.getItem('user_role')!='Service Provider') {
//           next({name: 'Login'})
//         } else {
//           next()
//         }
//       } else if (to.matched.some(record => record.meta.customerOnly)) {
//         if (localStorage.getItem('user_role')!='Customer') {
//           next({name: 'Login'})
//         } else {
//           next()
//         }
//       } else {
//         next()
//       }
//     }
//   } else {
//     next() // make sure to always call next()!
//   }
// })

// router.beforeResolve((to, from, next) => {
//   // If this isn't an initial page load.
//   if (to.name) {
//       // Start the route progress bar.
//       NProgress.start()
//   }
//   next()
// })

// eslint-disable-next-line
router.afterEach((to, from) => {
  // Complete the animation of the route progress bar.
  //NProgress.done()
  //next({name: 'Login'})
  
})

export default router;
