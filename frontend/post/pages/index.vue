<template>
<Header :title="title"/>
</template>

<script>
export default {
  layout: 'customize',
  name: 'IndexPage',
  data(){
    return{
      title: "Home"
    }
  }
}
</script>
