import MixinsIndex from '../../../vendor/codersstudio/crud/mixins/index.js'

Vue.component('category-index', {
    data() {
        return {
            link: '/admin/categories',
        }
    },
    mixins: [MixinsIndex]
});
