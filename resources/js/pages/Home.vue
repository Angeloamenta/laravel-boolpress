<template>
  <div>
      Home
      <div>
        <Main :posts="posts"></Main>
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

<style lang="scss">

</style>