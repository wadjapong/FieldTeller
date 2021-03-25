<template>
  <div>
    <!-- Exportable Table -->
    <div class="row clearfix">
      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <!-- New user modal -->
        <div class="modal fade" id="createModal" tabindex="-1" role="dialog">
          <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
              <div class="modal-body">
                <div class="row">
                  <div class="col-md-4 border-right">
                    <h4>Transfer Float</h4>
                    <div class="card-body py-3 px-3">
                      <div class="row clearfix">
                        <div class="col-sm-12">
                          <div class="form-group">
                            <b>From Distributor Phone</b>
                            <div class="form-line">
                              <input type="text" class="form-control" />
                            </div>
                          </div>
                        </div>
                        <div class="col-sm-12">
                          <div class="form-group">
                            <b>To Distributor Phone</b>
                            <div class="form-line">
                              <input type="text" class="form-control" />
                            </div>
                          </div>
                        </div>
                        <div class="col-sm-12">
                          <div class="form-group">
                            <b>Transaction Amount</b>
                            <div class="form-line">
                              <input type="text" class="form-control" />
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-8"></div>
                </div>
              </div>
              <div class="modal-footer">
                <button
                  type="button"
                  class="btn btn-success waves-effect pull-left"
                >
                  <i class="material-icons">send</i> <span>Transfer</span>
                </button>
                <button
                  type="button"
                  class="btn btn-danger waves-effect"
                  data-dismiss="modal"
                >
                  <i class="material-icons">cancel</i> <span>CLOSE</span>
                </button>
              </div>
            </div>
          </div>
        </div>
        <!-- end of new user modal -->
        <!-- <alert-modal :identity="'deleteModal'" :data="recordToDelete" @confirm-delete="deleteRecord"/> -->

        <div class="row clearfix">
          <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
              <div class="header">
                <div class="row">
                  <div class="col-sm-3">
                    <div class="form-group mb-0">
                      <b>From Date</b>
                      <div class="form-line">
                        <input type="date" class="form-control" name="" id="" />
                      </div>
                    </div>
                  </div>
                  <div class="col-sm-3">
                    <div class="form-group mb-0">
                      <b>To Date</b>
                      <div class="form-line">
                        <input type="date" class="form-control" name="" id="" />
                      </div>
                    </div>
                  </div>
                  <div class="col-sm-3">
                    <div class="form-group mb-0">
                      <b>Distributor</b>
                      <div class="form-line">
                        <select class="form-control show-tick">
                          <option value="">-- Select Distributor --</option>
                          <option value="10">10</option>
                        </select>
                      </div>
                    </div>
                  </div>
                  <div class="col-sm-3">
                    <button
                      type="button"
                      class="btn btn-primary waves-effect"
                    >
                      <i class="material-icons">search</i>
                      <span>Search</span>
                    </button>
                  </div>
                </div>
              </div>
              <div class="body table-responsive">
                <table class="table">
                  <thead>
                    <tr>
                      <th>Transaction Reference</th>
                      <th>Transaction Amount</th>
                      <th>Transaction Type</th>
                      <th>Transaction Details</th>
                      <th>Balance Before</th>
                      <th>Balance After</th>
                      <th>Transaction Date &amp; Time</th>
                      <th>Transaction Status</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td>Mark Otto</td>
                      <td>@mdo</td>
                      <td>@mdo</td>
                      <td>@mdo</td>
                      <td>@mdo</td>
                      <td>@mdo</td>
                      <td>@mdo</td>
                      <td>
                        <div class="badge bg-green">Successful</div>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- #END# Exportable Table -->
  </div>
</template>

<script>
// import AlertModal from '@/components/AlertModal'
export default {
  name: "distributortransactions",
  props: {
    userGroup: String,
  },
  data() {
    return {
      isEdit: false,
      filterBy: 1,
      pageDetails: {
        name: "Customer Orders",
        description: "Manage customer orders",
      },
      user: {
        password: "",
        password_confirmation: "",
      },
      orders: [],
      recordToDelete: {},
      orderDetails: {},
      selectedOrder: {},
      customer: {},
    };
  },
  mounted() {
    // this.$emit("set-page-details", this.pageDetails);
    // this.getAllOrders();
  },
  methods: {
    pagerQueryFunction(data = [], searchKey = "") {
      return data.filter((item) => {
        return (
          item.order_reference.toLowerCase().includes(searchKey) ||
          item.order_state.toLowerCase().includes(searchKey) ||
          item.delivery_method.toLowerCase().includes(searchKey) ||
          this.$moment(item.created_at)
            .format("ddd, MMM Do YYYY, h:mm a")
            .toLowerCase()
            .includes(searchKey)
        );
      });
    },
    viewOrderDetails(data) {
      data = JSON.stringify(data);
      this.order = JSON.parse(data);
      this.recordToDelete = JSON.parse(data);
      this.isEdit = true;
    },
    getAllOrders() {
      var _ = this;
      _.axios.defaults.headers.common["Authorization"] =
        "Bearer " + localStorage.getItem("access_token");
      _.axios
        .get("api/orders")
        .then((response) => {
          _.orders = response.data;
        })
        .catch((e) => {
          /* eslint-disable no-console */
          console.log(e);
          /* eslint-enable no-console */
        });
    },
    getOrderDetails(id) {
      var _ = this;
      _.axios.defaults.headers.common["Authorization"] =
        "Bearer " + localStorage.getItem("access_token");
      _.axios
        .get("api/orderdetails/adminonly/" + id)
        .then((response) => {
          _.orderDetails = response.data;
        })
        .catch((e) => {
          /* eslint-disable no-console */
          console.log(e);
          /* eslint-enable no-console */
        });
    },
    changeOrderState(state) {
      var _ = this;
      var id = _.selectedOrder.id;
      _.selectedOrder.order_state = state;
      _.axios.defaults.headers.common["Authorization"] =
        "Bearer " + localStorage.getItem("access_token");
      _.axios
        .put("api/order/adminonly/" + id, _.selectedOrder)
        .then(() => {
          _.$toasted.show("Status changed", {
            duration: 3000,
          });
          _.getAllOrders();
        })
        .catch((e) => {
          /* eslint-disable no-console */
          console.log(e);
          /* eslint-enable no-console */
        });
    },
    // filterData(code){
    //   var route = 'api/activeusers/Customer'
    //   var _ = this;
    //   if (parseInt(code) == 1){
    //       route = 'api/activeusers/Customer'
    //   }else if (parseInt(code) == 2){
    //       route = 'api/terminatedusers/Customer'
    //   }else if (parseInt(code) == 3){
    //       route = 'api/bothusers/Customer'
    //   }

    //   _.axios.defaults.headers.common['Authorization'] = 'Bearer '+ localStorage.getItem('access_token');
    //   _.axios.get(route).then((response)=>{
    //         _.users = response.data;
    //   }).catch(e=>{
    //       /* eslint-disable no-console */
    //       console.log(e);
    //       /* eslint-enable no-console */
    //   });
    // },
    // saveUser(){
    //   var _ = this;
    //   var generated_password = Math.random().toString(36).slice(-8);
    //   this.user.role = 'Administrator';
    //   this.user.password = generated_password
    //   this.axios.defaults.headers.common['Authorization'] = 'Bearer '+ localStorage.getItem('access_token')
    //   this.axios.post('api/useralltype',this.user).
    //   then(response=>{
    //     _.users.push(response.data)
    //     _.$toasted.show('Record saved successfully', {
    //       duration: 2000
    //     });
    //     // eslint-disable-next-line no-undef
    //       $('#newUserModal').modal('hide')
    //     _.clearControls();
    //     console.log(generated_password)
    //   }).catch(e=>{
    //     console.log(e);
    //   });
    // },
    // updateUser(){
    //   var _ = this;
    //   this.axios.defaults.headers.common['Authorization'] = 'Bearer '+ localStorage.getItem('access_token')
    //   this.axios.put('api/useralltype/'+ this.user.id,this.user).
    //   then(response=>{
    //    _.getAllUsers()
    //     _.$toasted.show('Record updated successfully', {
    //       duration: 2000
    //     });
    //     _.clearControls();
    //     // eslint-disable-next-line no-undef
    //       $('#newUserModal').modal('hide')
    //   }).catch(e=>{
    //     console.log(e);
    //   });
    // },
    // clearControls() {
    //   this.user = {
    //     first_name:'',
    //     last_name:'',
    //     is_blocked: false,
    //     email:'',
    //     role:'',
    //     gender: '',
    //     picture: '',
    //     primary_phonenumber: ''
    //   }
    //   this.image = ''
    //   this.isEdit = false
    // },
    // blockAccount(data){
    //   var _ = this;
    //   _.axios.defaults.headers.common['Authorization'] = 'Bearer '+ localStorage.getItem('access_token')
    //   _.axios.patch('api/blockaccount/'+data.id).then((response)=>{
    //         _.recordToDelete = response.data;
    //         _.$toasted.show('Account blocked successfully.', {
    //             duration: 2000
    //         })
    //         _.getAllUsers()
    //        // _.users.splice(_.users.indexOf(data), 1)
    //         // eslint-disable-next-line no-undef
    //       $('#deleteModal').modal('hide')
    //   });
    // },
    // unblockAccount(data){
    //   var _ = this;
    //   _.axios.defaults.headers.common['Authorization'] = 'Bearer '+ localStorage.getItem('access_token')
    //   _.axios.patch('api/unblockaccount/'+data.id).then((response)=>{
    //         _.recordToDelete = response.data;
    //         _.$toasted.show('Account unblocked successfully.', {
    //             duration: 2000
    //         })
    //         _.getAllUsers()
    //         //_.users.splice(_.users.indexOf(data), 1)
    //         // eslint-disable-next-line no-undef
    //       $('#deleteModal').modal('hide')
    //   });
    // },
    // terminateUser(data){
    //   var _ = this;
    //   _.axios.defaults.headers.common['Authorization'] = 'Bearer '+ localStorage.getItem('access_token')
    //   _.axios.delete('api/terminateuser/'+data.id).then((response)=>{
    //         _.recordToDelete = response.data;
    //         _.$toasted.show('User terminated successfully.', {
    //             duration: 2000
    //         })
    //         _.users.splice(_.users.indexOf(data), 1)
    //         // eslint-disable-next-line no-undef
    //       $('#deleteModal').modal('hide')
    //   });
    // },
    // restoreUser(data){
    //   var _ = this;
    //   _.axios.defaults.headers.common['Authorization'] = 'Bearer '+ localStorage.getItem('access_token')
    //   _.axios.patch('api/restoreuser/'+data.id).then((response)=>{
    //         _.recordToDelete = response.data;
    //         _.$toasted.show('User restored successfully.', {
    //             duration: 2000
    //         })
    //          _.getAllUsers()
    //          _.filterBy = 1
    //         //_.users.splice(_.users.indexOf(data), 1)
    //         // eslint-disable-next-line no-undef
    //       $('#deleteModal').modal('hide')
    //   });
    // },
    // deleteRecord(data){
    //   var _ = this;
    //   _.axios.defaults.headers.common['Authorization'] = 'Bearer '+ localStorage.getItem('access_token')
    //   _.axios.delete('api/user/'+data.id).then((response)=>{
    //         _.recordToDelete = response.data;
    //         _.$toasted.show('Data deleted successfully.', {
    //             duration: 2000
    //         })
    //         //  _.filterBy = 1
    //         _.users.splice(_.users.indexOf(data), 1)
    //         // eslint-disable-next-line no-undef
    //       $('#deleteModal').modal('hide')
    //   });
    // }
  },
  components: {
    // AlertModal
  },
};
</script>
<style scoped>
.blocked {
  color: red !important;
}
</style>
<style>
.py-3 {
  padding-top: 3em;
  padding-bottom: 3em;
}
.px-3 {
  padding-left: 3em;
  padding-right: 3em;
}
.border-right {
  border-right: 1px solid #4d4d4d;
}
.action-buttons .btn-circle {
  transform: scale(0.8);
  margin: 0 2px;
}
.action-buttons .btn-circle i {
  transform: scale(1.3);
}
td {
  vertical-align: middle !important;
}
button {
  text-transform: uppercase !important;
  vertical-align: middle !important;
}
.mr-2 {
  margin-right: 2em;
}
.ml-2 {
  margin-left: 2em;
}
.mr-1 {
  margin-right: 1em;
}
.ml-1 {
  margin-left: 1em;
}
</style>
