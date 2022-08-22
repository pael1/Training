<template>
  <Header :title="title"/>
</template>

<script>
export default {
    layout: 'customize',
    head(){
        return {
            title: "Post App About"
        }
    },
    data(){
        return{
            title: "About"
        }
    }
}
</script>

<style>

</style>