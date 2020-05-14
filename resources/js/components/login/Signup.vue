<template>
  <v-container>
    <v-row justify="center">
      <v-col lg="6">
        <v-form @submit.prevent="signup">
          <v-text-field v-model="form.name" type="text" label="Name" required></v-text-field>
          <v-alert text dismissible dense type="error" v-if="errors.name">{{ errors.name[0] }}</v-alert>
          <v-text-field v-model="form.email" type="email" label="E-mail" required></v-text-field>
          <v-alert text dismissible dense type="error" v-if="errors.email">{{ errors.email[0] }}</v-alert>
          <v-text-field v-model="form.password" type="password" label="Password" required></v-text-field>
          <v-alert
            text
            dismissible
            dense
            type="error"
            v-if="errors.password"
          >{{ errors.password[0] }}</v-alert>
          <v-text-field
            v-model="form.password_confirmation"
            type="password"
            label="Password Confirm"
            required
          ></v-text-field>

          <v-btn type="submit" color="green">Sign Up</v-btn>
          <router-link to="/login">
            <v-btn color="blue">Login</v-btn>
          </router-link>
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
        name: null,
        email: null,
        password: null,
        password_confirmation: null
      },
      errors: {}
    };
  },
  created() {
    if (User.loggedIn()) {
      this.$router.push({ name: "forum" });
    }
  },
  methods: {
    signup() {
      axios
        .post("/auth/signup", this.form)
        .then(res => {
          User.responseAfterLogin(res);
        })
        .catch(errors => {
          this.errors = errors.response.data.errors;
        });
    }
  }
};
</script>
