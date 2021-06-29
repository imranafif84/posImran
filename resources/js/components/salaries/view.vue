<template>
    <div class="row justify-content-center">
      <div class="col-xl-12 col-lg-12 col-md-12">
        <div>
          <div class="row">
            <div class="col-lg-3">
              <router-link to="/allSalary" class="btn btn-primary btn-block">All Salaries</router-link>
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
                        <th>Month</th>
                        <th>Amount</th>
                        <th>Date</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr v-for="salary in filtersearch" :key="salary.id">
                        <td>{{ salary.name }}</td>
                        <td>{{ salary.salary_month }}</td>
                        <td>{{ salary.amount }}</td>
                        <td>{{ salary.salary_date }}</td>
                        <td>
                          <router-link :to="{name: 'editSalary', params:{id:salary.id}}" class="btn btn-sm btn-info">Edit Salary</router-link>
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
        salaries: [],
        searchTerm: ''
      }
    },
    computed: {
      filtersearch(){
        return this.salaries.filter(salary => {
          return salary.name.match(this.searchTerm)
        })
      }
    },
    methods: {
      viewSalaries(){
        let id = this.$route.params.id;
        axios.get('/api/salary/view/'+id)
        .then(({data}) => (this.salaries = data))
        .catch()
      }
    },
    created(){
      this.viewSalaries();
    }
  }
  
</script>

<style type="text/css">

</style>
