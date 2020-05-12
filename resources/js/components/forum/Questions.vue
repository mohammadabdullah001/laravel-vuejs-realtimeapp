<template>
  <v-card>
    <v-card-title>
      <router-link :to="question.path">{{ question.title }}</router-link>
    </v-card-title>
    <v-card-subtitle class="grey--text">{{ question.user }} by {{ question.created_at }}</v-card-subtitle>
    <v-card-text>{{ question.body }}</v-card-text>
  </v-card>
</template>

<script>
export default {
  props: ["question"]
};
</script>

<style>
</style>