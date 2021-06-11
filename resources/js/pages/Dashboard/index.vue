<template>
  <div class="conatiner">
      <div class="row">
        <div class="col-8 offset-2">
          <div class="card">
            <div class="card-header">
              Dashboard
            </div>
            <div class="card-body">
              {{ message }}
            </div>
          </div>
        </div>
      </div>
  </div>
</template>

<script>
export default {
  computed: {
    message(){
      return this.$store.getters.getMessage;
    }
  }
}
</script>

<style>

</style>