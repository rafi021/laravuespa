<template>
  <div class="conatiner">
      <div class="row">
        <div class="col-8 offset-2">
          <div class="card">
            <div class="card-header">
              Dashboard
            </div>
            <div class="card-body">
              Welcome, to Dashboard Mr.{{ user.name }}
            </div>
          </div>
        </div>
      </div>
  </div>
</template>

<script>
export default {
  computed: {
    user(){
      return this.$store.getters.getUser;
    }
  }
}
</script>

<style>

</style>