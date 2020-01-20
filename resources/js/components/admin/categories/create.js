import MixinsCreate from '../../../vendor/codersstudio/crud/mixins/create.js'

Vue.component('category-create', {
    data() {
        return {
            link: '/admin/categories',
        }
    },
    mixins: [MixinsCreate]
});
