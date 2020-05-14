<template>
  <v-container>
    <v-row justify="center">
      <v-col lg="8">
        <v-card class="pa-4">
          <v-form @submit.prevent="submit">
            <v-text-field v-model="form.name" label="Category Name"></v-text-field>
            <v-card-actions>
              <v-btn type="submit" color="indigo" dark v-if="editslug">Update</v-btn>
              <v-btn type="submit" color="green" dark v-else>Create</v-btn>
            </v-card-actions>
          </v-form>
        </v-card>
      </v-col>
      <v-col lg="8" class="mt-3">
        <v-card>
          <v-toolbar color="indigo" dark>
            <v-toolbar-title>Categories</v-toolbar-title>
          </v-toolbar>

          <v-list dense class="py-0">
            <template v-for="(category,i) in categories">
              <v-list-item :key="category.id">
                <v-list-item-action>
                  <v-btn small icon>
                    <v-icon color="orange" @click.prevent="edit(i,category)">mdi-pencil</v-icon>
                  </v-btn>
                </v-list-item-action>

                <v-list-item-content>
                  <v-list-item-title>{{ category.name }}</v-list-item-title>
                </v-list-item-content>
                <v-list-item-action>
                  <v-btn small icon @click.prevent="destroy(i,category.slug)">
                    <v-icon color="red">mdi-delete</v-icon>
                  </v-btn>
                </v-list-item-action>
              </v-list-item>
              <v-divider></v-divider>
            </template>
          </v-list>
        </v-card>
      </v-col>
    </v-row>
  </v-container>
</template>

<script>
export default {
  data() {
    return {
      form: {
        name: null
      },
      categories: [],
      editslug: null
    };
  },
  created() {
    if (!User.admin()) {
      this.$router.push("forum");
    }
    axios
      .get("category")
      .then(res => (this.categories = res.data.data))
      .catch(errors => console.log(errors));
  },
  methods: {
    submit() {
      this.editslug ? this.update() : this.create();
    },
    create() {
      axios
        .post("category", this.form)
        .then(res => {
          this.categories.unshift(res.data);
          this.form.name = null;
        })
        .catch(error => {
          console.log(error);
        });
    },
    update() {
      axios
        .patch(`category/${this.editslug}`, this.form)
        .then(res => {
          this.categories.unshift(res.data);
          this.form.name = null;
        })
        .catch(error => {
          console.log(error);
        });
    },
    destroy(i, slug) {
      axios
        .delete(`category/${slug}`)
        .then(res => this.categories.splice(i, 1))
        .catch(errors => console.log(errors));
    },
    edit(i, category) {
      this.categories.splice(i, 1);
      this.editslug = category.slug;
      this.form.name = category.name;
    }
  }
};
</script>

<style>
</style>