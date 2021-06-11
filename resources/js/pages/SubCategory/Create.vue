<template>
  <div class="container">
      <div class="row">
          <div class="col-md-8 m-auto">
              <div class="card">
                  <div class="card-header">
                      Add/Edit Sub Category
                  </div>
                  <div class="card-body">
                    <form @submit.prevent="subCategoryStore">
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
                        <button type="submit" class="btn btn-primary">Add New</button>
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
    },
    data(){
        return{
            form: {
                category_id: null,
                subcategoryname: null,
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
        subCategoryStore(){
            axios.post('/api/subcategory', this.form)
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