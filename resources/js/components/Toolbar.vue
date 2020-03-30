<template>
  <v-toolbar dense>
    <v-toolbar-title>Bitfume</v-toolbar-title>

    <v-spacer></v-spacer>

    <router-link
      v-for="navlink in navlinks"
      :key="navlink.title"
      :to="navlink.to"
      v-if="navlink.show"
    >
      <v-btn text>{{ navlink.title }}</v-btn>
    </router-link>
  </v-toolbar>
</template>

<script>
export default {
  data() {
    return {
      navlinks: [
        { title: "FORUM", to: "/forum", show: true },
        { title: "ASK QUESTION", to: "/forum", show: User.loggedIn() },
        { title: "CATEGORY", to: "/forum", show: User.loggedIn() },
        { title: "LOGIN", to: "/login", show: !User.loggedIn() },
        { title: "Logout", to: "/logout", show: User.loggedIn() }
      ]
    };
  },
  created() {
    EventBuss.$on("logout", () => {
      User.logout();
    });
  }
};
</script>

<style>
</style>
