<template>
  <div>
      <div>
        <Caricamento v-if="!posts"></Caricamento>
        <Main :posts="posts" v-else></Main>
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
import Main from '../components/Main.vue';
import Caricamento from '../components/Caricamento.vue';


  export default {
    name: "Home",
    components: {
      Main,
      Caricamento
    },
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
         // se volessi visualizzare l'api in random ordero dovrei 
         //aggiungere /random in axios e cancellare .posts in this.posts
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