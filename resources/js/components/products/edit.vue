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
                  <form class="user" @submit.prevent="editProduct" enctype="multipart/form-data">
                    <div class="form-group">
                      <div class="form-row">
                        <div class="col-lg-9">
                          <label>Product Name</label>
                          <input type="text" class="form-control" id="product_name" placeholder="Enter Product Name" v-model="form.product_name">
                          <small class="text-danger" v-if="errors.product_name">{{ errors.product_name[0] }}</small>
                        </div>
                        <div class="col-lg-3">
                          <label>Product Code</label>
                          <input type="text" class="form-control" id="product_code" placeholder="Enter Product Code" v-model="form.product_code">
                          <small class="text-danger" v-if="errors.product_code">{{ errors.product_code[0] }}</small>
                        </div>
                      </div>
                    </div>
                    <div class="form-group">
                      <div class="form-row">
                        <div class="col-lg-6">
                          <label for="category_id">Product Category</label>
                          <select class="form-control" id="category_id" v-model="form.category_id">
                            <option v-for="category in categories" :key="category.id" :value="category.id">{{ category.category_name }}</option>
                          </select>
                        </div>
                        <div class="col-lg-6">
                          <label for="supplier_id">Product Supplier</label>
                          <select class="form-control" id="supplier_id" v-model="form.supplier_id">
                            <option v-for="supplier in suppliers" :key="supplier.id" :value="supplier.id" >{{ supplier.name }}</option>
                          </select>
                        </div>
                      </div>
                    </div>
                    <div class="form-group">
                      <div class="form-row">
                        <div class="col-lg-4">
                          <label>Product Root</label>
                          <input type="text" class="form-control" id="root" placeholder="Enter Product Root" v-model="form.root">
                          <small class="text-danger" v-if="errors.root">{{ errors.root[0] }}</small>
                        </div>
                        <div class="col-lg-4">
                          <label>Buying Price</label>
                          <input type="text" class="form-control" id="buying_price" placeholder="Enter Buying Price" v-model="form.buying_price">
                          <small class="text-danger" v-if="errors.buying_price">{{ errors.buying_price[0] }}</small>
                        </div>
                        <div class="col-lg-4">
                          <label>Selling Price</label>
                          <input type="text" class="form-control" id="selling_price" placeholder="Enter Selling Price" v-model="form.selling_price">
                          <small class="text-danger" v-if="errors.selling_price">{{ errors.selling_price[0] }}</small>
                        </div>
                      </div>
                    </div>
                    <div class="form-group">
                      <div class="form-row">
                        <div class="col-lg-6">
                          <label>Buying Date</label>
                          <input type="date" class="form-control" id="buying_date" placeholder="Enter Buying Date" v-model="form.buying_date">
                          <small class="text-danger" v-if="errors.buying_date">{{ errors.buying_date[0] }}</small>
                        </div>
                        <div class="col-lg-4">
                          <label>Product Quantity</label>
                          <input type="text" class="form-control" id="product_quantity" placeholder="Enter Product Quantity" v-model="form.product_quantity">
                          <small class="text-danger" v-if="errors.product_quantity">{{ errors.product_quantity[0] }}</small>
                        </div>
                      </div>
                    </div>
                    <div class="form-group">
                      <div class="form-row">
                        <div class="col-lg-6">
                          <input type="file" class="custom-file-input" id="customFile" @change="onFileSelected">
                          <label class="custom-file-label" for="customFile">Choose file</label>
                          <small class="text-danger" v-if="errors.image">{{ errors.image[0] }}</small>
                        </div>
                        <div class="col-lg-6">
                          <img :src="form.image" style="height: 40px; width: 40px;">
                        </div>
                      </div>
                    </div>
                    <div class="form-group">
                      <button type="submit" class="btn btn-primary btn-block">Update Product</button>
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
          product_name: '', 
          product_code: '', 
          category_id: '',
          supplier_id: '',
          root: '',
          buying_price: '',
          selling_price: '',
          buying_date: '',
          image: '',
          product_quantity: '',
          newimage: ''
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
      onFileSelected(event){
        let file = event.target.files[0];
        if(file.size > 1048770){
          Notification.image_validation();
        }
        else{
          let reader = new FileReader();
          reader.onload = event => {
            this.form.newimage = event.target.result;
          }
          reader.readAsDataURL(file);
        }
      },
      editProduct(){
        let id = this.$route.params.id;
        axios.patch('/api/product/'+id, this.form)
        .then(() => {
          this.$router.push({name: 'allProduct'});
          Notification.success();
        })
        .catch(error => this.errors = error.response.data.errors)
      }
    }
  }
  
</script>

<style type="text/css">

</style>
