import MixinsIndex from '../../../vendor/codersstudio/crud/mixins/index.js'

Vue.component('comment-index', {
    data() {
        return {
            link: '/admin/comments',
        }
    },
    mixins: [MixinsIndex]
});
