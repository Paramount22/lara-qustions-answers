<template>
    <div class="d-flex flex-column vote-controls pr-4">
        <a @click.prevent="voteUp" href="" :title="title('up')"
           class="vote-up"
           :class="classes"
        >
            <i class="fas fa-caret-up fa-3x"></i>
        </a>

        <span class="votes-count"> {{ count }} </span>
        <a @click.prevent="voteDown" href="" :title="title('down')"
           class="vote-down"
           :class="classes"
        >
            <i class="fas fa-caret-down fa-3x"></i>
        </a>

        <favorite v-if="name === 'question'" :question="model" ></favorite>
        <accept v-else :answer="model"></accept>

    </div>
</template>

<script>
    import Favorite from './Favorite';
    import Accept from './Accept';

    export default {
        name: "Vote",
        props: ['name', 'model'],

        components: {
            Favorite, Accept
        },

        data() {
            return {
                count: this.model.votes_count,
                id: this.model.id,

            }
        },

        computed: {
            classes() {
                return this.signedIn ? '' : 'off'
            },

            endpoint() {
                return `/${this.name}s/${this.id}/vote`
            }
        },

        methods: {
            title(voteType) {
                let titles = {
                    up: `This ${this.name} is useful`,
                    down: `This ${this.name} is not useful`
                }
                return titles[voteType]
            },

            voteUp() {
                this._vote(1)
            },

            voteDown() {
                this._vote(-1)
            },

            _vote(vote) {
                if (! this.signedIn) {
                    this.$toast.warning(`Please login to vote ${this.name}`, 'Warning', {
                        timeout: 3000,
                        position: 'bottomLeft'
                    });
                    return;
                }
                axios.post(this.endpoint, {
                    vote: vote
                }).then( response => {
                    this.$toast.success(response.data.message, 'Success', {
                        timeout: 3000,
                        position: 'bottomLeft'
                    });
                    this.count = response.data.votesCount;
                })
            }
        }
    }
</script>

<style scoped>

</style>
