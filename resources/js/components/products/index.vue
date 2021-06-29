<template>
    <div class="row justify-content-center">
      <div class="col-xl-12 col-lg-12 col-md-12">
        <div>
          <div class="row">
            <div class="col-lg-3">
              <router-link to="/createProduct" class="btn btn-primary btn-block">Add Product</router-link>
            </div>
            <div class="col-lg-6">
            </div>
            <div class="col-lg-3">
              <input type="text" class="form-control" id="search" placeholder="Search" v-model="searchTerm">
            </div>
          </div>
        </div>
        <br>
        <div class="row">
            <div class="col-lg-12 mb-4">
              <!-- Simple Tables -->
              <div class="card">
                <div class="table-responsive">
                  <table class="table align-items-center table-flush">
                    <thead class="thead-light">
                      <tr>
                        <th width="40%">Name</th>
                        <th width="5%">Code</th>
                        <th width="10%">Photo</th>
                        <th width="5%">Category</th>
                        <th width="5%">Buying Price</th>
                        <th width="5%">Selling Price</th>
                        <th width="5%">Root</th>
                        <th width="25%">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr v-for="product in filtersearch" :key="product.id">
                        <td>{{ product.product_name }}</td>
                        <td>{{ product.product_code }}</td>
                        <td><img :src="product.image" id="em_photo"></td>
                        <td>{{ product.category_name }}</td>
                        <td>{{ product.buying_price }}</td>
                        <td>{{ product.selling_price }}</td>
                        <td>{{ product.root }}</td>
                        <td>
                          <router-link :to="{name: 'editProduct', params:{id:product.id}}" class="btn btn-sm btn-info">Edit</router-link>
                          <a @click="deleteProduct(product.id)" class="btn btn-sm btn-danger">Delete</a>
                        </td>
                      </tr>
                    </tbody>
                  </table>
                </div>
                <div class="card-footer"></div>
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
        products: [],
        searchTerm: ''
      }
    },
    computed: {
      filtersearch(){
        return this.products.filter(product => {
          return product.product_code.match(this.searchTerm)
        })
      }
    },
    methods: {
      allProducts(){
        axios.get('/api/product')
        .then(({data}) => (this.products = data))
        .catch()
      },
      deleteProduct(id){
        Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
      }).then((result) => {
        if (result.isConfirmed) {
          axios.delete('/api/product/'+id)
          .then(() => {
            this.products = this.products.filter(product => {
              return product.id != id
            })
          })
          .catch(() => {
            this.$router.push({name: 'allProduct'})
          })
          Swal.fire(
            'Deleted!',
            'Your file has been deleted.',
            'success'
          )
        }
      })
      }
    },
    created(){
      this.allProducts();
    }
  }
  
</script>

<style type="text/css" scoped>
  #em_photo{
    height: 40px;
    width: 40px;
  }
</style>
