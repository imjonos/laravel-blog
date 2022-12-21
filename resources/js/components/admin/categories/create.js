import MixinsCreate from '../../../vendor/nos/crud/mixins/create.js'

Vue.component('category-create', {
    data() {
        return {
            link: '/admin/categories',
        }
    },
    mixins: [MixinsCreate]
});
