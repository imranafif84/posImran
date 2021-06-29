<template>
    <div class="row justify-content-center">
      <div class="col-xl-12 col-lg-12 col-md-12">
        <div>
          <div class="row">
            <div class="col-lg-3">
              <router-link to="/createSupplier" class="btn btn-primary btn-block">Add Supplier</router-link>
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
                        <th>Shop Name</th>
                        <th>E-Mail</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr v-for="supplier in filtersearch" :key="supplier.id">
                        <td>{{ supplier.name }}</td>
                        <td><img :src="supplier.photo" id="em_photo"></td>
                        <td>{{ supplier.phone }}</td>
                        <td>{{ supplier.shopname }}</td>
                        <td>{{ supplier.email }}</td>
                        <td>
                          <router-link :to="{name: 'editSupplier', params:{id:supplier.id}}" class="btn btn-sm btn-info">Edit</router-link>
                          <a @click="deleteSupplier(supplier.id)" class="btn btn-sm btn-danger">Delete</a>
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
        suppliers: [],
        searchTerm: ''
      }
    },
    computed: {
      filtersearch(){
        return this.suppliers.filter(supplier => {
          return supplier.phone.match(this.searchTerm)
        })
      }
    },
    methods: {
      allSuppliers(){
        axios.get('/api/supplier')
        .then(({data}) => (this.suppliers = data))
        .catch()
      },
      deleteSupplier(id){
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
          axios.delete('/api/supplier/'+id)
          .then(() => {
            this.suppliers = this.suppliers.filter(supplier => {
              return supplier.id != id
            })
          })
          .catch(() => {
            this.$router.push({name: 'allSupplier'})
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
      this.allSuppliers();
    }
  }
  
</script>

<style type="text/css">
  #em_photo{
    height: 40px;
    width: 40px;
  }
</style>
