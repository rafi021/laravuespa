<template>
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">
            <h1>Product List</h1>
            <div class="row">
              <div class="col-sm-6">
                <router-link class="btn btn-primary" :to="{name: 'products-create'}">Add Product</router-link>
              </div>
              <div class="col-sm-6">
                <form class="form-inline">
                <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search" v-model="searchWord">
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
              </form>
              </div>
            </div>
          </div>
          <div class="card-body">
            <table class="table table-bordered">
              <thead>
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">Product Image</th>
                  <th scope="col">Product Name</th>
                  <th scope="col">Category Name</th>
                  <th scope="col">SubCategory Name</th>
                  <th scope="col">Actions</th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="(product,index) in searchFilter" :key="product.id">
                  <th scope="row">{{ index+1 }}</th>
                  <th><img :src="product.image" alt="" style="height: 50px; width: 50px"></th>
                  <td>{{ product.name }}</td>
                  <td>{{ product.category.name}}</td>
                  <td>{{ product.subcategory.name}}</td>
                  <td>
                    <router-link :to="{name: 'products-edit', params: { id: product.id } }"
                    class="btn btn-icon btn-outline-primary mr-1 mb-1">
                    Edit</router-link>
                    <a @click="deleteProduct(product.id)" class="btn btn-icon btn-outline-danger mr-1 mb-1">Delete</a>
                  </td>
                </tr>
              </tbody>
            </table>
            <div class="row">
              <div class="col-md-6">
                Total {{ total }} Products
              </div>
              <div class="col-md-6">
                <pagination align="center" :data="rawdata" @pagination-change-page="list"></pagination>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import pagination from 'laravel-vue-pagination';

export default {
  components:{
    pagination
  },
  data(){
    return{
      rawdata: {},
      products: [],
      searchWord: '',
      errors: {},
      total: null
    }
  },
  mounted(){
    this.list()
  },
  // created() {
  //   axios.get('/api/subcategory')
  //   .then((res) => {
  //     //console.log(res.data.data)
  //     this.rawdata = res.data;
  //     this.subcategories = res.data.data;
  //   }).catch((err) => {
  //     console.log(err.response.data)
  //     this.errors = err.response.data.errors;
  //   })
  // },
  computed: {
    searchFilter(){
      return this.products.filter(product => {
        return (product.name.match(this.searchWord))
      });
    }
  },
  methods: {
    async list(page=1){
        await axios.get(`/api/product?page=${page}`).then(({data})=>{
            this.rawdata = data
            this.products = data.data
            this.total = data.total
        }).catch(({ response })=>{
            console.error(response)
        })
    },
    deleteProduct(id){
      axios.delete(`/api/product/${id}`)
      .then(() => {
        this.products = this.products.filter(product => {
          return product.id !=id;
        })
      })
      .catch((err) => {
          console.log(err.response.data)
          this.$router.push({name: 'product-index'})
        })
    }
  }
}
</script>

<style>

</style>