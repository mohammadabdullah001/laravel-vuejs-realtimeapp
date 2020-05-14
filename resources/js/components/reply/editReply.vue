<template>
  <v-card class="pa-5">
    <v-form>
      <vue-simplemde v-model="reply.reply" />
      <v-card-actions>
        <v-btn type="submit" color="red" dark @click.prevent="cancel">Cancel</v-btn>
        <v-btn type="submit" color="green" dark @click.prevent="edit">Save</v-btn>
      </v-card-actions>
    </v-form>
  </v-card>
</template>

<script>
export default {
  props: ["reply"],

  methods: {
    cancel() {
      EventBuss.$emit("cancelReply");
    },
    edit() {
      axios
        .patch(`/question/${this.reply.question_slug}/reply/${this.reply.id}`, {
          body: this.reply.reply
        })
        .then(res => {
          this.cancel();
        })
        .catch(errors => console.log(errors));
    }
  }
};
</script>

<style>
</style>