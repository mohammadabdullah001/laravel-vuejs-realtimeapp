<template>
  <div>
    <editQuestion v-if="editting" :question="question"></editQuestion>
    <div v-else>
      <SingleQuestion v-if="question" :question="question" class="mt-2 mb-2"></SingleQuestion>
    </div>
  </div>
</template>

<script>
import SingleQuestion from "./SingleQuestion";
import editQuestion from "./editQuestion";
export default {
  data: () => {
    return {
      question: null,
      editting: false
    };
  },
  components: {
    SingleQuestion,
    editQuestion
  },
  created() {
    this.listen();
    this.getQuestions();
  },
  methods: {
    listen() {
      EventBuss.$on("starteditting", () => {
        this.editting = true;
      });
      EventBuss.$on("canceleditting", () => {
        this.editting = false;
      });
    },
    getQuestions() {
      axios
        .get(`/api/question/${this.$route.params.slug}`)
        .then(res => (this.question = res.data.data))
        .catch(errors => console.log(errors));
    }
  }
};
</script>

<style>
</style>