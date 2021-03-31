<template>

</template>

<script>
    export default {
        name: "Answer",
        props: ['answer'],

        data() {
            return {
                editing: false,
                body: this.answer.body,
                bodyHtml: this.answer.body_html,
                id: this.answer.id,
                questionId: this.answer.question_id,
                beforeEditCahe: '',
                //ednpoint: `/questions/${this.questionId}/answers/${this.id}`
            }
        },

         methods: {
            edit() {
                this.beforeEditCahe = this.body;
                this.editing = true;
            },
             cancel() {
                this.body = this.beforeEditCahe;
                 this.editing = false;
             },
            update() {
                axios.patch(`/questions/${this.questionId}/answers/${this.id}`, {
                    body: this.body
                }).then(response => {
                    //console.log(response);
                    this.editing = false;
                    this.bodyHtml = response.data.body_html;
                    this.$toast.success(response.data.message, 'Sucess', {timeout: 3000});
                }).catch(error => {
                    //console.log(error.response);
                    this.$toast.error(error.response.data.message, 'Error', {timeout: 3000})
                });
                this.editing = false;
            },

             destroy() {
                 this.$toast.question('Are you sure about that?', 'Confirm',{
                     timeout: 20000,
                     close: false,
                     overlay: true,
                     displayMode: 'once',
                     id: 'question',
                     zindex: 999,
                     title: 'Hey',
                     position: 'center',
                     buttons: [
                         ['<button><b>YES</b></button>', (instance, toast) => {

                               axios.delete(`/questions/${this.questionId}/answers/${this.id}`)
                                 .then(response => {
                                     $(this.$el).fadeOut(500, () => {
                                         this.$toast.success(response.data.message, 'Sucess', {timeout: 3000});
                                     })
                                 });

                             instance.hide({ transitionOut: 'fadeOut' }, toast, 'button');

                         }, true],
                         ['<button>NO</button>', function (instance, toast) {

                             instance.hide({ transitionOut: 'fadeOut' }, toast, 'button');

                         }],
                     ],

                 });

             }
        },

        computed: {
            isInvalid() {
                return this.body.length < 10
            },

            endpoint() {
                return `/questions/${this.questionId}/answers/${this.id}`;
            }
        }
    }
</script>

<style scoped>

</style>
