<template>
    <div class="row justify-content-center">
      <div class="col-xl-12 col-lg-12 col-md-12">
        <div>
          <div class="row">
            <div class="col-lg-3">
              <router-link to="/allEmpSalary" class="btn btn-primary btn-block">Pay Salary</router-link>
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
                        <th>Month Name</th>
                        <th>Details</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr v-for="salary in filtersearch" :key="salary.id">
                        <td>{{ salary.salary_month }}</td>
                        <td>
                          <router-link :to="{name: 'viewSalary', params:{id:salary.salary_month}}" class="btn btn-sm btn-info">View Salary</router-link>
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
          return salary.salary_month.match(this.searchTerm)
        })
      }
    },
    methods: {
      allSalaries(){
        axios.get('/api/salary')
        .then(({data}) => (this.salaries = data))
        .catch()
      }
    },
    created(){
      this.allSalaries();
    }
  }
  
</script>

<style type="text/css">
  #em_photo{
    height: 40px;
    width: 40px;
  }
</style>
