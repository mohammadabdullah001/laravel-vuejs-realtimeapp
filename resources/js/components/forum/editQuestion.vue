<template>
  <v-container>
    <v-row justify="center">
      <v-col lg="6">
        <v-card class="pa-5">
          <v-form @submit.prevent="update">
            <v-text-field v-model="form.title" type="text" label="Title" required></v-text-field>
            <vue-simplemde v-model="form.body" />
            <v-card-actions>
              <v-btn type="submit" color="red" dark @click="cancel">Cancel</v-btn>
              <v-btn type="submit" color="green" dark>Save</v-btn>
            </v-card-actions>
          </v-form>
        </v-card>
      </v-col>
    </v-row>
  </v-container>
</template>

<script>
export default {
  props: ["question"],
  data() {
    return {
      form: {
        title: null,
        body: null
      }
    };
  },
  mounted() {
    this.form = this.question;
  },
  methods: {
    cancel() {
      EventBuss.$emit("canceleditting");
    },
    update() {
      axios
        .patch(`/question/${this.question.slug}`, this.form)
        .then(res => this.cancel())
        .catch(errors => console.log(errors));
    }
  }
};
</script>

<style>
</style>