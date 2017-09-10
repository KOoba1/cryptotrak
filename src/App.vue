<template>
  <div id="app">
  <TopNav></TopNav>
    <router-view></router-view>
  </div>
</template>

<script>

import TopNav from '@/components/TopNav'
export default {
  name: 'app',
   components:{ TopNav }
}
</script>

<style>

</style>
