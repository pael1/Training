<template>
  <div>
    <nuxt-link to="/posts">Back To Post</nuxt-link>

    <form @submit.prevent="post_data" id="form">
      <input v-model="post.post" type="text" name="post" required />
      <input v-model="post.description" type="description" name="description" required />
      <button type="submit">Update</button>
    </form>
  </div>
</template>

<script>
export default {
  layout: 'customize',
  data() {
    return {
      post: {},
      post: {
          post: "",
          description: "",
        }
    };
  },
  async created() {
    const config = {
      headers: {
        Accept: "application/json"
      }
    };

    try {
      const res = await this.$axios.get(`/posts/${this.$route.params.id}`,config);
      this.post = res.data;
    } catch (err) {
      console.log(err);
    }
  },
  methods: {
    post_data: async function() {
        await this.$axios
          .put(`/posts/${this.post.id}`, {
            post: this.post.post,
            description: this.post.description
          })
          .then(({ data }) => {
            alert(data.message);
            this.$nuxt.refresh();
          })
          .catch((e) => {
            console.log(e);
          });
    }
  },
  head() {
    return {
      title: this.post.post,
    };
  }
};
</script>

<style>
</style>