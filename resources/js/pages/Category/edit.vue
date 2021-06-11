<template>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header d-flex justify-content-between align-items-center">
             <h5 class="mb-0"> Edit Category - {{ categoryForm.category_name }}</h5>
             <router-link :to="{name: 'category-index'}" class="btn btn-primary">Back to Category</router-link>
        </div>
          <div class="card-bdoy">
              <div class="row">
                  <div class="col-6 offset-3">
                    <form @submit.prevent="updateCategory">
                        <div class="form-group">
                            <label for="categoryName">Category Name</label>
                            <input type="text" name="category_name" class="form-control" placeholder="Enter Category Name Here" v-model="categoryForm.category_name" :class="{'is-invalid': categoryForm.errors.has('category_name')}">
                            <div class="text-danger" v-if="categoryForm.errors.has('category_name')" v-html="categoryForm.errors.get('category_name')" />
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Update Category </button>
                        </div>
                    </form>
                  </div>
              </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { Form } from 'vform';
export default {
   data(){
       return{
           categoryForm: new Form({
               category_name: '',
             }),
        }
   },
   mounted(){
     this.loadCategory();
   },
   methods: {
      loadCategory(){
        let id = this.$route.params.id;
        axios.get(`/api/category/${id}`)
        .then((res) => {
          //console.log(res.data)
            this.categoryForm.category_name = res.data.data.category_name;
        }).catch((err) => {
            console.log(err)
        })
       },
       updateCategory(){
        let id = this.$route.params.id;
        this.categoryForm.put(`/api/category/${id}`)
        .then((res) => {
            this.categoryForm.category_name = '';
            this.$router.push({name: 'category-index'})
            this.$toast.info({
                title: res.data.alert_type,
                message: res.data.message,
            })
        }).catch((err) => {
            console.log(err)
        })
       }
   }
};
</script>

<style>
</style>