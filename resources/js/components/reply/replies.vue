<template>
  <v-container>
    <v-row>
      <v-col>
        <reply
          v-if="question"
          v-for="(reply,index) in content"
          :key="reply.id"
          :index="index"
          :data="reply"
        ></reply>
      </v-col>
    </v-row>
  </v-container>
</template>

<script>
import reply from "./reply.vue";
export default {
  props: ["question"],
  components: {
    reply
  },
  data() {
    return {
      content: this.question.replies
    };
  },
  created() {
    this.listen();
  },
  methods: {
    listen() {
      EventBuss.$on("newReply", reply => {
        this.content.unshift(reply);
      });

      EventBuss.$on("deleteReply", index => {
        axios
          .delete(
            `question/${this.question.slug}/reply/${this.content[index].id}`
          )
          .then(res => this.content.splice(index, 1))
          .catch(errors => console.log(errors));
      });

      Echo.private("App.User." + User.id()).notification(notification => {
        this.content.unshift(notification.reply);
      });

      Echo.channel("deleteReplyChannel").listen("DeleteReplyEvent", e => {
        for (let index = 0; index < this.content.length; index++) {
          if (this.content[index].id == e.id) {
            this.content.splice(index, 1);
          }
        }
      });
    }
  }
};
</script>

<style>
</style>