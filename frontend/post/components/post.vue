<template>
  
    <div class="table">
      <p>{{ post }}</p>
      <div class="actions">
        <nuxt-link :to="'posts/' + id">Edit</nuxt-link>
        <button v-on:click="deletePost(id)">Delete</button>
      </div>
    </div>
</template>

<script>
export default {
  name: "Post",
  props: ["post", "id"],

  methods: {
    async deletePost(id) {
      const config = {
        headers: {
          Accept: "application/json"
        }
      };

      try {
        await this.$axios.delete(`/posts/${id}`,config);
          alert("deleted successfully");
          this.$nuxt.refresh()
        } catch (err) {
          console.log(err);
        }
    }
  },

};
</script>

<style>
.table {
  display: flex;
  justify-content: space-between;
}
.actions{
  display: flex;
  gap: 5px;
}
</style>