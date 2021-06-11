<template>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header d-flex justify-content-between align-items-center">
             <h5 class="mb-0"> Product Category Create Component</h5>
             <router-link :to="{name: 'category-index'}" class="btn btn-primary">Back to Category</router-link>
        </div>
          <div class="card-bdoy">
              <form action="">
                  <div class="form-group">
                    <label for="categoryName">Category Name</label>
                    <input type="text" name="category_name" id="" class="form-control" placeholder="Enter Category Name Here" aria-describedby="helpId">
                    <small id="helpId" class="text-muted">Provide a Category Name </small>
                  </div>
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
        console.log('component mounted.')
    }
};
</script>

<style>
</style>