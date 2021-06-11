<template>
  <div class="container">
      <div class="row">
          <div class="col-md-8 m-auto">
              <div class="card">
                  <div class="card-header">
                      Add/Edit Category
                  </div>
                  <div class="card-body">
                    <form @submit.prevent="editCategory">
                        <div class="form-group">
                            <label for="">Category Name</label>
                            <input type="text" class="form-contorl" name="name" v-model="form.name">
                            <small class="text-danger" v-if="errors.name">{{ errors.name[0] }}</small>
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
        let id = this.$route.params.id;
        axios.get(`/api/category/${id}`)
            .then(res => {
                this.form = res.data
                console.log(this.form, );
            })
            .catch(err => console.log(err))
        },
    data(){
        return{
            form: {
                name: '',
            },
            errors: {},
        }
    },
    methods: {
        editCategory(){
            let id = this.$route.params.id;
            axios.put(`/api/category/${id}`, this.form)
            .then(res => {
                this.$router.push({name: 'category-index'});
            }).catch(err => {
                console.log(err.response.data);
                this.errors = err.response.data.errors;
            })
        }
    }
}
</script>

<style>

</style>