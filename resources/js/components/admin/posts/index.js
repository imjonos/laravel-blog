import MixinsIndex from '../../../vendor/nos/crud/mixins/index.js'

Vue.component('post-index', {
    data() {
        return {
            link: '/admin/posts',
        }
    },
    mixins: [MixinsIndex],
    methods: {
        publish(id) {
            axios.post('/admin/posts/' + id + '/publish').then(response => {
                this.systemMessage('success', {
                    'title': this.trans('crud.actions.info'),
                    'text': this.trans('crud.actions.success.publish')
                });
            }).catch(reason => {
                this.systemMessage('error', {
                    'title': this.trans('crud.actions.warning'),
                    'text': this.trans('crud.actions.fail.publish')
                });
            })
        }
    }
});
