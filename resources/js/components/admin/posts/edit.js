import MixinsEdit from '../../../vendor/nos/crud/mixins/edit.js'

Vue.component('post-edit', {
    data() {
        return {
            link: '/admin/posts',
        }
    },
    mixins: [MixinsEdit]
});
