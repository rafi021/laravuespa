<template>
  <div class="container">
      <div class="row">
          <div class="col-md-8 m-auto">
              <div class="card">
                  <div class="card-header">
                      Add/Edit Sub Category
                  </div>
                  <div class="card-body">
                    <form @submit.prevent="subCategoryUpdate">
                        <div class="form-group">
                            <label for="">Category Name <span class="text-danger">*</span></label>
                            <select name="category_id" id="customSelect1" class="custom-select" v-model="form.category_id">
                                <option :value="category.id" v-for="category in categories" :key="category.id">{{ category.name }}</option>
                            </select>
                            <small class="text-danger" v-if="errors.category_id">{{ errors.category_id[0] }}</small>
                        </div>
                        <div class="form-group">
                            <label for="">Sub Category Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-contorl" name="subcategoryname" v-model="form.subcategoryname">
                            <small class="text-danger" v-if="errors.subcategoryname">{{ errors.subcategoryname[0] }}</small>
                        </div>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </form>
                  </div>
              </div>
          </div>
      </div>
  </div>
</template>

<script>
export default {
    created(){
        this.getCategories();
        this.getSubCategories();
    },
    data(){
        return{
            form: {
                category_id: '',
                subcategoryname: '',
            },
            categories: {},
            errors: {},
        }
    },
    methods: {
        getCategories(){
            axios.get('/api/categories')
            .then(res => this.categories = res.data)
            .catch(err => this.errors = err.response.data.errors)
        },
        getSubCategories(){
            let id = this.$route.params.id;
            axios.get(`/api/subcategory/${id}`)
            .then((res) =>{
                this.form.subcategoryname =  res.data.name;
                this.form.category_id = res.data.category_id;
                //console.log(this.subcategoryname);
            }) 
            .catch(err => console.log(err))
        },
        subCategoryUpdate(){
            let id = this.$route.params.id;
            axios.put(`/api/subcategory/${id}`, this.form)
            .then((res) => {
                console.log(res.data);
                this.$router.push({name: 'subcategory-index'});
            })
            .catch((err) => {
                this.errors = err.response.data.errors
            })
        }
    }
}
</script>

<style>

</style>