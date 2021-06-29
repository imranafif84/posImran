<template>
    <div class="row justify-content-center">
      <div class="col-xl-12 col-lg-12 col-md-12">
        <div>
          <div class="row">
            <div class="col-lg-3">
              <router-link to="/allProduct" class="btn btn-primary btn-block">All Products</router-link>
            </div>
          </div>
        </div>
        <div class="card shadow-sm my-5">
          <div class="card-body p-0">
            <div class="row">
              <div class="col-lg-12">
                <div class="login-form">
                  <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-4">Edit Product</h1>
                  </div>
                  <form class="user" @submit.prevent="stockUpdate" enctype="multipart/form-data">
                    <div class="form-group">
                      <div class="form-row">
                        <div class="col-lg-6">
                          <label>Product Quantity</label>
                          <input type="text" class="form-control" id="product_quantity" placeholder="Enter Product Quantity" v-model="form.product_quantity">
                          <small class="text-danger" v-if="errors.product_quantity">{{ errors.product_quantity[0] }}</small>
                        </div>
                      </div>
                    </div>
                    <div class="form-group">
                      <button type="submit" class="btn btn-primary btn-block">Update Stock</button>
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
          product_quantity: ''
        },
        errors: {},
        categories: {},
        suppliers: {}
      }
    },
    created(){
      let id = this.$route.params.id;
      axios.get('/api/product/'+id)
      .then(({data}) => (this.form = data))
      .catch(console.log('error'))

      axios.get('/api/category/')
      .then(({data}) => (this.categories = data))

      axios.get('/api/supplier/')
      .then(({data}) => (this.suppliers = data))
    },
    methods: {
      stockUpdate(){
        let id = this.$route.params.id;
        axios.post('/api/stock/update/'+id, this.form)
        .then(() => {
          this.$router.push({name: 'allStock'});
          Notification.success();
        })
        .catch(error => this.errors = error.response.data.errors)
      }
    }
  }
  
</script>

<style type="text/css">

</style>
