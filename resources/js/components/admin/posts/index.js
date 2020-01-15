import MixinsIndex from '../../../vendor/codersstudio/crud/mixins/index.js'

Vue.component('post-index', {
    data() {
        return {
            link: '/admin/posts',
        }
    },
    mixins: [MixinsIndex]
});
