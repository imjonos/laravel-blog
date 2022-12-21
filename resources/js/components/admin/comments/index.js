import MixinsIndex from '../../../vendor/nos/crud/mixins/index.js'

Vue.component('comment-index', {
    data() {
        return {
            link: '/admin/comments',
        }
    },
    mixins: [MixinsIndex]
});
