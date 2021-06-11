<template>
  <div class="container">
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header d-flex justify-content-between align-items-center">
             <h5 class="mb-0"> Product Category Edit Component</h5>
             <router-link :to="{name: 'category-index'}" class="btn btn-primary">Back to Category</router-link>
        </div>
          <div class="card-bdoy">
              <div class="row">
                  <div class="col-6 offset-3">
                    <form>
                        <div class="form-group">
                            <label for="categoryName">Category Name</label>
                            <input type="text" name="category_name" class="form-control" placeholder="Enter Category Name Here">
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
export default {
    mounted(){
        console.log('component mounted.')
    }
};
</script>

<style>
</style>