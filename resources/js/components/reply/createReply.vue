<template>
  <v-container>
    <v-row justify="center">
      <v-col lg="8">
        <v-card class="pa-5">
          <v-form @submit.prevent="submit">
            <vue-simplemde v-model="body" />
            <v-btn type="submit" color="green" dark>Create Reply</v-btn>
          </v-form>
        </v-card>
      </v-col>
    </v-row>
  </v-container>
</template>

<script>
export default {
  props: ["questionSlug"],
  data() {
    return {
      body: null
    };
  },
  methods: {
    submit() {
      axios
        .post(`/question/${this.questionSlug}/reply`, {
          body: this.body
        })
        .then(res => {
          console.log(res.data);

          this.body = "";
          EventBuss.$emit("newReply", res.data);
          window.scrollTo(0, 0);
        })
        .catch(errors => console.log(errors));
    }
  }
};
</script>

<style>
</style>