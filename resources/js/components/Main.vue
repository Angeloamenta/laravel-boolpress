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
import Axios from "axios";

  export default {
    name: "Main",
    data() {
      return {
        posts: null,
        counter: 1,
        lastPage: 1
      }
    },
    created() {
     Axios.get('http://localhost:8000/api/posts').then(
     (results) =>{
         console.log(results);
         this.posts = results.data.results.posts.data;
         this.lastPage = results.data.results.posts.last_page;
        console.log(this.lastPage);
    //  console.log('prova', this.posts.length)
     })
    },
    methods: {
        changeNext() {
            this.counter += 1

            if (this.counter > this.lastPage) {
                this.counter = this.lastPage
            }else {

            Axios.get(`http://localhost:8000/api/posts?page=${this.counter}`).then(
           (results) =>{
               console.log(results);
               console.log(results.data.results.posts.last_page);

               console.log(this.counter);
               this.posts = results.data.results.posts.data;
          //  console.log('prova', this.posts.length)
           })

            }
      },

      changePrev() {
            this.counter -= 1
             if (this.counter < 1) {
                 this.counter = 1
             }else {

            Axios.get(`http://localhost:8000/api/posts?page=${this.counter}`).then(
           (results) =>{
               console.log(results);
               console.log(this.counter);
               this.posts = results.data.results.posts.data;
          //  console.log('prova', this.posts.length)
           })

        }
      }
    }
  }
</script>

<style lang="scss" scoped>

</style>