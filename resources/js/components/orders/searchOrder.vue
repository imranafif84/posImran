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
                    <h1 class="h4 text-gray-900 mb-4">Add Category</h1>
                  </div>
                  <form class="user" @submit.prevent="searchDate">
                    <div class="form-group">
                      <div class="form-row">
                        <div class="col-lg-12">
                          <label for="date">Search By Date</label>
                          <input type="date" class="form-control" id="date" v-model="date" required>
                          <small class="text-danger" v-if="errors.date">{{ errors.date[0] }}</small>
                        </div>
                      </div>
                    </div>
                    <div class="form-group">
                      <button type="submit" class="btn btn-primary btn-block">Search</button>
                    </div>
                  </form>
                  <hr>
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
                                <th>Name</th>
                                <th>Quantity</th>
                                <th>Sub Total</th>
                                <th>Tax</th>
                                <th>Total</th>
                                <th>Pay</th>
                                <th>Due</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr v-for="order in orders" :key="order.id">
                                <td>{{ order.name }}</td>
                                <td>{{ order.totalQuantity }}</td>
                                <td>{{ order.totalSubPrice }}</td>
                                <td>{{ order.tax_amount }}</td>
                                <td>{{ order.totalPrice }}</td>
                                <td>{{ order.pay }}</td>
                                <td>{{ order.due }}</td>
                            </tr>
                            </tbody>
                        </table>
                        </div>
                        <div class="card-footer"></div>
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
        date: '',
        orders: {},
        errors: {}
      }
    },
    methods: {
      searchDate(){
        var data = {date: this.date}
        axios.post('/api/pos/search', data)
        .then(({data}) => (this.orders = data))
        .catch(error => this.errors = error.response.data.errors)
      }
    }
  }
  
</script>

<style type="text/css">

</style>
