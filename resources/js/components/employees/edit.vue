<template>
    <div class="row justify-content-center">
      <div class="col-xl-12 col-lg-12 col-md-12">
        <div>
          <div class="row">
            <div class="col-lg-3">
              <router-link to="/allEmployee" class="btn btn-primary btn-block">All Employees</router-link>
            </div>
          </div>
        </div>
        <div class="card shadow-sm my-5">
          <div class="card-body p-0">
            <div class="row">
              <div class="col-lg-12">
                <div class="login-form">
                  <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-4">Edit Employee</h1>
                  </div>
                  <form class="user" @submit.prevent="editEmployee" enctype="multipart/form-data">
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
                          <input type="text" class="form-control" id="address" placeholder="Enter Address Number" v-model="form.address">
                          <small class="text-danger" v-if="errors.address">{{ errors.address[0] }}</small>
                        </div>
                        <div class="col-lg-6">
                          <input type="text" class="form-control" id="salary" placeholder="Enter Salary" v-model="form.salary">
                          <small class="text-danger" v-if="errors.salary">{{ errors.salary[0] }}</small>
                        </div>
                      </div>
                    </div>
                    <div class="form-group">
                      <div class="form-row">
                        <div class="col-lg-6">
                          <input type="date" class="form-control" id="date_joining" placeholder="Enter Date Joined" v-model="form.date_joining">
                          <small class="text-danger" v-if="errors.date_joining">{{ errors.date_joining[0] }}</small>
                        </div>
                        <div class="col-lg-6">
                          <input type="text" class="form-control" id="nid" placeholder="Enter NID" v-model="form.nid">
                          <small class="text-danger" v-if="errors.nid">{{ errors.nid[0] }}</small>
                        </div>
                      </div>
                    </div>
                    <div class="form-group">
                      <div class="form-row">
                        <div class="col-lg-6">
                          <input type="text" class="form-control" id="phone" placeholder="Enter Phone Number" v-model="form.phone">
                          <small class="text-danger" v-if="errors.phone">{{ errors.phone[0] }}</small>
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
                      <button type="submit" class="btn btn-primary btn-block">Update Employee</button>
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
          name: '', 
          email: '', 
          address: '',
          salary: '',
          date_joining: '',
          nid: '',
          phone: '',
          photo: '',
          newphoto: ''
        },
        errors: {}
      }
    },
    created(){
      let id = this.$route.params.id;
      axios.get('/api/employee/'+id)
      .then(({data}) => (this.form = data))
      .catch(console.log('error'))
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
            this.form.newphoto = event.target.result;
          }
          reader.readAsDataURL(file);
        }
      },
      editEmployee(){
        let id = this.$route.params.id;
        axios.patch('/api/employee/'+id, this.form)
        .then(() => {
          this.$router.push({name: 'allEmployee'});
          Notification.success();
        })
        .catch(error => this.errors = error.response.data.errors)
      }
    }
  }
  
</script>

<style type="text/css">

</style>
