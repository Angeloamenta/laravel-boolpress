<template>
  <div class="container">
    <div class="row row-cols-1 row-cols-md-4 g-4">
      <div class="col">
        <div class="card">
          <!-- <img :src="'/storage/'+post.image" alt=""> -->
          <div class="card-body">
            <h5 class="card-title">{{ post.title }}</h5>
            <p class="card-text">{{ post.content }}</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
 import Axios from "axios";

  export default {
    name: "Product",
    props: ['id'],
    data() {
        return{
            post:{}
        }
    },
        created() {
      const url = 'http://127.0.0.1:8000/api/posts/' + this.id;
      this.getProduct(url);
    },
    methods: {
      getProduct(url){
          Axios.get(url, {headers: {'Authorization': 'Bearer 12345678'}}).then(
            (result) => {
              console.log(result);
              this.post = result.data.results.data;
            });
      }
    }
  }
</script>

<style lang="scss" scoped>

</style>