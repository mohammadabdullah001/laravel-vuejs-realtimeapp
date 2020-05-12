<template>
  <v-container fluid>
    <v-row>
      <v-col cols="8">
        <questions
          v-for="question in questions"
          :key="question.id"
          :question="question"
          class="mb-2"
        ></questions>
      </v-col>
      <v-col cols="4">
        <h1>sidebar</h1>
      </v-col>
    </v-row>
  </v-container>
</template>

<script>
import questions from "./Questions.vue";
export default {
  data() {
    return {
      questions: {}
    };
  },
  components: {
    questions
  },
  created() {
    axios
      .get("api/question")
      .then(res => (this.questions = res.data.data))
      .catch(errors => console.log(errors));
  }
};
</script>

<style>
</style>