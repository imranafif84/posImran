<template>
    <div class="row justify-content-center">
      <div class="col-xl-12 col-lg-12 col-md-12">
        <div>
          <div class="row">
            <div class="col-lg-3">
              <router-link to="/allCategory" class="btn btn-primary btn-block">All Categories</router-link>
            </div>
          </div>
        </div>
        <div class="card shadow-sm my-5">
          <div class="card-body p-0">
            <div class="row">
              <div class="col-lg-12">
                <div class="login-form">
                  <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-4">Add Category</h1>
                  </div>
                  <form class="user" @submit.prevent="createCategory" enctype="multipart/form-data">
                    <div class="form-group">
                      <div class="form-row">
                        <div class="col-lg-6">
                          <input type="text" class="form-control" id="category_name" placeholder="Enter Category Name" v-model="form.category_name">
                          <small class="text-danger" v-if="errors.category_name">{{ errors.category_name[0] }}</small>
                        </div>
                      </div>
                    </div>
                    <div class="form-group">
                      <button type="submit" class="btn btn-primary btn-block">Add Category</button>
                    </div>
                  </form>
                  <hr>
                  <div class="text-center"></div>
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
    created(){
      if(!User.loggedIn()){
        this.$router.push({name: '/'})
      }
    },
    data() {
      return {
        form: {
          category_name: null
        },
        errors: {}
      }
    },
    methods: {
      createCategory(){
        axios.post('/api/category', this.form)
        .then(() => {
          this.$router.push({name: 'allCategory'});
          Notification.success();
        })
        .catch(error => this.errors = error.response.data.errors)
      }
    }
  }
  
</script>

<style type="text/css">

</style>
