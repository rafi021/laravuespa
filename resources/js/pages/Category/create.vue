<template>
  <div class="container">
      <div class="row">
          <div class="col-md-8 m-auto">
              <div class="card">
                  <div class="card-header">
                      Add/Edit Category
                  </div>
                  <div class="card-body">
                    <form @submit.prevent="categoryStore">
                        <div class="form-group">
                            <label for="">Category Name</label>
                            <input type="text" class="form-contorl" name="categoryname" v-model="form.categoryname">
                            <small class="text-danger" v-if="errors.categoryname">{{ errors.categoryname[0] }}</small>
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
    data(){
        return{
            form: {
                categoryname: null,
            },
            errors: {},
        }
    },
    methods: {
        categoryStore(){
            // console.log(this.form)
            axios.post('/api/category', this.form)
            .then(res => {
                this.$router.push({name: 'category-index'})
            })
            .catch(err =>{
                this.errors = err.response.data.errors;
            })
        }
    }
}
</script>

<style>

</style>