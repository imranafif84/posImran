<template>
    <div class="row justify-content-center">
      <div class="col-xl-12 col-lg-12 col-md-12">
        <div>
          <div class="row">
            <div class="col-lg-3">
              <router-link to="/createExpense" class="btn btn-primary btn-block">Add Expense</router-link>
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
                        <th width="50%">Details</th>
                        <th width="10%">Amount</th>
                        <th width="10%">Date</th>
                        <th width="30%">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr v-for="expense in filtersearch" :key="expense.id">
                        <td>{{ expense.details }}</td>
                        <td>{{ expense.amount }}</td>
                        <td>{{ expense.expense_date }}</td>
                        <td>
                          <router-link :to="{name: 'editExpense', params:{id:expense.id}}" class="btn btn-sm btn-info">Edit</router-link>
                          <a @click="deleteExpense(expense.id)" class="btn btn-sm btn-danger">Delete</a>
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
        expenses: [],
        searchTerm: ''
      }
    },
    computed: {
      filtersearch(){
        return this.expenses.filter(expense => {
          return expense.details.match(this.searchTerm)
        })
      }
    },
    methods: {
      allExpenses(){
        axios.get('/api/expense')
        .then(({data}) => (this.expenses = data))
        .catch()
      },
      deleteExpense(id){
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
          axios.delete('/api/expense/'+id)
          .then(() => {
            this.expenses = this.expenses.filter(expense => {
              return expense.id != id
            })
          })
          .catch(() => {
            this.$router.push({name: 'allExpense'})
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
      this.allExpenses();
    }
  }
  
</script>

<style type="text/css">
  #em_photo{
    height: 40px;
    width: 40px;
  }
</style>
