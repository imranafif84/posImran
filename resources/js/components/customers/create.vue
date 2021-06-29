<template>
    <div class="row justify-content-center">
      <div class="col-xl-12 col-lg-12 col-md-12">
        <div>
          <div class="row">
            <div class="col-lg-3">
              <router-link to="/allCustomer" class="btn btn-primary btn-block">All Customers</router-link>
            </div>
          </div>
        </div>
        <div class="card shadow-sm my-5">
          <div class="card-body p-0">
            <div class="row">
              <div class="col-lg-12">
                <div class="login-form">
                  <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-4">Add Customer</h1>
                  </div>
                  <form class="user" @submit.prevent="createCustomer" enctype="multipart/form-data">
                    <div class="form-group">
                      <div class="form-row">
                        <div class="col-lg-6">
                          <input type="text" class="form-control" id="name" placeholder="Enter Full Name" v-model="form.name">
                          <small class="text-danger" v-if="errors.name">{{ errors.name[0] }}</small>
                        </div>
                        <div class="col-lg-6">
                          <input type="email" class="form-control" id="email" aria-describedby="emailHelp" placeholder="Enter Email Address" v-model="form.email">
                          <small class="text-danger" v-if="errors.email">{{ errors.email[0] }}</small>
                        </div>
                      </div>
                    </div>
                    <div class="form-group">
                      <div class="form-row">
                        <div class="col-lg-6">
                          <input type="text" class="form-control" id="phone" placeholder="Enter Phone" v-model="form.phone">
                          <small class="text-danger" v-if="errors.phone">{{ errors.phone[0] }}</small>
                        </div>
                        <div class="col-lg-6">
                          <input type="text" class="form-control" id="address" placeholder="Enter Address Number" v-model="form.address">
                          <small class="text-danger" v-if="errors.address">{{ errors.address[0] }}</small>
                        </div>
                      </div>
                    </div>
                    <div class="form-group">
                      <div class="form-row">
                        <div class="col-lg-6">
                          <input type="file" class="custom-file-input" id="customFile" @change="onFileSelected">
                          <label class="custom-file-label" for="customFile">Choose file</label>
                          <small class="text-danger" v-if="errors.photo">{{ errors.photo[0] }}</small>
                        </div>
                        <div class="col-lg-6">
                          <img :src="form.photo" style="height: 40px; width: 40px;">
                        </div>
                      </div>
                    </div>
                    <div class="form-group">
                      <button type="submit" class="btn btn-primary btn-block">Add Customer</button>
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
          name: null, 
          email: null, 
          phone: null,
          address: null,
          photo: null
        },
        errors: {}
      }
    },
    methods: {
      onFileSelected(event){
        let file = event.target.files[0];
        if(file.size > 1048770){
          Notification.image_validation();
        }
        else{
          let reader = new FileReader();
          reader.onload = event => {
            this.form.photo = event.target.result;
            console.log(event.target.result);
          }
          reader.readAsDataURL(file);
        }
      },
      createCustomer(){
        axios.post('/api/customer', this.form)
        .then(() => {
          this.$router.push({name: 'allCustomer'});
          Notification.success();
        })
        .catch(error => this.errors = error.response.data.errors)
      }
    }
  }
  
</script>

<style type="text/css">

</style>
