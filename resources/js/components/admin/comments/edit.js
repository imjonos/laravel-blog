import MixinsEdit from '../../../vendor/nos/crud/mixins/edit.js'

Vue.component('comment-edit', {
    data() {
        return {
            link: '/admin/comments',
        }
    },
    mixins: [MixinsEdit]
});
