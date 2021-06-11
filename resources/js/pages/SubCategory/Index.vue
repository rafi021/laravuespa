<template>
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">
            <h1>Sub Category List</h1>
            <div class="row">
              <div class="col-sm-6">
                <router-link class="btn btn-primary" :to="{name: 'subcategory-create'}">Add Sub Category</router-link>
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
                  <th scope="col">Sub Category</th>
                  <th scope="col">Category Name</th>
                  <th scope="col">Actions</th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="(subcategory,index) in searchFilter" :key="subcategory.id">
                  <th scope="row">{{ index+1 }}</th>
                  <td>{{ subcategory.name }}</td>
                  <td>{{ subcategory.category.name}}</td>
                  <td>
                    <router-link :to="{name: 'subcategory-edit', params: { id: subcategory.id } }"
                    class="btn btn-icon btn-outline-primary mr-1 mb-1">
                    Edit</router-link>
                    <a @click="deleteSubCategory(subcategory.id)" class="btn btn-icon btn-outline-danger mr-1 mb-1">Delete</a>
                  </td>
                </tr>
              </tbody>
            </table>
            <div class="row">
              <div class="col-md-6">
                Total {{ total }} Sub-Categories
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
      subcategories: [],
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
      return this.subcategories.filter(subcategory => {
        return (subcategory.name.match(this.searchWord))
      });
    }
  },
  methods: {
    async list(page=1){
        await axios.get(`/api/subcategory?page=${page}`).then(({data})=>{
            this.rawdata = data
            this.subcategories = data.data
            this.total = data.total
        }).catch(({ response })=>{
            console.error(response)
        })
    },
    deleteSubCategory(id){
      axios.delete(`/api/subcategory/${id}`)
      .then(() => {
        this.subcategories = this.subcategories.filter(subcategory => {
          return subcategory.id !=id;
        })
      })
      .catch((err) => {
          console.log(err.response.data)
          this.$router.push({name: 'subcategory-index'})
        })
    }
  }
}
</script>

<style>

</style>