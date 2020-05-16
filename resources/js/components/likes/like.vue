<template>
  <v-btn icon @click.prevent="likeit">
    <v-icon :color="color">mdi-thumb-up</v-icon>
    {{ count }}
  </v-btn>
</template>

<script>
export default {
  props: ["counts"],
  data() {
    return {
      liked: this.counts.liked,
      count: this.counts.likes_count
    };
  },
  created() {
    Echo.channel("LikeChannel").listen("LikeEvent", e => {
      if (this.counts.id == e.id) {
        e.type == 1 ? this.count++ : this.count--;
      }
    });
  },
  computed: {
    color() {
      return this.liked ? "red" : "red lighten-4";
    }
  },
  methods: {
    likeit() {
      if (User.loggedIn()) {
        this.liked ? this.decr() : this.incr();
        this.liked = !this.liked;
      }
    },
    incr() {
      axios
        .post(`like/${this.counts.id}`)
        .then(res => this.count++)
        .catch(errors => console.log(errors));
    },
    decr() {
      axios
        .delete(`like/${this.counts.id}`)
        .then(res => this.count--)
        .catch(errors => console.log(errors));
    }
  }
};
</script>

<style>
</style>