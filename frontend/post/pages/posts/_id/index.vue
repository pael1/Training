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
import axios from "axios";

export default {
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
      const res = await axios.get(
        `http://127.0.0.1:8000/api/posts/${this.$route.params.id}`,
        config
      );

      this.post = res.data;
    } catch (err) {
      console.log(err);
    }
  },
  methods: {
    post_data: async function() {
        await axios
          .put(`http://127.0.0.1:8000/api/posts/${this.post.id}`, {
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