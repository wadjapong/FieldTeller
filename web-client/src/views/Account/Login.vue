<template>
  <div>
    <div class="login-page">
      <div class="login-box">
        <div class="logo">
          <a href="javascript:void(0);">App<b>Gateway</b></a>
          <small>Already a member? Sign in here.</small>
        </div>
        <div class="card">
          <div class="body">
            <div class="msg">Sign in here</div>
            <div class="input-group">
              <span class="input-group-addon">
                <i class="material-icons">person</i>
              </span>
              <div class="form-line">
                <input
                  type="text"
                  v-model="user.username"
                  class="form-control"
                  name="username"
                  placeholder="Email or phone number"
                  required
                />
              </div>
            </div>
            <div class="input-group">
              <span class="input-group-addon">
                <i class="material-icons">lock</i>
              </span>
              <div class="form-line">
                <input
                  type="password"
                  v-model="user.password"
                  class="form-control"
                  name="password"
                  placeholder="Password"
                  required
                />
              </div>
            </div>
            <div class="row">
              <div class="col-xs-8 p-t-5">
                <input
                  type="checkbox"
                  name="rememberme"
                  id="rememberme"
                  class="filled-in chk-col-pink"
                />
                <label for="rememberme">Remember Me</label>
              </div>
              <div class="col-xs-4">
                <button
                  class="btn btn-block bg-pink waves-effect"
                  @click="login"
                >
                  {{ isProcessing }}
                </button>
              </div>
            </div>
            <div class="row m-t-15 m-b--20">
              <div class="col-xs-6">
                <router-link to="/signup">Register Now!</router-link>
              </div>
              <div class="col-xs-6 align-right">
                <router-link to="/passwordreset">Forgot Password?</router-link>
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
  name: "login",
  data() {
    return {
      isProcessing: "Login",
      user: {
        username: "maeve87@example.org",
        password: "secret",
      },
    };
  },
  methods: {
    login() {
      var _ = this;
      _.msg = "";
      _.isProcessing = "Login...";
      _.axios
        .post("api/login", _.user)
        .then((response) => {
          _.$store.commit("setToken", response.data.access_token);
          _.$emit("hide-console", false);
          localStorage.setItem("access_token", response.data.access_token);
          _.setUserDetails();
          _.isProcessing = "Login";
          _.$router.push("/");
        })
        .catch((error) => {
          /* eslint-disable no-console */
          console.log(error);
          /* eslint-enable no-console */
          _.msg = "Invalid login credentials. Please try again";
          _.isProcessing = "Try again";
        });
    },
    setUserDetails() {
      var _ = this;
      _.axios.defaults.headers.common["Authorization"] =
        "Bearer " + this.$store.getters.getToken;
      _.axios
        .get("api/user")
        .then((response) => {
          _.$store.commit("setUserDetails", response.data);
          localStorage.setItem("setUserDetails", JSON.stringify(response.data));
        })
        .catch((error) => {
          /* eslint-disable no-console */
          console.log(error);
          /* eslint-enable no-console */
        });
    },
    closeModal() {
      this.$store.commit("setShowLogin", false);
    },
  },
  mounted() {
    this.$emit("hide-console", true);
  },
  components: {},
  destroyed() {
    this.$emit("hide-console", false);
  },
};
</script>
<style scoped>
</style>
