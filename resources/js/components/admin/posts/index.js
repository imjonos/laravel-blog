import MixinsIndex from '../../../vendor/nos/crud/mixins/index.js'

Vue.component('post-index', {
    data() {
        return {
            link: '/admin/posts',
        }
    },
    mixins: [MixinsIndex]
});
