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
                        <th width="5%">Status</th>
                        <th width="5%">Quantity</th>
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
                        <td v-if="product.product_quantity >= 1"><span class="badge badge-success">Available</span></td>
                        <td v-else=" "><span class="badge badge-danger">Stock Out</span></td>
                        <td>{{ product.product_quantity }}</td>
                        <td>
                          <router-link :to="{name: 'editStock', params:{id:product.id}}" class="btn btn-sm btn-info">Edit</router-link>
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
      }
    },
    created(){
      this.allProducts();
    }
  }
  
</script>

<style type="text/css">
  #em_photo{
    height: 40px;
    width: 40px;
  }
</style>
