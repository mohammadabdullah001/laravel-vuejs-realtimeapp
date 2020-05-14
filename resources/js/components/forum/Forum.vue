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
        <appSidebar></appSidebar>
      </v-col>
    </v-row>
  </v-container>
</template>

<script>
import questions from "./Questions.vue";
import appSidebar from "./appSidebar.vue";
export default {
  data() {
    return {
      questions: {}
    };
  },
  components: {
    questions,
    appSidebar
  },
  created() {
    axios
      .get("/question")
      .then(res => (this.questions = res.data.data))
      .catch(errors => console.log(errors));
  }
};
</script>

<style>
</style>