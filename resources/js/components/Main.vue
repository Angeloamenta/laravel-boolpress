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
    <!-- <div class="row mt-3 bg-light">
      <ul class="list-inline bg-light">
        <li class="list-inline-item"> <button v-if="prev_page_url" class="btn btn-primary" @click="changePage('prev_page_url')">Prev</button></li>
        <li class="list-inline-item"> <button v-if="next_page_url" class="btn btn-primary" @click="changePage('next_page_url')">Next</button></li>
      </ul>
    </div> -->
  </div>
</template>

<script>
import Axios from "axios";

  export default {
    name: "Main",
    data() {
      return {
        posts: null,
        
      }
    },
    created() {
     Axios.get('http://localhost:8000/api/posts').then(
     (results) =>{
         console.log(results);
         this.posts = results.data.results.posts;
     }
 )
    },
    methods: {
      
    }
  }
</script>

<style lang="scss" scoped>

</style>