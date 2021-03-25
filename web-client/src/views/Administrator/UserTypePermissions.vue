<template>
  <div>
    <!-- Exportable Table -->
    <div class="row clearfix">
      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <!-- New user modal -->

        <!-- end of new user modal -->
        <!-- <alert-modal :identity="'deleteModal'" :data="recordToDelete" @confirm-delete="deleteRecord"/> -->

        <div class="row clearfix">
          <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
              <div class="header">
                <div class="row">
                  <div class="col-md-5">
                    <h2>{{ userGroupName }} User Type Permissions</h2>
                  </div>
                  <div class="col-md-7">
                    <div class="row clearfix">
                      <div class="col-sm-7">
                        <div class="form-group mb-0">
                          <div class="form-line">
                            <select
                              v-model="selectedRole"
                              class="form-control show-tick"
                            >
                              <option value="">-- Select User Type --</option>
                              <option
                                v-for="(r, i) in roles"
                                :key="i"
                                :value="r.id"
                              >
                                {{ r.name }}
                              </option>
                            </select>
                          </div>
                        </div>
                      </div>
                      <div class="col-sm-5">
                        <div v-if="selectedRole != ''">
                          <button
                            v-if="!isProcessing"
                            type="button"
                            class="btn btn-primary waves-effect"
                            @click="getRolePermissions(selectedRole)"
                          >
                            <i class="material-icons">youtube_searched_for</i>
                            <span>Load Permissions</span>
                          </button>
                          <div v-if="isProcessing" class="preloader pl-size-xs">
                            <div class="spinner-layer pl-green">
                              <div class="circle-clipper left">
                                <div class="circle"></div>
                              </div>
                              <div class="circle-clipper right">
                                <div class="circle"></div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="body table-responsive">
                <div class="row" v-if="permissions.length > 0">
                  <div
                    class="col-xs-12 col-sm-12 col-md-4 col-lg-4 border-right"
                  >
                    <!-- Nav tabs -->
                    <ul class="nav nav-tabs mytabs" role="tablist">
                      <li role="presentation" class="active">
                        <a href="#home_animation_1" data-toggle="tab"
                          >User Management</a
                        >
                      </li>
                      <li role="presentation">
                        <a href="#profile_animation_1" data-toggle="tab"
                          >Distributor Management</a
                        >
                      </li>
                      <li role="presentation">
                        <a href="#messages_animation_1" data-toggle="tab"
                          >Merchant Management</a
                        >
                      </li>
                      <li role="presentation">
                        <a href="#settings_animation_1" data-toggle="tab"
                          >Field Teller Management</a
                        >
                      </li>
                      <li role="presentation">
                        <a href="#settings_animation_11" data-toggle="tab"
                          >Distributor Transactions</a
                        >
                      </li>
                      <li role="presentation">
                        <a href="#settings_animation_12" data-toggle="tab"
                          >Merchant Transactions</a
                        >
                      </li>
                      <li role="presentation">
                        <a href="#settings_animation_13" data-toggle="tab"
                          >Field Teller Transactions</a
                        >
                      </li>
                      <li role="presentation">
                        <a href="#settings_animation_14" data-toggle="tab"
                          >System User Transactions</a
                        >
                      </li>
                    </ul>
                  </div>
                  <div class="col-sm-12 col-md-8">
                    <!-- Tab panes -->
                    <div class="tab-content">
                      <div
                        role="tabpanel"
                        class="tab-pane active"
                        id="home_animation_1"
                      >
                        <div
                          v-for="(p, i) in userManagementPerms"
                          :key="i"
                          class="demo-checkbox animated flipInX"
                        >
                          <input
                            type="checkbox"
                            class="filled-in"
                            :id="'usermgt' + i"
                            :value="p.id"
                            v-model="savedUserMgt"
                          />
                          <label :for="'usermgt' + i">{{ p.slug }}</label>
                        </div>
                      </div>
                      <div
                        role="tabpanel"
                        class="tab-pane"
                        id="profile_animation_1"
                      >
                        <div
                          v-for="(p, i) in distManagementPerms"
                          :key="i"
                          class="demo-checkbox animated flipInX"
                        >
                          <input
                            type="checkbox"
                            class="filled-in"
                            :id="'distmgt' + i"
                            :value="p.id"
                            v-model="savedDistMgt"
                          />
                          <label :for="'distmgt' + i">{{ p.slug }}</label>
                        </div>
                      </div>
                      <div
                        role="tabpanel"
                        class="tab-pane"
                        id="messages_animation_1"
                      >
                        <div
                          v-for="(p, i) in merchManagementPerms"
                          :key="i"
                          class="demo-checkbox animated flipInX"
                        >
                          <input
                            type="checkbox"
                            class="filled-in"
                            :id="'merchmgt' + i"
                            :value="p.id"
                            v-model="savedMerchMgt"
                          />
                          <label :for="'merchmgt' + i">{{ p.slug }}</label>
                        </div>
                      </div>
                      <div
                        role="tabpanel"
                        class="tab-pane"
                        id="settings_animation_1"
                      >
                        <div
                          v-for="(p, i) in ftManagementPerms"
                          :key="i"
                          class="demo-checkbox animated flipInX"
                        >
                          <input
                            type="checkbox"
                            class="filled-in"
                            :id="'ftmgt' + i"
                            :value="p.id"
                            v-model="savedFtMgt"
                          />
                          <label :for="'ftmgt' + i">{{ p.slug }}</label>
                        </div>
                      </div>
                      <div
                        role="tabpanel"
                        class="tab-pane"
                        id="settings_animation_11"
                      >
                        <div
                          v-for="(p, i) in distTransactionPerms"
                          :key="i"
                          class="demo-checkbox animated flipInX"
                        >
                          <input
                            type="checkbox"
                            class="filled-in"
                            :id="'disttrans' + i"
                            :value="p.id"
                            v-model="savedDistTrans"
                          />
                          <label :for="'disttrans' + i">{{ p.slug }}</label>
                        </div>
                      </div>
                      <div
                        role="tabpanel"
                        class="tab-pane"
                        id="settings_animation_12"
                      >
                        <div
                          v-for="(p, i) in merchTransactionPerms"
                          :key="i"
                          class="demo-checkbox animated flipInX"
                        >
                          <input
                            type="checkbox"
                            class="filled-in"
                            :id="'merchtrans' + i"
                            :value="p.id"
                            v-model="savedMerchTrans"
                          />
                          <label :for="'merchtrans' + i">{{ p.slug }}</label>
                        </div>
                      </div>
                      <div
                        role="tabpanel"
                        class="tab-pane"
                        id="settings_animation_13"
                      >
                        <div
                          v-for="(p, i) in ftTransactionPerms"
                          :key="i"
                          class="demo-checkbox animated flipInX"
                        >
                          <input
                            type="checkbox"
                            class="filled-in"
                            :id="'fttrans' + i"
                            :value="p.id"
                            v-model="savedFtTrans"
                          />
                          <label :for="'fttrans' + i">{{ p.slug }}</label>
                        </div>
                      </div>
                      <div
                        role="tabpanel"
                        class="tab-pane"
                        id="settings_animation_14"
                      >
                        <div
                          v-for="(p, i) in userTransactionPerms"
                          :key="i"
                          class="demo-checkbox animated flipInX"
                        >
                          <input
                            type="checkbox"
                            class="filled-in"
                            :id="'usertrans' + i"
                            :value="p.id"
                            v-model="savedUserTrans"
                          />
                          <label :for="'usertrans' + i">{{ p.slug }}</label>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-sm-12 col-md-12">
                    <div v-if="isProcessing" class="preloader pl-size-xs">
                      <div class="spinner-layer pl-green">
                        <div class="circle-clipper left">
                          <div class="circle"></div>
                        </div>
                        <div class="circle-clipper right">
                          <div class="circle"></div>
                        </div>
                      </div>
                    </div>
                    <button
                      v-if="!isProcessing"
                      type="button"
                      class="btn btn-danger pull-right waves-effect"
                    >
                      <i class="material-icons">cancel</i>
                      <span>Cancel</span>
                    </button>
                    <button
                      v-if="!isProcessing"
                      type="button"
                      class="btn btn-success pull-left waves-effect"
                      @click="saveRolePermissions"
                    >
                      <i class="material-icons">save</i>
                      <span>Save Permissions</span>
                    </button>
                  </div>
                </div>
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
  name: "usertypepermissions",
  props: {
    userGroup: String,
  },
  data() {
    return {
      isEdit: false,
      filterBy: 1,
      isProcessing: false,
      isSaving: false,
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
      permissions: [],
      roles: [],
      selectedRole: "",
      rolesPermissions: [],
      savedUserMgt: [],
      savedDistMgt: [],
      savedMerchMgt: [],
      savedFtMgt: [],
      savedDistTrans: [],
      savedMerchTrans: [],
      savedFtTrans: [],
      savedUserTrans: [],
      checkedUserMgtRolePerms: [],
    };
  },
  mounted() {
    // this.$emit("set-page-details", this.pageDetails);
    this.getAllRoles();
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
    getAllPermissions() {
      var _ = this;
      // _.axios.defaults.headers.common["Authorization"] =
      //   "Bearer " + localStorage.getItem("access_token");
      _.axios
        .get("/users/permissions/get")
        .then((response) => {
          var res = response.data.data;
          res.forEach((element) => {
            let slug = element.action;
            slug = slug.replace(/_|-/g, " ");
            element.slug = slug;
          });
          _.permissions = res;

          _.savedPermissionCheckingMatrix(
            "user_management",
            _.userManagementPerms,
            _.savedUserMgt
          );

          _.savedPermissionCheckingMatrix(
            "distributor_management",
            _.distManagementPerms,
            _.savedDistMgt
          );

          _.savedPermissionCheckingMatrix(
            "merchant_management",
            _.merchManagementPerms,
            _.savedMerchMgt
          );

          _.savedPermissionCheckingMatrix(
            "field_teller_management",
            _.ftManagementPerms,
            _.savedFtMgt
          );

          _.savedPermissionCheckingMatrix(
            "distributor_transactions",
            _.distTransactionPerms,
            _.savedDistTrans
          );

          _.savedPermissionCheckingMatrix(
            "merchant_transactions",
            _.merchTransactionPerms,
            _.savedMerchTrans
          );

          _.savedPermissionCheckingMatrix(
            "field_teller_transactions",
            _.ftTransactionPerms,
            _.savedFtTrans
          );

          _.savedPermissionCheckingMatrix(
            "system_user_transactions",
            _.userTransactionPerms,
            _.savedUserTrans
          );

          this.isProcessing = false;
        })
        .catch((e) => {
          _.isProcessing = false;
          /* eslint-disable no-console */
          console.log(e);
          /* eslint-enable no-console */
        });
    },
    getAllRoles() {
      var _ = this;
      // _.axios.defaults.headers.common["Authorization"] =
      //   "Bearer " + localStorage.getItem("access_token");
      _.axios
        .get("/users/roles/get")
        .then((response) => {
          let res = response.data.data;
          res.filter((i) => i.approval_status == "accepted");
          _.roles = res;
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
    getRolePermissions(role_id) {
      var _ = this;
      // _.axios.defaults.headers.common["Authorization"] =
      //   "Bearer " + localStorage.getItem("access_token");
      _.isProcessing = true;
      _.axios
        .get("/users/roles/permissions/get/" + parseInt(role_id))
        .then((response) => {
          _.rolesPermissions = response.data.data;
          _.getAllPermissions();
        })
        .catch((e) => {
          _.isProcessing = false;
          /* eslint-disable no-console */
          console.log(e);
          /* eslint-enable no-console */
        });
    },
    savedPermissionCheckingMatrix(filter, assignedPermission, targetArray) {
      var rolePerms = this.rolesPermissions.filter(
        (rp) => rp.permission.module === filter
      );

      rolePerms.forEach((rp) => {
        assignedPermission.forEach((p) => {
          if (rp.permission.id === p.id) {
            targetArray.push(p.id);
          }
        });
      });
    },
    saveRolePermissions() {
      let _ = this;
      let arr = [
        ..._.savedUserMgt,
        ..._.savedDistMgt,
        ..._.savedMerchMgt,
        ..._.savedFtMgt,
        ..._.savedDistTrans,
        ..._.savedMerchTrans,
        ..._.savedFtTrans,
        ..._.savedUserTrans,
      ];
      let res = {};
      res.permissions = arr;
      res.role_id = parseInt(_.selectedRole);
      // _.axios.defaults.headers.common["Authorization"] =
      //   "Bearer " + localStorage.getItem("access_token");
      _.isProcessing = true;
      _.axios
        .post("/users/roles/permissions/assign", res)
        .then((response) => {
          if (response.status == 200) {
            _.$toasted.success("Permissions Assigned Successfully!", {
              duration: 3500,
            });
          } else {
            _.$toasted.error("Oops, Error Occurred!", {
              duration: 3500,
            });
          }
          _.isProcessing = false;
        })
        .catch((e) => {
          _.isProcessing = false;
          /* eslint-disable no-console */
          console.log(e);
          /* eslint-enable no-console */
          _.$toasted.error("Oops, Error Occurred!", {
            duration: 3500,
          });
        });
    },
  },
  components: {
    // AlertModal
  },
  computed: {
    userGroupName() {
      switch (this.userGroup) {
        case "system_user":
          return "System";
        case "distributor":
          return "Distributor";
        case "merchant":
          return "Merchant";
        case "field_teller":
          return "Field Teller";

        default:
          return "";
      }
    },
    userManagementPerms() {
      return this.permissions.filter((i) => i.module === "user_management");
    },
    distManagementPerms() {
      return this.permissions.filter(
        (i) => i.module === "distributor_management"
      );
    },
    merchManagementPerms() {
      return this.permissions.filter((i) => i.module === "merchant_management");
    },
    ftManagementPerms() {
      return this.permissions.filter(
        (i) => i.module === "field_teller_management"
      );
    },
    distTransactionPerms() {
      return this.permissions.filter(
        (i) => i.module === "distributor_transactions"
      );
    },
    merchTransactionPerms() {
      return this.permissions.filter(
        (i) => i.module === "merchant_transactions"
      );
    },
    ftTransactionPerms() {
      return this.permissions.filter(
        (i) => i.module === "field_teller_transactions"
      );
    },
    userTransactionPerms() {
      return this.permissions.filter(
        (i) => i.module === "system_user_transactions"
      );
    },
  },
};
</script>
<style scoped>
.blocked {
  color: red !important;
}
.mytabs li {
  display: contents !important;
}
.demo-checkbox label {
  text-transform: capitalize !important;
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
.mt-0 {
  margin-top: 0;
}
.mb-0 {
  margin-bottom: 0;
}
.ml-0 {
  margin-left: 0;
}
.mr-0 {
  margin-right: 0;
}
.pl-0 {
  padding-left: 0;
}
.pr-0 {
  padding-right: 0;
}
.pt-0 {
  padding-top: 0;
}
.pb-0 {
  padding-bottom: 0;
}
select,
select option {
  text-transform: capitalize !important;
}
</style>