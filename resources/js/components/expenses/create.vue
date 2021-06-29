<template>
    <div class="row justify-content-center">
      <div class="col-xl-12 col-lg-12 col-md-12">
        <div>
          <div class="row">
            <div class="col-lg-3">
              <router-link to="/allEmployee" class="btn btn-primary btn-block">All Expenses</router-link>
            </div>
          </div>
        </div>
        <div class="card shadow-sm my-5">
          <div class="card-body p-0">
            <div class="row">
              <div class="col-lg-12">
                <div class="login-form">
                  <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-4">Add Expense</h1>
                  </div>
                  <form class="user" @submit.prevent="createExpense" enctype="multipart/form-data">
                    <div class="form-group">
                      <div class="form-row">
                        <div class="col-lg-12">
                          <label>Details</label>
                          <textarea class="form-control" id="details" rows="3" v-model="form.details" style="resize:none" ></textarea>
                          <small class="text-danger" v-if="errors.details">{{ errors.details[0] }}</small>
                        </div>
                      </div>
                    </div>
                    <div class="form-group">
                      <div class="form-row">
                        <div class="col-lg-3">
                          <input type="text" class="form-control" id="amount" placeholder="Enter Amount" v-model="form.amount">
                          <small class="text-danger" v-if="errors.amount">{{ errors.amount[0] }}</small>
                        </div>
                      </div>
                    </div>
                    <div class="form-group">
                      <button type="submit" class="btn btn-primary btn-block">Add Expense</button>
                    </div>
                  </form>
                  <hr>
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
        form: {
          details: null, 
          amount: null
        },
        errors: {}
      }
    },
    methods: {
      createExpense(){
        axios.post('/api/expense', this.form)
        .then(() => {
          this.$router.push({name: 'allExpense'});
          Notification.success();
        })
        .catch(error => this.errors = error.response.data.errors)
      }
    }
  }
  
</script>

<style type="text/css">

</style>
