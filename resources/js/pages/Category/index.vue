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
                          <th>Id</th>
                          <th>Name</th>
                          <th>Slug</th>
                          <th>Action</th>
                      </tr>
                  </thead>
                  <tbody>
                      <tr>
                          <td>1</td>
                          <td>Fashion</td>
                          <td>fashion</td>
                          <td>
                              <router-link :to="{name: 'category-edit'}" class="btn btn-primary btn-sm">Edit</router-link>
                              <a href="#" class="btn btn-danger btn-sm">Delete</a>
                          </td>
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
export default {
    mounted(){
        console.log('component mounted.')
    }
};
</script>

<style>
</style>