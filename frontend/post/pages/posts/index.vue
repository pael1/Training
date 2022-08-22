<template>
  <div>
    <Header :title="title"/>
    <br>
    <br>
    <form @submit.prevent="post_data" id="form">
      <input v-model="form.post" type="text" name="post" placeholder="Enter post" required />
      <input v-model="form.description" type="description" name="description" placeholder="Enter description" required />
      <button type="submit">Save Post</button>
    </form>
    <Post v-for="post in posts" :key="post.id" :id="post.id" :post="post.post"/>
  </div>
</template>

<script>
import axios from "axios";
import Post from "../../components/post";
import Header from "../../components/Header.vue";

export default {
  components: {
    Post,
    Header
  },
  data() {
    return {
      title: "Posts",
      posts: [],
      form: {
          post: "",
          description: "",
        }
    };
  },
  async fetch() {
    const config = {
      headers: {
        Accept: "application/json"
      }
    };

    try {
      const res = await axios.get("http://127.0.0.1:8000/api/posts", config);
        // console.log(res);
      this.posts = res.data;
    } catch (err) {
      console.log(err);
    }
  },
  methods: {
    post_data: async function() {
        const formData = new FormData();

        for (let [key, value] of Object.entries(this.form)) {
          formData.append(key, value);
        }

        await axios
          .post("http://127.0.0.1:8000/api/posts/", formData)
          .then(({ data }) => {
            alert(data.message);
            this.form = "";
            this.$nuxt.refresh();
          })
          .catch((e) => {
            console.log(e);
          });
    }
  },
  head() {
    return {
      title: "Post App"
    };
  }
};
</script>

<style>
#form{
  background-color: black;
  padding: 4px;
  margin-bottom: 10px;
}
#form button{
  color: white;
}
</style>