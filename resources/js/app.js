require('./bootstrap');

Vue.component('notifications-view', require('./pages/Notifications.vue').default);
Vue.component('thread-view', require('./pages/Thread.vue').default);
Vue.component('threads-view', require('./pages/Threads.vue').default);
Vue.component('profile-view', require('./pages/Profile.vue').default);

const app = new Vue({
    el: '#app'
});
