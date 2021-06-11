<template>
  <div class="container">
      <div class="row">
          <div class="col-md-8 m-auto">
              <div class="card">
                  <div class="card-header">
                      Add/Edit Product
                  </div>
                  <div class="card-body">
                    <form @submit.prevent="productUpdate">
                        <div class="form-group">
                            <label for="">Category Name <span class="text-danger">*</span></label>
                            <select name="category_id" id="customSelect1" class="custom-select" v-model="form.category_id">
                                <option :value="category.id" v-for="category in categories" :key="category.id">{{ category.name }}</option>
                            </select>
                            <small class="text-danger" v-if="errors.category_id">{{ errors.category_id[0] }}</small>
                        </div>
                        <div class="form-group">
                            <label for="">Sub Category Name <span class="text-danger">*</span></label>
                            <select name="subcategory_id" id="customSelect2" class="custom-select" v-model="form.subcategory_id">
                                <option :value="subcategory.id" v-for="subcategory in subcategories" :key="subcategory.id">{{ subcategory.name }}</option>
                            </select>
                            <small class="text-danger" v-if="errors.subcategory_id">{{ errors.subcategory_id[0] }}</small>
                        </div>
                        <div class="form-group">
                            <label for="">Product Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-contorl" name="productname" v-model="form.productname">
                            <small class="text-danger" v-if="errors.productname">{{ errors.productname[0] }}</small>
                        </div>
                        <div class="form-group">
                            <div class="custom-file">
                                <input type="file" name="product_image" class="custom-file-input" id="product-image" @change="onFileSelected">
                                <label class="custom-file-label">Product Image Upload</label>
                                <small class="text-danger" v-if="errors.product_image">{{ errors.product_image[0] }}</small> 
                            </div>
                        </div>
                        <div class="col-md-12 col-12" v-show="form.new_image !=null">
                            <div class="form-group">
                                <img :src="form.new_image" alt="new_image" style="height: 100px; width: 100px" class="rounded mx-auto d-block">
                            </div>
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
    mounted(){
        this.getCategories();
        this.getSubCategories();
        this.getProduct();
    },
    data(){
        return{
            form: {
                productname: '',
                category_id: '',
                subcategory_id: '',
                new_image: null,
                product_image: '',
            },
            categories: {},
            subcategories: {},
            errors: {},
        }
    },
    methods: {
        getProduct(){
            let id = this.$route.params.id;
                axios.get(`/api/product/${id}`)
                .then(res => {
                    this.form.productname = res.data.name
                    this.form.product_image = res.data.image
                    this.form.category_id = res.data.category_id
                    this.form.subcategory_id = res.data.sub_category_id
                    console.log(this.form);
            })
            .catch(err => console.log(err))
        },
        getCategories(){
            axios.get('/api/categories')
        .then((res) => {
            this.categories = res.data
        })
            .catch(err => this.errors = err.response.data.errors)
        },
        getSubCategories(){
            axios.get('/api/subcategories')
            .then((res) =>{
                this.subcategories = res.data
            })
            .catch(err => this.errors = err.response.data.errors)
        },
        productUpdate(){
             let id = this.$route.params.id;
            axios.put(`/api/product/${id}`, this.form)
            .then((res) => {
                //console.log(res.data);
                this.$router.push({name: 'products-index'});
            })
            .catch((err) => {
                this.errors = err.response.data.errors
            })
        },
        onFileSelected(event){
                let file = event.target.files[0];  // get the file details 
                if(file.size > 1048770){
                    // Notification.image_validation();
                }else{
                    let reader = new FileReader();
                    //console.log(reader);
                    reader.onloadend = file => {
                        this.form.new_image = reader.result;
                        // console.log(event.target.result)
                    };
                    reader.readAsDataURL(file);
                }
            }
    }
}
</script>

<style>

</style>