import MixinsEdit from '../../../vendor/nos/crud/mixins/edit.js'

Vue.component('category-edit', {
    data() {
        return {
            link: '/admin/categories',
        }
    },
    mixins: [MixinsEdit]
});
