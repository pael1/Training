<template>
  <Header :title="title"/>
</template>

<script>
export default {
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