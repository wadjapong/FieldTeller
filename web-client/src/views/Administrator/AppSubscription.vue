<template>
  <div>
      <!-- Exportable Table -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <!-- New user modal -->
                    <div class="modal fade" id="renewPackagesModal" tabindex="-1" role="dialog">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title" id="defaultModalLabel">New Subscriber</h4>
                                </div>
                                <div class="modal-body">
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="email" class="form-control" name="email" required>
                                        <label class="form-label">Email</label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <p>
                                        App
                                    </p>
                                    <select name="user_role" class="form-control show-tick">
                                        <option>-- select app --</option>
                                        <option value="Service Provide">App 1</option>
                                        <option value="Customer">App 2</option>
                                        <option value="System Administrator">App 3</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <p>
                                        Package
                                    </p>
                                    <select name="user_role" class="form-control show-tick">
                                        <option>-- select package --</option>
                                        <option value="Service Provide">Package 1</option>
                                        <option value="Customer">Package 2</option>
                                        <option value="System Administrator">Package 3</option>
                                    </select>
                                </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-danger waves-effect" data-dismiss="modal"><i class="material-icons">cancel</i> CANCEL</button>
                                    <button type="button" class="btn btn-primary waves-effect"><i class="material-icons">save</i> SUBSCRIBE</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end of new user modal -->
                    <!-- <alert-modal :identity="'deleteModal'" :data="recordToDelete" @confirm-delete="deleteRecord"/> -->
                    <div class="card">
                        <div class="header">
                            <h2>
                                Subscriptions
                            </h2>
                            <!-- <button class="btn btn-default waves-effect header-dropdown r-r--5">
                                <i class="material-icons">add_circle</i>
                            </button> -->
                            <ul class="header-dropdown m-r--5">
                                <li class="dropdown">
                                    <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                        <i class="material-icons">more_vert</i>
                                    </a>
                                    <ul class="dropdown-menu pull-right">
                                        <li><a href="javascript:void(0);" data-toggle="modal" data-backdrop="static" data-target="#renewPackagesModal"> <i class="material-icons">add_circle</i> New Subscription</a></li>
                                        <!-- <li><a href="javascript:void(0);">Another action</a></li>
                                        <li><a href="javascript:void(0);">Something else here</a></li> -->
                                    </ul>
                                </li>
                            </ul>
                        </div>
                        <div class="body">
                            <div class="table-responsive">
                                <pager v-if="userSubscriptions.length > 0" :tableData="userSubscriptions" :searchFunction="pagerQueryFunction">
                                    <template v-slot:pagertable="{propdata}">
                                        <table class="table table-striped table-hover">
                                    <thead>
                                        <tr>
                                            <th>Package Name</th>
                                            <th>App</th>
                                            <th>Subscriber's Name</th>
                                            <th>Phone Number</th>
                                            <th>Email</th>
                                            <th>Subscription Date</th>
                                            <th>No. of Days Left</th>
                                            <!-- <th>Actions</th> -->
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>Package Name</th>
                                            <th>App</th>
                                            <th>Subscriber's Name</th>
                                            <th>Phone Number</th>
                                            <th>Email</th>
                                            <th>Subscription Date</th>
                                            <th>No. of Days Left</th>
                                            <!-- <th>Actions</th> -->
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        <tr v-for="(item, i) in propdata" :key="i">
                                            <td>{{item.package_name}}</td>
                                            <td>{{item.app_name}}</td>
                                            <td>{{item.first_name + ' ' + item.last_name}}</td>
                                            <td>{{item.primary_phonenumber}}</td>
                                            <td>{{item.email}}</td>
                                            <td>{{ $moment(item.end_period).subtract(item.subscription_period , 'months').format("lll") }}</td>
                                            <td>{{$moment(item.end_period).fromNow(true)}}</td>
                                            <!-- <td>
                                                <ul style="list-style:none;" class="header-dropdown">
                                                    <li class="dropdown">
                                                        <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                                            <i class="material-icons">more_vert</i>
                                                        </a>
                                                        <ul class="dropdown-menu pull-right">
                                                            <li><a href="javascript:void(0);" data-toggle="modal" data-backdrop="static" data-target="#renewPackagesModal"> <i class="material-icons">mode_edit</i> Renew</a></li>
                                                            <li><a href="javascript:void(0);" data-toggle="modal" data-backdrop="static" data-target="#renewPackagesModal"> <i class="material-icons">remove_red_eye</i> Upgrade</a></li>
                                                            <li><a href="javascript:void(0);" data-toggle="modal" data-backdrop="static" data-target="#alertModal"> <i class="material-icons">delete</i> Unsubscribe</a> </li>
                                                        </ul>
                                                    </li>
                                                </ul>
                                            </td> -->
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
  name: 'appsubscription',
  data () {
    return {
      isEdit: false,
      filterBy: 1,
      pageDetails: {
        name: 'Subscription', description: 'App subscriptions'
      },
      userSubscriptions: [],
      recordToDelete: {}
    }
  },
  mounted () {
    this.$emit('set-page-details', this.pageDetails)
    this.getAllUserSubscriptions()
  },
  methods: {
      pagerQueryFunction (data = [],searchKey='') {
        return data.filter(item => {
            return item.last_name.toLowerCase().includes(searchKey) || 
                    item.first_name.toLowerCase().includes(searchKey) || 
                    item.email.toLowerCase().includes(searchKey) || 
                    item.role.toLowerCase().includes(searchKey) || 
                    item.app_name.toLowerCase().includes(searchKey) || 
                    this.$moment(item.CreatedAt).format('ddd, MMM Do YYYY, h:mm a').toLowerCase().includes(searchKey)
        })
    },
    getAllUserSubscriptions(){
      var _ = this; 
      _.axios.defaults.headers.common['Authorization'] = 'Bearer '+ localStorage.getItem('access_token');
      _.axios.get('api/userssubscription').then((response)=>{
            _.userSubscriptions = response.data;
      }).catch(error=>{
        console.log(error);
      });
    }
  },
  components: {
    AlertModal
  }
}
</script>
