<template>
    <div class="container">
        <div class="row">
            <div class="col-xl-1 col-md-3 col-3 ml-0 pl-0">
                <div class="btn-group dropup">
                    <button aria-expanded="false" class="btn btn-outline-secondary dropdown-toggle"
                            data-bs-toggle="dropdown"
                            type="button">
                        <span class="fa fa-smile"></span>
                    </button>
                    <ul class="dropdown-menu">
                        <span v-for="emoji in emojis"
                              class="mr-2 h6 emoji-item"
                              @click="sendReaction(emoji.id)"
                              v-html="'&#x' + emoji.code + ';'"></span>
                    </ul>
                </div>
            </div>
            <div class="col-xl-11 col-md-9 col-9">
                <div class="emoji-statistic pt-1">
                <span v-for="statistic in statistics" class="ml-2 h6">
                    <span class="badge badge-light">{{ statistic.count }}</span>
                    <span v-html="'&#x' + statistic.code + ';'"></span>
                </span>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: 'EmojiReaction',
    data() {
        return {
            statistics: []
        };
    },
    props: {
        defaultStatistics: {
            type: Array
        },
        emojis: {
            type: Array
        },
        postId: {
            type: Number
        }
    },
    methods: {
        getStatistic(id) {
            axios.get('/posts/' + this.postId + '/emoji-reactions').then(response => {
                this.statistics = response.data;
            });
        },
        sendReaction(id) {
            axios.post('/posts/' + this.postId + '/emoji-reactions', {
                emoji_id: id
            }).finally(() => {
                this.getStatistic();
            });
        }
    },
    mounted() {
        this.statistics = this.defaultStatistics;
    }
}
</script>

<style>
.emoji-statistic, .emoji-item {
    cursor: pointer;
}

.h6 {
    font-size: 20px;
}
</style>
