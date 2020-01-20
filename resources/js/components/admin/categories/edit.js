import MixinsEdit from '../../../vendor/codersstudio/crud/mixins/edit.js'

Vue.component('category-edit', {
    data() {
        return {
            link: '/admin/categories',
        }
    },
    mixins: [MixinsEdit]
});
