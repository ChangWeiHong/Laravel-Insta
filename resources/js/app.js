import './bootstrap';

import { createApp } from 'vue';
import FollowButton from './components/FollowButton.vue';

document.querySelectorAll('[data-follow-button]').forEach((element) => {
    createApp(FollowButton, {
        userId: element.dataset.userId,
        follows: element.dataset.follows === 'true',
    }).mount(element);
});
