<template>
  <div>
      <!-- Exportable Table -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <!-- New user modal -->
                    <div class="modal fade" id="newUserModal" tabindex="-1" role="dialog">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title" id="defaultModalLabel">New User</h4>
                                </div>
                                <div class="modal-body">
                                <div class="form-group form-float">
                                    <div class="form-line" :class="{'focused':(user.first_name + '').length > 0}">
                                        <input type="text" v-model="user.first_name" class="form-control" name="first_name" required>
                                        <label class="form-label">First Name</label>
                                    </div>
                                </div>
                                <div class="form-group form-float">
                                    <div class="form-line" :class="{'focused':(user.first_name + '').length > 0}">
                                        <input type="text" v-model="user.last_name" class="form-control" name="last_name" required>
                                        <label class="form-label">Last Name</label>
                                    </div>
                                </div>
                                <div class="form-group form-float">
                                    <div class="form-line" :class="{'focused':(user.first_name + '').length > 0}">
                                        <input type="text" v-model="user.primary_phonenumber" class="form-control" name="phone_number">
                                        <label class="form-label">Phone Number</label>
                                    </div>
                                </div>
                                <div class="form-group form-float">
                                    <div class="form-line" :class="{'focused':(user.first_name + '').length > 0}">
                                        <input type="email" v-model="user.email" class="form-control" name="email" required>
                                        <label class="form-label">Email</label>
                                    </div>
                                </div>
                                <!-- <div class="form-group">
                                    <p>
                                        Gender
                                    </p>
                                    <input type="radio" v-model="user.gender" name="gender" value="male" id="male" class="with-gap">
                                    <label for="male">Male</label>

                                    <input type="radio" v-model="user.gender" name="gender" value="female" id="female" class="with-gap">
                                    <label for="female" class="m-l-20">Female</label>
                                </div> -->
                                
                                <!-- <div class="form-group">
                                    <p>
                                        Role: <b>{{user.role}}</b>
                                    </p>
                                    <select v-model="user.role" name="user_role" class="form-control show-tick">
                                        <option disabled>-- select role --</option>
                                        <option value="Service Provide">Service Provider</option>
                                        <option value="Customer">Customer</option>
                                        <option value="Administrator">Administrator</option>
                                    </select>
                                </div> -->
                                <!-- <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="password" class="form-control" name="password" required>
                                        <label class="form-label">Password</label>
                                    </div>
                                </div> -->
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-danger waves-effect" data-dismiss="modal"><i class="material-icons">cancel</i> CLOSE</button>
                                    <button type="button" v-if="isEdit" @click="updateUser" class="btn btn-success waves-effect"><i class="material-icons">save</i> Update</button>
                                    <button type="button" v-else @click="saveUser" class="btn btn-primary waves-effect"><i class="material-icons">save</i> Save</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end of new user modal -->
                    <alert-modal :identity="'deleteModal'" :data="recordToDelete" @confirm-delete="deleteRecord"/>

                    <div class="card">
                        <div class="header">
                            <h2>
                                Users
                            </h2>
                            <!-- <button class="btn btn-default waves-effect header-dropdown r-r--5">
                                <i class="material-icons">add_circle</i>
                            </button> -->
                            <div class="form-inline">
                                    <select @change="filterData($event.target.value)" v-model="filterBy" name="user_role" class="form-control show-tick">
                                        <option disabled>-- Filter data --</option>
                                        <option value="1">Active Users</option>
                                        <option value="2">Terminated Users</option>
                                        <option value="3">Both</option>
                                    </select>
                                </div>
                            <ul class="header-dropdown m-r--5">
                                <li class="dropdown">
                                    <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                        <i class="material-icons">more_vert</i>
                                    </a>
                                    <ul class="dropdown-menu pull-right">
                                        <li><a href="javascript:void(0);" data-toggle="modal" data-backdrop="static" data-target="#newUserModal"> <i class="material-icons">add_circle</i> New User</a></li>
                                        <!-- <li><a href="javascript:void(0);">Another action</a></li>
                                        <li><a href="javascript:void(0);">Something else here</a></li> -->
                                    </ul>
                                </li>
                            </ul>
                        </div>
                        <div class="body">
                            <div class="table-responsive">
                                <pager v-if="users.length > 0" :tableData="users" :searchFunction="pagerQueryFunction">
                                    <template v-slot:pagertable="{propdata}">
                                        <table class="table table-striped table-hover">
                                            <thead>
                                                <tr>
                                                    <!-- <th>Picture</th> -->
                                                    <th>Name</th>
                                                    <!-- <th>Gender</th> -->
                                                    <th>Email</th>
                                                    <th>Phone Number</th>
                                                    <!-- <th>Role</th> -->
                                                    <th>Registration Date</th>
                                                    <th>Actions</th>
                                                </tr>
                                            </thead>
                                            <tfoot>
                                                <tr>
                                                    <!-- <th>Picture</th> -->
                                                    <th>Name</th>
                                                    <!-- <th>Gender</th> -->
                                                    <th>Email</th>
                                                    <th>Phone Number</th>
                                                    <!-- <th>Role</th> -->
                                                    <th>Registration Date</th>
                                                    <th>Actions</th>
                                                </tr>
                                            </tfoot>
                                            <tbody>
                                                <tr v-for="(item, i) in propdata" :key="i">
                                                    <!-- <td><img :src="$store.getters.getStoragePath+'noimage.png'" style="width: 45px; height: auto;"></td> -->
                                                    <td>
                                                        <label v-if="user.is_blocked ==1" class="label label-danger">
                                                            {{item.first_name + ' ' + item.last_name}}
                                                        </label>
                                                        <span v-else>
                                                            {{item.first_name + ' ' + item.last_name}}
                                                        </span>
                                                        </td>
                                                    <!-- <td>{{item.gender}}</td> -->
                                                    <td>{{item.email}}</td>
                                                    <td>{{item.primary_phonenumber}}</td>
                                                    <!-- <td>{{item.role}}</td> -->
                                                    <td>{{item.created_at |  moment("ddd, MMM Do YYYY")}}</td>
                                                    <td>
                                                        <ul style="list-style:none;" class="header-dropdown">
                                                            <li class="dropdown" v-if="authUser.id !== item.id">
                                                                <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                                                    <i class="material-icons">more_vert</i>
                                                                </a>
                                                                <ul class="dropdown-menu pull-right">
                                                                    <li><a data-toggle="modal" data-target="#newUserModal" @click="switchToEditMode(item)"> <i class="material-icons">mode_edit</i> Edit</a></li>
                                                                    <li><a v-if="item.role !='Administrator'" data-toggle="modal" data-target="#newUserModal"> <i class="material-icons">remove_red_eye</i> Other details</a></li>
                                                                    <li><a v-if="!item.is_blocked" @click="blockAccount(item)"> <i class="material-icons" >lock_outline</i> Lock Account</a></li>
                                                                    <li><a v-if="item.is_blocked" @click="unblockAccount(item)"> <i class="material-icons" >lock_open</i> Unlock Account</a></li>
                                                                    <li><a v-if="item.deleted_at == null" @click="terminateUser(item)"> <i class="material-icons" >delete</i> Terminate</a> </li>
                                                                    <li><a v-if="item.deleted_at != null" @click="restoreUser(item)"> <i class="material-icons" >refresh</i> restore</a> </li>
                                                                    <li><a data-toggle="modal" data-target="#deleteModal" @click="recordToDelete = item"> <i class="material-icons" >delete</i> Delete</a> </li>
                                                                </ul>
                                                            </li>
                                                        </ul>
                                                    </td>
                                                </tr>
                                                
                                            </tbody>
                                        </table>
                                    </template>
                                </pager>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- #END# Exportable Table -->
   </div>
</template>

<script>
import AlertModal from '@/components/AlertModal'
export default {
  name: 'users',
  data () {
    return {
      isEdit: false,
      filterBy: 1,
      pageDetails: {
        name: 'Users', description: 'User management'
      },
      user: {
          password:'',
          password_confirmation:''
      },
      users: [],
      recordToDelete: {},
      authUser: {}
    }
  },
  mounted () {
    this.$emit('set-page-details', this.pageDetails)
    this.getAllUsers()
    if (localStorage.getItem('setUserDetails')) {
          this.authUser = JSON.parse(localStorage.getItem('setUserDetails'))
      }
  },
  methods: {
      pagerQueryFunction (data = [],searchKey='') {
        return data.filter(item => {
            return item.last_name.toLowerCase().includes(searchKey) || 
                    item.first_name.toLowerCase().includes(searchKey) || 
                    item.email.toLowerCase().includes(searchKey) || 
                    item.role.toLowerCase().includes(searchKey) || 
                    this.$moment(item.CreatedAt).format('ddd, MMM Do YYYY, h:mm a').toLowerCase().includes(searchKey)
        })
    },
    switchToEditMode(data) {
        data = JSON.stringify(data)  
        this.user = JSON.parse(data)
        this.recordToDelete = JSON.parse(data)
        this.isEdit=true
    },
    getAllUsers(){
      var _ = this; 
      _.axios.defaults.headers.common['Authorization'] = 'Bearer '+ localStorage.getItem('access_token');
      _.axios.get('api/activeusers/Administrator').then((response)=>{
            _.users = response.data;
      }).catch(error=>{
        console.log(error);
      });
    },
    filterData(code){
      var route = 'api/activeusers/Administrator'
      var _ = this; 
      if (parseInt(code) == 1){
          route = 'api/activeusers/Administrator'
      }else if (parseInt(code) == 2){
          route = 'api/terminatedusers/Administrator'
      }else if (parseInt(code) == 3){
          route = 'api/bothusers/Administrator'
      }

      _.axios.defaults.headers.common['Authorization'] = 'Bearer '+ localStorage.getItem('access_token');
      _.axios.get(route).then((response)=>{
            _.users = response.data;
      }).catch(error=>{
        console.log(error);
      });
    },
    saveUser(){
      var _ = this;
      var generated_password = Math.random().toString(36).slice(-8);
      this.user.role = 'Administrator';
      this.user.password = generated_password
      this.axios.defaults.headers.common['Authorization'] = 'Bearer '+ localStorage.getItem('access_token')
      this.axios.post('api/useralltype',this.user).
      then(response=>{
        _.users.push(response.data)
        _.$toasted.show('Record saved successfully', {
          duration: 2000
        });
        // eslint-disable-next-line no-undef
          $('#newUserModal').modal('hide')
        _.clearControls();
        console.log(generated_password)
      }).catch(e=>{
        console.log(e);
      });
    },
    updateUser(){
      var _ = this;
      this.axios.defaults.headers.common['Authorization'] = 'Bearer '+ localStorage.getItem('access_token')
      this.axios.put('api/useralltype/'+ this.user.id,this.user).
      then(response=>{
       _.getAllUsers()
        _.$toasted.show('Record updated successfully', {
          duration: 2000
        });
        _.clearControls();
        // eslint-disable-next-line no-undef
          $('#newUserModal').modal('hide')
      }).catch(e=>{
        console.log(e);
      });
    },
    clearControls() {
      this.user = {
        first_name:'',
        last_name:'',
        is_blocked: false,
        email:'',
        role:'',
        gender: '',
        picture: '',
        primary_phonenumber: ''
      }
      this.image = ''
      this.isEdit = false
    },
    blockAccount(data){
      var _ = this;
      _.axios.defaults.headers.common['Authorization'] = 'Bearer '+ localStorage.getItem('access_token')
      _.axios.patch('api/blockaccount/'+data.id).then((response)=>{
            _.recordToDelete = response.data;
            _.$toasted.show('Account blocked successfully.', {
                duration: 2000
            })
            _.getAllUsers()
           // _.users.splice(_.users.indexOf(data), 1)
            // eslint-disable-next-line no-undef
          $('#deleteModal').modal('hide')
      });
    },
    unblockAccount(data){
      var _ = this;
      _.axios.defaults.headers.common['Authorization'] = 'Bearer '+ localStorage.getItem('access_token')
      _.axios.patch('api/unblockaccount/'+data.id).then((response)=>{
            _.recordToDelete = response.data;
            _.$toasted.show('Account unblocked successfully.', {
                duration: 2000
            })
            _.getAllUsers()
            //_.users.splice(_.users.indexOf(data), 1)
            // eslint-disable-next-line no-undef
          $('#deleteModal').modal('hide')
      });
    },
    terminateUser(data){
      var _ = this;
      _.axios.defaults.headers.common['Authorization'] = 'Bearer '+ localStorage.getItem('access_token')
      _.axios.delete('api/terminateuser/'+data.id).then((response)=>{
            _.recordToDelete = response.data;
            _.$toasted.show('User terminated successfully.', {
                duration: 2000
            })
            _.users.splice(_.users.indexOf(data), 1)
            // eslint-disable-next-line no-undef
          $('#deleteModal').modal('hide')
      });
    },
    restoreUser(data){
      var _ = this;
      _.axios.defaults.headers.common['Authorization'] = 'Bearer '+ localStorage.getItem('access_token')
      _.axios.patch('api/restoreuser/'+data.id).then((response)=>{
            _.recordToDelete = response.data;
            _.$toasted.show('User restored successfully.', {
                duration: 2000
            })
             _.getAllUsers()
             _.filterBy = 1
            //_.users.splice(_.users.indexOf(data), 1)
            // eslint-disable-next-line no-undef
          $('#deleteModal').modal('hide')
      });
    },
    deleteRecord(data){
      var _ = this;
      _.axios.defaults.headers.common['Authorization'] = 'Bearer '+ localStorage.getItem('access_token')
      _.axios.delete('api/user/'+data.id).then((response)=>{
            _.recordToDelete = response.data;
            _.$toasted.show('Data deleted successfully.', {
                duration: 2000
            })
            //  _.filterBy = 1
            _.users.splice(_.users.indexOf(data), 1)
            // eslint-disable-next-line no-undef
          $('#deleteModal').modal('hide')
      });
    }
  },
  components: {
    AlertModal
  }
}
</script>
<style scoped>
    .blocked {
        color: red!important;
    }
</style>
