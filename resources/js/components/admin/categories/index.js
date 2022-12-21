import MixinsIndex from '../../../vendor/nos/crud/mixins/index.js'

Vue.component('category-index', {
    data() {
        return {
            link: '/admin/categories',
        }
    },
    mixins: [MixinsIndex]
});
