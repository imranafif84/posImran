<template>
    <div class="row justify-content-center">
      <div class="col-xl-12 col-lg-12 col-md-12">
        <div>
          <div class="row">
            <div class="col-lg-3">
              <router-link to="/todayOrder" class="btn btn-primary btn-block">Today Orders</router-link>
            </div>
          </div>
        </div>
        <div class="card shadow-sm my-5">
          <div class="card-body p-0">
            <div class="row">
              <div class="col-lg-12">
                <div class="login-form">
                  <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-4">Order Details</h1>
                  </div>
                  <div class="row">
                    <div class="col-lg-6 mb-4">
                    <!-- Simple Tables -->
                    <div class="card">
                        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Order Information</h6>
                        </div>
                        <div class="table-responsive">
                            <ul class="list-group">
                              <li class="list-group-item"><b>Name: </b> {{ orders.name }}</li>
                              <li class="list-group-item"><b>Phone: </b> {{ orders.phone }}</li>
                              <li class="list-group-item"><b>Address: </b> {{ orders.address }}</li>
                              <li class="list-group-item"><b>Order Date: </b> {{ orders.order_date }}</li>
                              <li class="list-group-item"><b>Payment Type: </b> {{ orders.payment_type }}</li>
                            </ul>
                        </div>
                        <div class="card-footer"></div>
                    </div>
                  </div>
                  <div class="col-lg-6 mb-4">
                    <!-- Simple Tables -->
                    <div class="card">
                        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Extra Information</h6>
                        </div>
                        <div class="table-responsive">
                            <ul class="list-group">
                              <li class="list-group-item"><b>Sub Total (RM): </b> {{ orders.totalSubPrice }}</li>
                              <li class="list-group-item"><b>Tax Amount (%): </b> {{ orders.tax_amount }}</li>
                              <li class="list-group-item"><b>Total (RM): </b> {{ orders.totalPrice }}</li>
                              <li class="list-group-item"><b>Payment Amount (RM): </b> {{ orders.pay }}</li>
                              <li class="list-group-item"><b>Due Amount (RM): </b> {{ orders.due }}</li>
                            </ul>
                        </div>
                        <div class="card-footer"></div>
                    </div>
                  </div>
                  </div>
                    <hr>
                    <div class="row">
                    <div class="col-lg-12 mb-4">
                    <!-- Simple Tables -->
                    <div class="card">
                        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Order Details</h6>
                        </div>
                        <div class="table-responsive">
                        <table class="table align-items-center table-flush">
                            <thead class="thead-light">
                            <tr>
                                <th>Product Name</th>
                                <th>Product Code</th>
                                <th>Image</th>
                                <th>Quantity</th>
                                <th>Unit Price</th>
                                <th>Sub Total</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr v-for="order_detail in order_details" :key="order_detail.id">
                                <td>{{ order_detail.product_name }}</td>
                                <td>{{ order_detail.product_code }}</td>
                                <td><img :src="'/'+order_detail.image" id="em_photo"></td>
                                <td>{{ order_detail.product_quantity }}</td>
                                <td>{{ order_detail.product_price }}</td>
                                <td>{{ order_detail.sub_total }}</td>
                            </tr>
                            </tbody>
                        </table>
                        </div>
                        <div class="card-footer"></div>
                    </div>
                  </div>
                  </div>
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
        errors: {},
        orders: '',
        order_details: {}
      }
    },
    created(){
      this.getOrders();
      this.getOrderDetails();
    },
    methods: {
      getOrders(){
        let id = this.$route.params.id;
        axios.get('/api/pos/order/viewTodayOrder/'+id)
        .then(({data}) => (this.orders = data))
        .catch()
      },
      getOrderDetails(){
        let id = this.$route.params.id;
        axios.get('/api/pos/order/detailTodayOrder/'+id)
        .then(({data}) => (this.order_details = data))
        .catch()
      }
    }
  }
  
</script>

<style type="text/css">

</style>
