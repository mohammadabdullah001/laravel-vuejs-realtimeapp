<template>
  <v-card class="mt-1">
    <v-card-title>
      <div class="headline">{{data.user}}</div>
      <div class="ml-2">said {{data.created_at}}</div>
    </v-card-title>
    <v-divider></v-divider>
    <template v-if="edittingReply">
      <editReply :reply="data"></editReply>
    </template>
    <template v-else>
      <v-card-text v-html="reply"></v-card-text>
      <v-divider></v-divider>
      <v-card-actions v-if="own">
        <v-btn small icon>
          <v-icon color="orange" @click.prevent="edit">mdi-pencil</v-icon>
        </v-btn>
        <v-btn small icon @click.prevent="destroy">
          <v-icon color="red">mdi-delete</v-icon>
        </v-btn>
      </v-card-actions>
    </template>
  </v-card>
</template>

<script>
import editReply from "./editReply.vue";
export default {
  props: ["data", "index"],
  components: {
    editReply
  },
  data() {
    return {
      edittingReply: false
    };
  },
  created() {
    this.listen();
  },
  computed: {
    own() {
      return User.own(this.data.user_id);
    },
    reply() {
      return md.parse(this.data.reply);
    }
  },
  methods: {
    destroy() {
      EventBuss.$emit("deleteReply", this.index);
    },
    edit() {
      this.edittingReply = true;
      EventBuss.$emit("edittingReply", this.index);
    },
    listen() {
      EventBuss.$on("cancelReply", () => {
        this.edittingReply = false;
      });
    }
  }
};
</script>

<style>
</style>