<template>
  <v-menu offset-y>
    <template v-slot:activator="{ on }">
      <v-btn icon small v-on="on">
        <v-icon :color="color" small>mdi-bell</v-icon>
        {{ unreadCount }}
      </v-btn>
    </template>

    <v-list>
      <v-toolbar>
        <v-toolbar-title>Read Message</v-toolbar-title>
      </v-toolbar>
      <v-list-item v-for="read in reads" :key="read.id">
        <router-link :to="read.path">
          <v-list-item-title>{{ read.question }}</v-list-item-title>
        </router-link>
      </v-list-item>
    </v-list>
    <v-divider></v-divider>

    <v-list>
      <v-toolbar>
        <v-toolbar-title>UnRead Message</v-toolbar-title>
      </v-toolbar>
      <v-list-item v-for="unread in unreads" :key="unread.id">
        <router-link :to="unread.path">
          <v-list-item-title @click="read(unread)">{{ unread.question }}</v-list-item-title>
        </router-link>
      </v-list-item>
    </v-list>
  </v-menu>
</template>

<script>
export default {
  data() {
    return {
      reads: {},
      unreads: {},
      unreadCount: 0
    };
  },
  created() {
    if (User.loggedIn) {
      this.getNotification();
    }
    Echo.private("App.User." + User.id()).notification(notification => {
      this.unreads.unshift(notification);
      this.unreadCount++;
    });
  },
  computed: {
    color() {
      return this.unreadCount > 0 ? "red" : "red lighten-4";
    }
  },
  methods: {
    getNotification() {
      axios
        .post("notifications")
        .then(res => {
          this.reads = res.data.read;
          this.unreads = res.data.unread;
          this.unreadCount = res.data.unread.length;
        })
        .catch(errors => console.log(errors));
    },
    read(unread) {
      axios
        .post("markasread", { id: unread.id })
        .then(res => {
          this.unreads.splice(unread, 1);
          this.reads.push(unread);
          this.unreadCount--;
        })
        .catch(errors => console.log(errors));
    }
  }
};
</script>

<style>
</style>