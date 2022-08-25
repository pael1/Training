<template>
  <div>
    <Header :title="title" />
    <div class="text-right mr-40">
      <button
        type="button"
        v-on:click="isHidden = !isHidden"
        class="
          inline-block
          px-6
          py-2.5
          bg-blue-500
          text-white
          font-medium
          text-xs
          leading-tight
          uppercase
          rounded
          shadow-md
          hover:bg-blue-600 hover:shadow-lg
          focus:bg-blue-600 focus:shadow-lg focus:outline-none focus:ring-0
          active:bg-blue-700 active:shadow-lg
          transition
          duration-150
          ease-in-out
          content-end
        "
      >
        Create Post
      </button>
    </div>
    <ol class="border-l border-gray-300">
      <Post
        v-for="post in posts"
        :key="post.id"
        :id="post.id"
        :post="post.post"
        :description="post.description"
      />
    </ol>
    <div
      v-if="!isHidden"
      class="modal fixed top-0 left-0 w-full h-full outline-none"
      id="staticBackdrop"
      data-bs-backdrop="static"
      data-bs-keyboard="false"
      tabindex="-1"
      aria-labelledby="staticBackdropLabel"
      aria-hidden="true"
    >
      <div class="modal-dialog modal-lg relative w-auto pointer-events-none">
        <div
          class="
            modal-content
            border-none
            shadow-lg
            relative
            flex flex-col
            w-full
            pointer-events-auto
            bg-white bg-clip-padding
            rounded-md
            outline-none
            text-current
          "
        >
          <div
            class="
              modal-header
              flex flex-shrink-0
              items-center
              justify-between
              p-4
              border-b border-gray-200
              rounded-t-md
            "
          >
            <h5
              class="text-xl font-medium leading-normal text-gray-800"
              id="exampleModalLabel"
            >
              Create Post
            </h5>
            <button
              type="button"
              class="
                btn-close
                box-content
                w-4
                h-4
                p-1
                text-black
                border-none
                rounded-none
                opacity-50
                focus:shadow-none focus:outline-none focus:opacity-100
                hover:text-black hover:opacity-75 hover:no-underline
              "
              v-on:click="isHidden = !isHidden"
            ></button>
          </div>
          <div class="modal-body relative p-4">
            <div class="block p-6 rounded-lg shadow-lg bg-white w-full">
              <form @submit.prevent="post_data">
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
                    id="exampleInput7"
                    v-model="form.post"
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
                    v-model="form.description"
                    name="description"
                    id="exampleFormControlTextarea13"
                    rows="3"
                    placeholder="Message"
                  ></textarea>
                </div>
                <button
                  type="submit"
                  class="
                    w-full
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
                    focus:bg-blue-700
                    focus:shadow-lg
                    focus:outline-none
                    focus:ring-0
                    active:bg-blue-800 active:shadow-lg
                    transition
                    duration-150
                    ease-in-out
                  "
                >
                  Post
                </button>
              </form>
            </div>
          </div>
        </div>
      </div>
      <notifications group="foo" position="bottom right" />
    </div>
  </div>
</template>

<script>
import Post from "../../components/post";
import Header from "../../components/Header.vue";

export default {
  layout: "customize",
  components: {
    Post,
    Header,
  },
  data() {
    return {
      title: "Posts",
      posts: [],
      form: {
        post: "",
        description: "",
      },
      isHidden: true,
    };
  },
  async fetch() {
    const config = {
      headers: {
        Accept: "application/json",
      },
    };

    try {
      const res = await this.$axios.get("/posts", config);
      // console.log(res);
      this.posts = res.data;
    } catch (err) {
      console.log(err);
    }
  },
  methods: {
    post_data: async function () {
      const formData = new FormData();
      for (let [key, value] of Object.entries(this.form)) {
        formData.append(key, value);
      }

      await this.$axios
        .post("/posts/", formData)
        .then(({ data }) => {
          this.$notify({
            group: "foo",
            // title: "This is the <em>title</em>",
            text: "<b>" + data.message + "</b>",
            type: "success",
          });
          this.form = "";
          this.isHidden = true;
          this.$nuxt.refresh();
        })
        .catch((e) => {
          console.log(e);
        });
    },
  },
  head() {
    return {
      title: "Post App",
    };
  },
};
</script>

<style>
</style>