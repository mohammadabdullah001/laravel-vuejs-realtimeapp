<template>
  <v-toolbar dense>
    <v-toolbar-title>Bitfume</v-toolbar-title>

    <v-spacer></v-spacer>
    <div v-for="navlink in navlinks" :key="navlink.title">
      <router-link :to="navlink.to" v-if="navlink.show">
        <v-btn text>{{ navlink.title }}</v-btn>
      </router-link>
    </div>
  </v-toolbar>
</template>

<script>
export default {
  data() {
    return {
      navlinks: [
        { title: "FORUM", to: "/forum", show: true },
        { title: "ASK QUESTION", to: "/ask", show: User.loggedIn() },
        { title: "CATEGORY", to: "/category", show: User.admin() },
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

<style scoped>
a {
  text-decoration: none;
}
</style>
