<template>
  <aside id="leftsidebar" class="sidebar">
    <!-- User Info -->
    <div class="user-info">
      <div class="image">
        <!-- <img
          :src="$store.getters.getStoragePath + 'noimage.png'"
          width="48"
          height="48"
          alt="User"
        /> -->
        <img src="images/user.png" alt="User" width="48" height="48">
      </div>
      <div class="info-container">
        <div
          class="name"
          data-toggle="dropdown"
          aria-haspopup="true"
          aria-expanded="false"
        >
          Jon Moss
        </div>
        <div class="email">jonmoss@email.com</div>
        <div class="btn-group user-helper-dropdown">
          <i
            class="material-icons"
            data-toggle="dropdown"
            aria-haspopup="true"
            aria-expanded="true"
            >keyboard_arrow_down</i
          >
          <ul class="dropdown-menu pull-right">
            <li>
              <router-link to="/myprofile"
                ><i class="material-icons">person</i> Profile</router-link
              >
            </li>
            <li role="separator" class="divider"></li>
            <!-- <li>
              <a href="javascript:void(0);"
                ><i class="material-icons">group</i>Followers</a
              >
            </li>
            <li>
              <a href="javascript:void(0);"
                ><i class="material-icons">shopping_cart</i>Sales</a
              >
            </li>
            <li>
              <a href="javascript:void(0);"
                ><i class="material-icons">favorite</i>Likes</a
              >
            </li> -->
            <!-- <li role="separator" class="divider"></li> -->
            <li>
              <a href="javascript:void(0);" @click="logout"
                ><i class="material-icons">input</i>Sign Out</a
              >
            </li>
          </ul>
        </div>
      </div>
    </div>
    <!-- #User Info -->
    <!-- Menu -->
    <div class="menu">
      <ul class="list">
        <li class="header">MAIN NAVIGATION</li>
        <li>
          <router-link to="/" class="menu-item">
            <i class="material-icons">home</i>
            <span>Home</span>
          </router-link>
        </li>
        <li>
          <a href="javascript:void(0);" class="menu-item menu-toggle">
            <i class="material-icons">people</i>
            <span>System User Management</span>
          </a>
          <ul class="ml-menu">
            <li>
              <router-link
                :to="{
                  name: 'usertypes',
                  params: { userGroup: 'system_user' },
                }"
                >User Types</router-link
              >
            </li>
            <li>
              <router-link
                :to="{
                  name: 'usertypepermissions',
                  params: { userGroup: 'system_user' },
                }"
                >User Type Permissions</router-link
              >
            </li>
            <li>
              <router-link
                :to="{
                  name: 'useraccounts',
                  params: { userGroup: 'system_user' },
                }"
                >User Accounts</router-link
              >
            </li>
          </ul>
        </li>
        <li>
          <a href="javascript:void(0);" class="menu-item menu-toggle">
            <i class="material-icons">swap_horiz</i>
            <span>System User Transactions</span>
          </a>
          <ul class="ml-menu">
            <li>
              <router-link to="/usertransactions">User Transactions</router-link>
            </li>
          </ul>
        </li>
        <li>
          <a href="javascript:void(0);" class="menu-item menu-toggle">
            <i class="material-icons">people</i>
            <span>Distributor Management</span>
          </a>
          <ul class="ml-menu">
            <li>
              <router-link to="/distributorregistration"
                >Distributor Registration</router-link
              >
            </li>
            <li>
              <router-link
                :to="{
                  name: 'distributorusertypes',
                  params: { userGroup: 'distributor' },
                }"
                >Distributor User Types</router-link
              >
            </li>
            <li>
              <router-link
                :to="{
                  name: 'distributorusertypepermissions',
                  params: { userGroup: 'distributor' },
                }"
                >Distributor User Type Permissions</router-link
              >
            </li>
            <li>
              <router-link
                :to="{
                  name: 'distributoruseraccounts',
                  params: { userGroup: 'distributor' },
                }"
                >Distributor User Accounts</router-link
              >
            </li>
          </ul>
        </li>
        <li>
          <a href="javascript:void(0);" class="menu-item menu-toggle">
            <i class="material-icons">swap_horiz</i>
            <span>Distributor Transactions</span>
          </a>
          <ul class="ml-menu">
            <li>
              <router-link to="/topupdistributor">Top-up Distributor</router-link>
            </li>
            <li>
              <router-link to="/distributorfloattransfer">Distributor Float Transfer</router-link>
            </li>
            <li>
              <router-link to="/distributorfloatsales">Sell Float to Field Teller</router-link>
            </li>
            <li>
              <router-link to="/distributortransactions">Distributor Transaction Reports</router-link>
            </li>
          </ul>
        </li>
        <li>
          <a href="javascript:void(0);" class="menu-item menu-toggle">
            <i class="material-icons">people</i>
            <span>Merchant Management</span>
          </a>
          <ul class="ml-menu">
            <li>
              <router-link to="/merchantregistration">Merchant Registration</router-link>
            </li>
            <li>
              <router-link
                :to="{
                  name: 'merchantusertypes',
                  params: { userGroup: 'merchant' },
                }"
                >Merchant User Types</router-link
              >
            </li>
            <li>
              <router-link
                :to="{
                  name: 'merchantusertypepermissions',
                  params: { userGroup: 'merchant' },
                }"
                >Merchant User Type Permissions</router-link
              >
            </li>
            <li>
              <router-link
                :to="{
                  name: 'merchantuseraccounts',
                  params: { userGroup: 'merchant' },
                }"
                >Merchant User Accounts</router-link
              >
            </li>
          </ul>
        </li>
        <li>
          <a href="javascript:void(0);" class="menu-item menu-toggle">
            <i class="material-icons">swap_horiz</i>
            <span>Merchant Transactions</span>
          </a>
          <ul class="ml-menu">
            <li>
              <router-link to="/merchantcashpickupschedule">Schedule Cash Pickup</router-link>
            </li>
            <li>
              <router-link to="/merchantcashpickuprequest">Request Cash Pickup</router-link>
            </li>
            <li>
              <router-link to="/merchantmanualsettlement">Manual Merchant Settlement</router-link>
            </li>
            <li>
              <router-link to="/merchanttransactions">Merchant Transaction Reports</router-link>
            </li>
          </ul>
        </li>
        <li>
          <a href="javascript:void(0);" class="menu-item menu-toggle">
            <i class="material-icons">people</i>
            <span>Field Teller Management</span>
          </a>
          <ul class="ml-menu">
            <li>
              <router-link to="/fieldtellerregistration">Field Teller Registration</router-link>
            </li>
            <li>
              <router-link to="/fieldtellermerchantpairing">Field Teller To Merchant Pairing</router-link>
            </li>
            <li>
              <router-link to="/activepairs">Active Pairs</router-link>
            </li>
            <li>
              <router-link
                :to="{
                  name: 'fieldtelleruseraccounts',
                  params: { userGroup: 'field_teller' },
                }"
                >Field Teller User Accounts</router-link
              >
            </li>
          </ul>
        </li>
        <li>
          <a href="javascript:void(0);" class="menu-item menu-toggle">
            <i class="material-icons">swap_horiz</i>
            <span>Field Teller Transactions</span>
          </a>
          <ul class="ml-menu">
            <li>
              <router-link to="/fieldtellerfloattransfer">Field Teller Float Transfer</router-link>
            </li>
            <li>
              <router-link to="/fieldtellercommissionsettlement"
                >Field Teller Commissions Settlement</router-link
              >
            </li>
            <li>
              <router-link to="/fieldtellertransactions">Field Teller Transaction Reports</router-link>
            </li>
          </ul>
        </li>
      </ul>
    </div>
    <!-- #Menu -->
    <!-- Footer -->
    <div class="legal">
      <div class="copyright">
        &copy; {{ new Date().getFullYear() }}
        <a href="javascript:void(0);">Field Teller App-Gateway</a>.
      </div>
      <div class="version"><b>Version: </b> 1.0</div>
    </div>
    <!-- #Footer -->
  </aside>
</template>

<script>
export default {
  name: "leftaside",
  props: {
    isActive: {
      default: 0,
    },
  },
  data() {
    return {
      user: {
        first_name: "",
        last_name: "",
        is_blocked: false,
        email: "",
        role: "",
        gender: "",
        picture: "",
        primary_phonenumber: "",
      },
    };
  },
  mounted() {
    if (localStorage.getItem("setUserDetails")) {
      this.user = JSON.parse(localStorage.getItem("setUserDetails"));
    }
  },
  methods: {
    logout() {
      var _ = this;
      this.axios.defaults.headers.common["Authorization"] =
        "Bearer " + localStorage.getItem("access_token");
      _.axios
        .post("api/logout")
        .then(() => {})
        .catch((error) => {
          /*eslint-disable*/
          console.log(error);
          /*eslint-enable*/
        });
      localStorage.clear();
      this.user = {
        first_name: "",
        last_name: "",
        is_blocked: false,
        email: "",
        role: "",
        gender: "",
        picture: "",
        primary_phonenumber: "",
      };
      this.$router.push("login");
    },
  },
  watch: {
    isActive: function () {
      if (localStorage.getItem("setUserDetails")) {
        this.user = JSON.parse(localStorage.getItem("setUserDetails"));
      }
    },
  },
};
</script>

<style scoped>
/* .router-link-exact-active{
        color: #f44436 !important ;
    }
    .router-link-exact-active span {
        color: #f44436 !important ;
    } */
.ml-menu .router-link-exact-active {
  font-weight: 600;
  margin-left: 5px;
}
.ml-menu .router-link-exact-active::before {
  content: "\E315";
  font-family: "Material Icons";
  position: relative;
  font-size: 21px;
  height: 20px;
  top: -5px;
  right: 0px;
}
.menu-item {
  border-bottom: 1px dotted #ced4da;
}
.sidebar .menu .list a {
  padding: 5px 13px;
}
</style>

