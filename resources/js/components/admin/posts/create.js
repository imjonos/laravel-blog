import MixinsCreate from '../../../vendor/nos/crud/mixins/create.js'

Vue.component('post-create', {
    data() {
        return {
            link: '/admin/posts',
        }
    },
    mixins: [MixinsCreate]
});
