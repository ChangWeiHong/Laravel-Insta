import './bootstrap';

import { createApp } from 'vue';
import FollowButton from './components/FollowButton.vue';

createApp({})
    .component('follow-button', FollowButton)
    .mount('#app');
