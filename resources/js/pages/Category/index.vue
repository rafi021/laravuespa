<template>
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">
            <h1>Category List</h1>
            <div class="row">
              <div class="col-sm-6">
                <router-link class="btn btn-primary" :to="{name: 'category-create'}">Add Category</router-link>
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
                  <th scope="col">Name</th>
                  <th scope="col">Actions</th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="(category,index) in searchFilter" :key="category.id">
                  <th scope="row">{{ index+1 }}</th>
                  <td>{{ category.name }}</td>
                  <td>
                    <router-link :to="{name: 'category-edit', params: { id: category.id } }"
                    class="btn btn-icon btn-outline-primary mr-1 mb-1">
                    Edit</router-link>
                    <a @click="deleteCategory(category.id)" class="btn btn-icon btn-outline-danger mr-1 mb-1">Delete</a>
                  </td>
                </tr>
              </tbody>
            </table>
            <div class="row">
              <div class="col-md-6">
                Total {{ total }} Categories
              </div>
              <div class="col-md-6">
                <pagination align="center" :data="rawdata" @pagination-change-page="getCategories"></pagination>
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
      categories: [],
      searchWord: '',
      errors: {},
      total: null
    }
  },
  mounted() {
    this.getCategories();
  },
  computed: {
    searchFilter(){
      return this.categories.filter(category => {
        return (category.name.match(this.searchWord))
      });
    }
  },
  methods: {
    async getCategories(page=1){
        await axios.get(`/api/category?page=${page}`).then(({data})=>{
            this.rawdata = data
            this.categories = data.data
            this.total = data.total
        }).catch(({ response })=>{
            console.error(response)
        })
    },
    deleteCategory(id){
      axios.delete(`/api/category/${id}`)
      .then(() => {
        this.categories = this.categories.filter(category => {
          return category.id !=id;
        })
      })
      .catch((err) => {
          console.log(err.response.data)
          this.$router.push({name: 'category-index'})
        })
    }
  }
}
</script>

<style>

</style>