<template>
  <div
    class="bg-green-900 text-white"
    :class="{ 'absolute w-full h-screen top-0 left-0': menu }"
  >
    <div class="container sm:mx-auto flex justify-between">
      <div class="w-auto p-6">
        <!-- Title -->
        <h1 class="hidden sm:block">POST APP</h1>
        <!-- Icon -->
        <div class="block sm:hidden">X
          <i class="fa fa-rocket"></i>
        </div>
      </div>
      <!-- Desktop nav list -->
      <nav class="hidden sm:block">
        <ul class="flex">
           <li
            v-for="(item, index) in items"
            :key="index"
          >
           <nuxt-link :to="item.page" class="hover:bg-green-800 p-6 block">{{ item.title }}</nuxt-link>
          </li>
        </ul>
      </nav>
      <!-- Toggle menu mobile icon -->
        <div
          class="ml-auto sm:hidden p-6"
          @click="menu = !menu"
        >Y
          <i class="fa fa-bars"></i>
        </div>
      </div>
      <!-- Mobile nav list -->
      <nav v-show="menu" class="w-full">
        <ul class="flex flex-col text-center">
        <li
          v-for="(item, index) in items"
          :key="index"
        >
          <nuxt-link :to="item.page" class="hover:bg-green-800 p-6 block">{{ item.title }}</nuxt-link>
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
      items: [
        {
          title: 'Home',
          page: '/'
        },
        {
          title: 'Post',
          page: '/posts'
        },
        {
          title: 'About',
          page: '/about'
        }
      ]
    }
  }
}
</script>