<template>
    <div class="row justify-content-center" v-cloak v-if="count">
        <div class="col-md-10">
            <div class="card mt-4">
                <div class="card-body">
                    <div class="card-title">
                        <h2>
                            {{title }}
                        </h2>
                    </div>
                    <hr>
                    <answer v-for="answer in answers" :answer="answer" :key="answer.id"></answer>

                    <div class="text-center mt-3" v-if="nextUrl">
                        <button @click="fetch(nextUrl)" class="btn btn-outline-secondary">More</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import Answer from './Answer';
    export default {
        name: "Answers",
        components: {
            Answer
        },
        props: ['question'],

        data() {
            return {
                questionId: this.question.id,
                count: this.question.answers_count,
                answers: [],
                nextUrl: null
            }
        },

        created() {
            this.fetch(`/questions/${this.questionId}/answers`)
        },

        methods: {
            fetch(endpoint) {
                axios.get(endpoint)
                    .then(res => {
                        this.answers.push(...res.data.data) // ... spread operator
                        this.nextUrl =  res.data.next_page_url
                    })
            }
        },

        computed: {
            title() {
                return this.count + ' ' + (this.count > 1 ? 'Answers' : 'Answer')
            }
        }
    }
</script>

<style scoped>

</style>
