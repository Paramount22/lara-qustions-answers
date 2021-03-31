<template>
    <div>
        <div class="col-md-4">
            <div class="media mt-4 d-flex">
                <a :href="user.url" class="pr-2">
                    <img :src="user.avatar" alt="">
                </a>
                <div class="media-body pt-1">
                    <a :href="user.url">{{user.name}}</a>
                </div>
            </div>
        </div>

        <div class="">
            <time :datetime="postDateForPc"
                  class="text-muted d-block mt-4 time">
                <small>
                    {{ postDate }}
                </small>
            </time>
        </div>
    </div>
</template>

<script>
    export default {
        name: "UserInfo",
        props: ['model', 'label'],

        data() {
            return {
                user: this.model.user
            }
        },

        computed: {
            postDate() {
                return this.label + " " + this.model.created_date;
            },

            postDateForPc() {
                return this.label + " " + this.model.created_date_for_pc;
    }
        }

    }
</script>

<style scoped>

</style>
