import MixinsCreate from '../../../vendor/nos/crud/mixins/create.js'

Vue.component('comment-create', {
    data() {
        return {
            link: '/admin/comments',
        }
    },
    mixins: [MixinsCreate]
});
