<template>
    <div class="row justify-content-center">
      <div class="col-xl-12 col-lg-12 col-md-12">
        <div>
          <div class="row">
            <div class="col-lg-3">
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
                        <th width="50%">Customer Name</th>
                        <th width="10%">Total Amount</th>
                        <th width="5%">Pay</th>
                        <th width="5%">Due</th>
                        <th width="10%">Payment Type</th>
                        <th width="20%">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr v-for="order in filtersearch" :key="order.id">
                        <td>{{ order.name }}</td>
                        <td>{{ order.totalPrice }}</td>
                        <td>{{ order.pay }}</td>
                        <td>{{ order.due }}</td>
                        <td>{{ order.payment_type }}</td>
                        <td>
                          <router-link :to="{name: 'viewOrder', params:{id:order.id}}" class="btn btn-sm btn-info">View</router-link>
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
        orders: [],
        searchTerm: ''
      }
    },
    computed: {
      filtersearch(){
        return this.orders.filter(order => {
          return order.name.match(this.searchTerm)
        })
      }
    },
    methods: {
      allOrders(){
        axios.get('/api/pos/order/todaylist')
        .then(({data}) => (this.orders = data))
        .catch()
      }
    },
    created(){
      this.allOrders();
    }
  }
  
</script>

<style type="text/css">
  #em_photo{
    height: 40px;
    width: 40px;
  }
</style>
