<template>
<div>
<Header :title="title"/>
</div>
</template>

<script>
export default {
  layout: 'customize',
  name: 'IndexPage',
  data() {
    return {
      title: 'Welcome to Dashboard',
    }
  },
}
</script>
