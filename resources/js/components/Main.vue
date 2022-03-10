<template>
  <div class="container">
    <div class="row row-cols-1 row-cols-md-4 g-4">
      <div class="col" v-for="(post, index) in posts" :key="index">
        <div class="card">
          <!-- <img :src="'/storage/'+product.image" class="card-img-top" :alt="product.name"> -->
          <img :src="'/storage/'+post.image" alt="">
          <div class="card-body">
            <h5 class="card-title">{{ post.title }}</h5>
            <p class="card-text">{{ post.content }}</p>
          </div>
        </div>
      </div>
    </div>
    <div class="row mt-3 bg-light">
      <ul class="list-inline bg-light">
        <li class="list-inline-item"> <button class="btn btn-primary" @click="changePrev()">Prev</button></li>
        <li class="list-inline-item"> <button class="btn btn-primary" @click="changeNext()">Next</button></li>
      </ul>
    </div>
  </div>
</template>

<script>
// import Axios from "axios";

  export default {
    name: "Main",
    props: ['posts'],
    methods: {
     changeNext() {
         this.$emit('changeNext');
       }
    }
  }
</script>

<style lang="scss" scoped>

</style>