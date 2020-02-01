import MixinsCreate from '../../../vendor/codersstudio/crud/mixins/create.js'

Vue.component('comment-create', {
    data() {
        return {
            link: '/admin/comments',
        }
    },
    mixins: [MixinsCreate]
});
