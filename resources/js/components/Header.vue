<template>
  <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
      <div class="container">
          <button class="navbar-toggler" type="button" data-toggle="collapse"
                  data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                  aria-expanded="false">
              <span class="navbar-toggler-icon"></span>
          </button>

          <div class="collapse navbar-collapse" id="navbarSupportedContent">
             <ul class="navbar-nav mr-auto">
               <li class="nav-item"  
                v-for="(item) in menuLink"
                :key="item.id"
                >
                  <router-link class="nav-link" :to="{ name: item.routeName}">{{ item.label }}</router-link>

               </li>
             </ul>
          </div>
      </div>
  </nav>
</template>

<script>
// import Axios from "axios";

  export default {
    name: "Header",
    data() {
      return {
        menuLink: [
                {
                    label: 'Home',
                    routeName: 'home'
                },
                {
                    label: 'Products',
                    routeName: 'products'
                },
                {
                    label: 'Chi Siamo',
                    routeName: 'about'
                },
                {
                    label: 'Contatti',
                    routeName: 'contacts'
                }
            ]
      }
    },
    created() {
     
    },
    methods: {

    }
}
</script>

<style lang="scss" scoped>

</style>