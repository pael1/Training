<template>
  <div
    class="bg-gray-200 text-black-700"
    :class="{ 'absolute w-full h-screen top-0 left-0': menu }"
  >
    <div class="container sm:mx-auto flex justify-between">
      <div class="w-auto p-6">
        <!-- Title -->
        <h1 class="hidden sm:block">POST APP</h1>
        <!-- Icon -->
        <div class="block sm:hidden">Post App</div>
      </div>
      <!-- Desktop nav list -->
      <nav class="hidden sm:block">
        <ul class="flex">
          <li v-for="(item, index) in items" :key="index">
            <nuxt-link :to="item.page" class="hover:bg-gray-300 p-6 block">{{
              item.title
            }}</nuxt-link>
          </li>
          <li class="p-6 block">
            <div class="dropdown relative">
              <a
                class="dropdown-toggle flex items-center hidden-arrow"
                href="#"
                id="dropdownMenuButton2"
                role="button"
                data-bs-toggle="dropdown"
                aria-expanded="false"
              >
                <img
                  src="https://mdbootstrap.com/img/new/avatars/2.jpg"
                  class="rounded-full"
                  style="height: 25px; width: 25px"
                  alt=""
                  loading="lazy"
                />
              </a>
              <ul
                class="
                  dropdown-menu
                  min-w-max
                  absolute
                  hidden
                  bg-white
                  text-base
                  z-50
                  float-left
                  py-2
                  list-none
                  text-left
                  rounded-lg
                  shadow-lg
                  mt-1
                  hidden
                  m-0
                  bg-clip-padding
                  border-none
                  left-auto
                  right-0
                "
                aria-labelledby="dropdownMenuButton2"
              >
                <li>
                  <a
                    class="
                      dropdown-item
                      text-sm
                      py-2
                      px-4
                      font-normal
                      block
                      w-full
                      whitespace-nowrap
                      bg-transparent
                      text-gray-700
                      hover:bg-gray-100
                    "
                    href="#" @click.prevent="logout"
                    >Logout</a
                  >
                </li>
              </ul>
            </div>
          </li>
        </ul>
      </nav>
      <!-- Toggle menu mobile icon -->
      <div class="ml-auto sm:hidden p-6" @click="menu = !menu">
        <svg
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
            d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5"
          />
        </svg>
        <i class="fa fa-bars"></i>
      </div>
    </div>
    <!-- Mobile nav list -->
    <nav v-show="menu" class="w-full">
      <ul class="flex flex-col text-center">
        <li v-for="(item, index) in items" :key="index">
          <nuxt-link :to="item.page" class="hover:bg-gray-300 p-6 block">{{
            item.title
          }}</nuxt-link>
        </li>
      </ul>
    </nav>
  </div>
</template>
<script>
export default {
  name: "Navbar",
  data() {
    return {
      menu: false,
      user: this.$auth.user.data,
      items: [
        {
          title: "Home",
          page: "/",
        },
        {
          title: "Post",
          page: "/posts",
        },
        {
          title: "About",
          page: "/about",
        },
      ],
    };
  },
  methods: {
    async logout() {
      await this.$auth.logout()

      this.$router.push('/login')
    },
  },
};
</script>