<template>
    <div class="row justify-content-center">
      <div class="col-xl-12 col-lg-12 col-md-12">
        <div>
          <div class="row">
            <div class="col-lg-3">
              <router-link to="/createCustomer" class="btn btn-primary btn-block">Add Customer</router-link>
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
                        <th>Name</th>
                        <th>Photo</th>
                        <th>Phone</th>
                        <th>E-mail</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr v-for="customer in filtersearch" :key="customer.id">
                        <td>{{ customer.name }}</td>
                        <td><img :src="customer.photo" id="em_photo"></td>
                        <td>{{ customer.phone }}</td>
                        <td>{{ customer.email }}</td>
                        <td>
                          <router-link :to="{name: 'editCustomer', params:{id:customer.id}}" class="btn btn-sm btn-info">Edit</router-link>
                          <a @click="deleteCustomer(customer.id)" class="btn btn-sm btn-danger">Delete</a>
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
        customers: [],
        searchTerm: ''
      }
    },
    computed: {
      filtersearch(){
        return this.customers.filter(customer => {
          return customer.email.match(this.searchTerm)
        })
      }
    },
    methods: {
      allCustomers(){
        axios.get('/api/customer')
        .then(({data}) => (this.customers = data))
        .catch()
      },
      deleteCustomer(id){
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
          axios.delete('/api/customer/'+id)
          .then(() => {
            this.customers = this.customers.filter(customer => {
              return customer.id != id
            })
          })
          .catch(() => {
            this.$router.push({name: 'allCustomer'})
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
      this.allCustomers();
    }
  }
  
</script>

<style type="text/css">
  #em_photo{
    height: 40px;
    width: 40px;
  }
</style>
