<template>
    <div class="row justify-content-center">
      <div class="col-xl-12 col-lg-12 col-md-12">
        <div>
          <div class="row">
            <div class="col-lg-3">
              <router-link to="/createCategory" class="btn btn-primary btn-block">Add Category</router-link>
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
                        <th width="70%">Name</th>
                        <th width="30%">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr v-for="category in filtersearch" :key="category.id">
                        <td>{{ category.category_name }}</td>
                        <td>
                          <router-link :to="{name: 'editCategory', params:{id:category.id}}" class="btn btn-sm btn-info">Edit</router-link>
                          <a @click="deleteCategory(category.id)" class="btn btn-sm btn-danger">Delete</a>
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
        categories: [],
        searchTerm: ''
      }
    },
    computed: {
      filtersearch(){
        return this.categories.filter(category => {
          return category.category_name.match(this.searchTerm)
        })
      }
    },
    methods: {
      allCategories(){
        axios.get('/api/category')
        .then(({data}) => (this.categories = data))
        .catch()
      },
      deleteCategory(id){
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
          axios.delete('/api/category/'+id)
          .then(() => {
            this.categories = this.categories.filter(category => {
              return category.id != id
            })
          })
          .catch(() => {
            this.$router.push({name: 'allCategory'})
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
      this.allCategories();
    }
  }
  
</script>

<style type="text/css">
  #em_photo{
    height: 40px;
    width: 40px;
  }
</style>
