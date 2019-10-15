export default[
    { path: '', redirect: '/index' },
    { path: '/index', component: require('./pages/App.vue') },
    { path: '/list', component: require('./pages/List.vue') },
    { path: '/detail/:id', component: require('./pages/Detail.vue') }
];