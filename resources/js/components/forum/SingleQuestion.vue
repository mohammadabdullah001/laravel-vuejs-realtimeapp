<template>
  <div>
    <v-card>
      <v-card-title>
        {{ question.title }}
        <v-spacer></v-spacer>
        <v-btn color="success">5 Replaye</v-btn>
      </v-card-title>
      <v-card-subtitle class="grey--text">{{ question.user }} by {{ question.created_at }}</v-card-subtitle>
      <v-card-text v-html="body"></v-card-text>
      <v-card-actions v-if="own">
        <v-btn small icon>
          <v-icon color="orange" @click.prevent="edit">mdi-pencil</v-icon>
        </v-btn>
        <v-btn small icon @click.prevent="destroy">
          <v-icon color="red">mdi-delete</v-icon>
        </v-btn>
      </v-card-actions>
    </v-card>
  </div>
</template>

<script>
export default {
  props: ["question"],
  data() {
    return {
      own: User.own(this.question.user_id)
    };
  },
  computed: {
    body() {
      return md.parse(this.question.body);
    }
  },
  methods: {
    destroy() {
      axios
        .delete(`/api/question/${this.question.slug}`)
        .then(res => this.$router.push("/forum"))
        .catch(errors => console.log(errors));
    },
    edit() {
      EventBuss.$emit("starteditting");
    }
  }
};
</script>

<style>
</style>