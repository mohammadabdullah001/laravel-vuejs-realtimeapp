<template>
  <v-container>
    <v-row justify="center">
      <v-col lg="6">
        <v-form @submit.prevent="login">
          <v-text-field v-model="form.email" type="email" label="E-mail" required></v-text-field>

          <v-text-field v-model="form.password" type="password" label="Password" required></v-text-field>

          <v-btn type="submit" color="green">submit</v-btn>
        </v-form>
      </v-col>
    </v-row>
  </v-container>
</template>
<script>
export default {
  data() {
    return {
      form: {
        email: null,
        password: null
      }
    };
  },
  methods: {
    login() {
      User.login(this.form);
    }
  }
};
</script>
