<template>
  <div>
    <v-container>
      <v-row justify="center">
        <v-col lg="6">
          <v-card class="pa-5">
            <v-form @submit.prevent="create">
              <v-text-field v-model="form.title" type="text" label="Title" required></v-text-field>

              <v-select
                v-model="form.category_id"
                :items="category"
                item-text="name"
                item-value="id"
                label="Category"
              ></v-select>
              <vue-simplemde v-model="form.body" />
              <v-btn type="submit" color="green">Create</v-btn>
            </v-form>
          </v-card>
        </v-col>
      </v-row>
    </v-container>
  </div>
</template>

<script>
export default {
  data: () => {
    return {
      form: {
        title: null,
        category_id: null,
        body: null
      },
      category: []
    };
  },
  created() {
    axios
      .get("/api/category")
      .then(res => (this.category = res.data.data))
      .catch(errors => console.log(errors));
  },
  methods: {
    create() {
      axios
        .post("/api/question", this.form)
        .then(res => this.$router.push(res.data.path))
        .catch(errors => console.log(errors));
    }
  }
};
</script>

<style>
</style>