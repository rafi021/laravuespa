<template>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header d-flex justify-content-between align-items-center">
             <h5 class="mb-0"> Product Category List Component</h5>
             <router-link :to="{name: 'category-create'}" class="btn btn-primary">Create Category</router-link>
        </div>
          <div class="card-bdoy">
              <table class="table">
                  <thead>
                      <tr>
                          <th style="width: 100px">Id</th>
                          <th>Name</th>
                          <th>Slug</th>
                          <th style="width: 170px">Action</th>
                      </tr>
                  </thead>
                  <tbody>
                      <tr v-for="(category,index) in categories" :key="category.id">
                          <td style="width: 100px">{{ index+1 }}</td>
                          <td>{{ category.category_name }}</td>
                          <td>{{ category.category_slug }}</td>
                          <td style="width: 170px">
                              <router-link :to="{name: 'category-edit', params: { id: category.id }}" class="btn btn-primary btn-sm">Edit</router-link>
                              <a href="#" @click.prevent="deleteCategory(category.id)" class="btn btn-danger btn-sm">Delete</a>
                          </td>
                      </tr>
                      <tr v-if="!categories.length">
                          <td colspan="10">No Data found yet!</td>
                      </tr>
                  </tbody>
              </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import axios from 'axios';
export default {
   data(){
       return{
           categories: [],
       }
   },
   mounted() {
       this.loadCategories();
   }
   ,
   methods: {
       loadCategories(){
           axios.get('/api/category')
           .then((res) => {
               this.categories = res.data.data
           }).catch((err) =>{
               console.log(err.response.data)
              this.$toast.error({
                title: "Error",
                message: "Data Fetch Error",
            })
           })
       },
       deleteCategory(id){
           axios.delete(`/api/category/${id}`)
            .then((res) =>{
                //console.log(res.data)
                this.$toast.warn({
                    title: res.data.alert_type,
                    message: res.data.message,
                })
            })
            .then(() => {
               this.categories = this.categories.filter(category => {
                   return category.id !=id;
               })
            })
           .catch((err) =>{
               //console.log(err)
                this.$toast.error({
                    title: 'Error',
                    message: "Data Delete Error",
                });
                })
            }
        }
};
</script>

<style>
</style>