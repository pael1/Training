<template>
  <div
    class="h-screen flex flex-col items-center justify-center border rounded"
  >
    <div class="block p-6 rounded-lg shadow-lg bg-white max-w-sm">
      <form method="post" @submit.prevent="login">
        <div class="form-group mb-6">
          <label
            for="exampleInputEmail1"
            class="form-label inline-block mb-2 text-gray-700"
            >Email address</label
          >
          <input
            type="email"
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
            v-model="email"
            id="exampleInputEmail1"
            aria-describedby="emailHelp"
            placeholder="Enter email"
          />
        </div>
        <div class="form-group mb-6">
          <label
            for="exampleInputPassword1"
            class="form-label inline-block mb-2 text-gray-700"
            >Password</label
          >
          <input
            type="password"
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
            v-model="password"
            id="exampleInputPassword1"
            placeholder="Password"
          />
        </div>
        <div class="flex items-center justify-center">
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
              items-center
              justify-center
            "
          >
            Login
          </button>
        </div>
      </form>
    </div>
    <client-only>
      <notifications group="foo" position="bottom right" />
    </client-only>
  </div>
</template>

<script>
export default {
  data() {
    return {
      email: "",
      password: "",
    };
  },
  methods: {
    async login() {
      try {
        const res = await this.$auth.loginWith("laravelSanctum", {
          data: {
            email: this.email,
            password: this.password,
          },
        });
        this.$router.push("/");
      } catch (err) {
        console.log(err.message);
        this.$notify({
          group: "foo",
          // title: "This is the <em>title</em>",
          text: "<b>" + err.message + "</b>",
          type: "error",
        });
      }
    },
  },
};
</script>

<style>
</style>