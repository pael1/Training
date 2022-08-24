<template>
  <div class="p-5">
    <nuxt-link to="/posts"
      ><svg
        xmlns="http://www.w3.org/2000/svg"
        fill="none"
        viewBox="0 0 24 24"
        stroke-width="1.5"
        stroke="currentColor"
        class="w-6 h-6"
      >
        <path
          stroke-linecap="round"
          stroke-linejoin="round"
          d="M9 15L3 9m0 0l6-6M3 9h12a6 6 0 010 12h-3"
        />
      </svg>
    </nuxt-link>

    <!-- <form id="form">
      <input v-model="post.post" type="text" name="post" required />
      <input
        v-model="post.description"
        type="description"
        name="description"
        required
      />
      <button type="submit">Update</button>
    </form> -->
    <form @submit.prevent="update_data" class="p-8">
      <div class="form-group mb-6">
        <input
          type="text"
          class="
            form-control
            block
            w-full
            px-3
            py-1.5
            text-base
            font-normal
            text-gray-700
            bg-white bg-clip-padding
            border border-solid border-gray-300
            rounded
            transition
            ease-in-out
            m-0
            focus:text-gray-700
            focus:bg-white
            focus:border-blue-600
            focus:outline-none
          "
          v-model="post.post"
          id="exampleInput7"
          name="post"
          placeholder="Title"
        />
      </div>
      <div class="form-group mb-6">
        <textarea
          class="
            form-control
            block
            w-full
            px-3
            py-1.5
            text-base
            font-normal
            text-gray-700
            bg-white bg-clip-padding
            border border-solid border-gray-300
            rounded
            transition
            ease-in-out
            m-0
            focus:text-gray-700
            focus:bg-white
            focus:border-blue-600
            focus:outline-none
          "
          v-model="post.description"
          name="description"
          id="exampleFormControlTextarea13"
          rows="5"
          placeholder="Message"
        ></textarea>
      </div>
      <div class="text-center">
        <button
          type="submit"
          class="
            px-6
            py-2.5
            bg-blue-600
            text-white
            font-medium
            text-xs
            leading-tight
            uppercase
            rounded
            shadow-md
            hover:bg-blue-700 hover:shadow-lg
            focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0
            active:bg-blue-800 active:shadow-lg
            transition
            duration-150
            ease-in-out
          "
        >
          Update Post
        </button>
      </div>
    </form>
    <notifications group="foo" position="bottom right" />
  </div>
</template>

<script>
export default {
  layout: "customize",
  data() {
    return {
      post: {},
      post: {
        post: "",
        description: "",
      },
    };
  },
  async created() {
    const config = {
      headers: {
        Accept: "application/json",
      },
    };

    try {
      const res = await this.$axios.get(
        `/posts/${this.$route.params.id}`,
        config
      );
      this.post = res.data;
    } catch (err) {
      console.log(err);
    }
  },
  methods: {
    update_data: async function () {
      await this.$axios
        .put(`/posts/${this.post.id}`, {
          post: this.post.post,
          description: this.post.description,
        })
        .then(({ data }) => {
          this.$notify({
            group: "foo",
            // title: "This is the <em>title</em>",
            text: "<b>" + data.message + "</b>",
            type: "success",
          });
          this.$nuxt.refresh();
        })
        .catch((e) => {
          console.log(e);
        });
    },
  },
  head() {
    return {
      title: this.post.post,
    };
  },
};
</script>

<style>
</style>