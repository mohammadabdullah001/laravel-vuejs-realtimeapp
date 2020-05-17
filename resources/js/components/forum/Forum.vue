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
        <div class="text-center">
          <v-pagination v-model="meta.current_page" :length="meta.total" @input="changePage"></v-pagination>
        </div>
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
      questions: {},
      meta: {}
    };
  },
  components: {
    questions,
    appSidebar
  },
  created() {
    this.fetchQuestion();
  },
  methods: {
    fetchQuestion(page) {
      let url = page ? `/question?page=${page}` : "/question";
      axios
        .get(url)
        .then(res => {
          this.questions = res.data.data;
          this.meta = res.data.meta;
        })
        .catch(errors => console.log(errors));
    },
    changePage(page) {
      this.fetchQuestion(page);
    }
  }
};
</script>

<style>
</style>