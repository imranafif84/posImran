<template>
    <!-- Container Fluid-->
        <div class="container-fluid" id="container-wrapper">
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">POS Dashboard</h1>
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="./">Home</a></li>
              <li class="breadcrumb-item active" aria-current="page">POS</li>
            </ol>
          </div>

          <div class="row mb-3">
        
            <!-- Area Chart -->
            <div class="col-xl-5 col-lg-5">
              <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">Expense</h6>
                  <a href="/createCustomer" class="btn btn-sm btn-info">Add Customer</a>
                </div>
                <div class="table-responsive" style="font-size: 12px">
                  <table class="table align-items-center table-flush">
                    <thead class="thead-light">
                      <tr>
                        <th>Name</th>
                        <th>Quantity</th>
                        <th>Unit</th>
                        <th>Total</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr v-for="cart in carts" :key="cart.id">
                        <td>{{ cart.product_name }}</td>
                        <td>
                          <input type="text" class="form-control" readonly :value="cart.product_quantity">
                          <button @click="increment(cart.id)" class="btn btn-success">+</button>
                          <button v-if="cart.product_quantity >= 2" @click="decrement(cart.id)" class="btn btn-danger">-</button>
                          <button v-else="" disabled @click="decrement(cart.id)" class="btn btn-danger">-</button>
                        </td>
                        <td>{{ cart.product_price }}</td>
                        <td>{{ cart.sub_total }}</td>
                        <td>
                          <a @click="deleteCart(cart.id)" class="btn btn-sm btn-primary">X</a>
                          </td>
                      </tr>
                    </tbody>
                  </table>
                </div>
                <div class="card-footer">
                  <ul class="list-group">
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                      Total Quantity: <strong>RM {{ totalQuantity }}</strong>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                      Sub total: <strong>RM {{ totalSubPrice }}</strong>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                      {{ taxes.tax_name }}: <strong>{{taxes.tax_amount }}%</strong>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                      Total Amount: <strong>RM {{ totalPrice }}</strong>
                    </li>
                  </ul>
                  <br><br>
                  <form @submit.prevent="orderDone">
                    <div class="form-group">
                      <div class="form-row">
                        <label>Customer Name</label>
                        <select class="form-control" v-model="customer_id">
                          <option v-for="customer in customers" :key="customer.id" :value="customer.id">{{ customer.name }}</option>
                        </select>
                      </div>
                    </div>
                    <div class="form-group">
                      <div class="form-row">
                        <label>Pay</label>
                        <input type="text" class="form-control" required v-model="pay">
                      </div>
                    </div>
                    <div class="form-group">
                      <div class="form-row">
                        <label>Due</label>
                        <input type="text" class="form-control" required v-model="due">
                      </div>
                    </div>
                    <div class="form-group">
                      <div class="form-row">
                        <label>Payment Type</label>
                        <select class="form-control" v-model="payment_type">
                          <option value="cash">Cash</option>
                          <option value="credit">Credit Card</option>
                          <option value="gift">Gift Card</option>
                        </select>
                      </div>
                    </div>
                    <div class="form-group">
                      <div class="form-row">
                        <button class="btn btn-success" type="submit">Pay</button>
                      </div>
                    </div>
                  </form>
                </div>
              </div>
            </div>
            <!-- Pie Chart -->
            <div class="col-xl-7 col-lg-7">
              <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">Products Sold</h6>
                </div>

                <ul class="nav nav-tabs" id="myTab" role="tablist">
                  <li class="nav-item">
                    <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">All Products</a>
                  </li>
                  <li class="nav-item" v-for="category in categories" :key="category.id">
                    <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false" @click="subProduct(category.id)">{{ category.category_name }}</a>
                  </li>
                </ul>
                <div class="tab-content" id="myTabContent">
                  <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                    <div class="card-body">
                      <div class="row" style="margin-bottom: 5px;">
                        <div class="col-1"> 
                        </div>
                        <div class="col-10"> 
                          <input type="text" class="form-control" id="search" placeholder="Search" v-model="searchTerm">
                        </div>
                        <div class="col-1"> 
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-lg-3 col-md-3 col-sm-6 col-6" v-for="product in filtersearch" :key="product.id">  
                          <button class="btn btn-sm" @click.prevent="addToCart(product.id)">
                            <div class="card">
                              <img class="card-img-top" :src="product.image" id="em_photo">
                              <div class="card-body">
                                <h7 class="card-title">{{ product.product_name }}</h7>
                                <span v-if="product.product_quantity >= 1" class="badge badge-success">Available ({{ product.product_quantity }})</span>
                                <span v-else=" " class="badge badge-danger">Stock Out</span>
                              </div>
                            </div>
                          </button>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                    <div class="card-body">
                      <div class="row" style="margin-bottom: 5px;">
                        <div class="col-1"> 
                        </div>
                        <div class="col-10"> 
                          <input type="text" class="form-control" id="search" placeholder="Search" v-model="searchTerm">
                        </div>
                        <div class="col-1"> 
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-lg-3 col-md-3 col-sm-6 col-6" v-for="catproduct in filtersearch2" :key="catproduct.id">  
                          <button class="btn btn-sm" @click.prevent="addToCart(catproduct.id)">
                            <div class="card">
                              <img class="card-img-top" :src="catproduct.image" id="em_photo">
                              <div class="card-body">
                                <h7 class="card-title">{{ catproduct.product_name }}</h7>
                                <span v-if="catproduct.product_quantity >= 1" class="badge badge-success">Available ({{ catproduct.product_quantity }})</span>
                                <span v-else=" " class="badge badge-danger">Stock Out</span>
                              </div>
                            </div>
                          </button>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>

              </div>
            </div>
          </div>
          <!--Row-->

        </div>
        <!---Container Fluid-->
</template>

<script>
  export default {
    created(){
      if(!User.loggedIn()){
        this.$router.push({name: '/'})
      }
    },
    created(){
      this.allProducts();
      this.allCategories();
      this.allCustomers();
      this.showCart();
      Reload.$on('AfterAdd', () => {
        this.showCart();
      });
      this.tax();
    },
    data() {
      return {
        products: [],
        categories: '',
        catproducts: [],
        searchTerm: '',
        customers: [],
        due: '',
        payment_type: '',
        pay: '',
        customer_id: '',
        carts: [],
        taxes: ''
      }
    },
    computed: {
      filtersearch(){
        return this.products.filter(product => {
          return product.product_name.match(this.searchTerm)
        })
      },
      filtersearch2(){
        return this.catproducts.filter(catproduct => {
          return catproduct.product_name.match(this.searchTerm)
        })
      },
      totalQuantity(){
        let sum = 0;
        for(let i = 0; i < this.carts.length; i++){
          sum += (parseFloat(this.carts[i].product_quantity));
        }
        return sum;
      },
      totalSubPrice(){
        let sum = 0;
        for(let i = 0; i < this.carts.length; i++){
          sum += (parseFloat(this.carts[i].sub_total));
        }
        return sum;
      },
      totalPrice(){
        return ((this.totalSubPrice * this.taxes.tax_amount)/ 100) + this.totalSubPrice;
      }
    },
    methods: {
      addToCart(id){
        axios.get('/api/pos/addToCart/'+id)
        .then(() => {
          Reload.$emit('AfterAdd');
          Notification.cart_success()
        })
        .catch()
      },
      showCart(){
        axios.get('/api/pos/showCart')
        .then(({data}) => (this.carts = data))
        .catch()
      },
      allProducts(){
        axios.get('/api/product')
        .then(({data}) => (this.products = data))
        .catch()
      },
      allCategories(){
        axios.get('/api/category')
        .then(({data}) => (this.categories = data))
        .catch()
      },
      allCustomers(){
        axios.get('/api/customer')
        .then(({data}) => (this.customers = data))
        .catch()
      },
      subProduct(id){
        axios.get('/api/product/category/'+id)
        .then(({data}) => (this.catproducts = data))
        .catch()
      },
      tax(){
        axios.get('/api/tax')
        .then(({data}) => (this.taxes = data))
        .catch()
      },
      orderDone(){
        var data = { totalQuantity: this.totalQuantity, totalSubPrice: this.totalSubPrice, 
        customer_id: this.customer_id, payment_type: this.payment_type, pay: this.pay, 
        tax_amount: this.taxes.tax_amount, totalPrice: this.totalPrice, due: this.due};

        axios.post('/api/pos/order', data)
        .then(() => {
          this.$router.push({name: 'home'});
          Notification.success_payment();
        })
      },
      deleteCart(id){
        Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, remove cart!'
      }).then((result) => {
        if (result.isConfirmed) {
          axios.delete('/api/pos/'+id)
          .then(() => {
            this.carts = this.carts.filter(cart => {
              return cart.id != id
            })
          })
          .catch(() => {
            this.$router.push({name: '/pos'})
          })
          Swal.fire(
            'Removed!',
            'Your cart been removed.',
            'success'
          )
        }
      })
      },
      increment(id){
        axios.get('/api/pos/increment/'+id)
        .then(() => {
          Reload.$emit('AfterAdd');
          Notification.cart_success()
        })
        .catch()
      },
      decrement(id){
        axios.get('/api/pos/decrement/'+id)
        .then(() => {
          Reload.$emit('AfterAdd');
          Notification.cart_removed()
        })
        .catch()
      }
    }
  }
  
</script>

<style type="text/css" scoped>
  #em_photo{
    height: 70%;
    width: 90%;
  }

  span{
    font-size: 60%;
  }

  .card .table td, .card .table th{
    padding-right: 0rem;
    padding-left: -1rem;
  }
</style>
