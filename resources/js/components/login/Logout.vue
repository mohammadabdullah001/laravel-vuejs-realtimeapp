
<script>
export default {
  created() {
    EventBuss.$emit("logout");
  }
};
</script>

<style>
</style>