<template>
<div>
    <div class="signup-page">
        <div class="signup-box">
            <div class="logo">
                <a href="javascript:void(0);">App<b>Gateway</b></a>
                <small>Become a member now. Registration is free.</small>
            </div>
            <div class="card">
                <div class="body">
                    <form id="sign_up" method="POST">
                        <div class="msg">Please fill the form below.</div>
                        <div class="input-group">
                            <span class="input-group-addon">
                                <i class="material-icons">person</i>
                            </span>
                            <div class="form-line">
                                <input type="text" class="form-control" name="namesurname" placeholder="Name Surname" required autofocus>
                            </div>
                        </div>
                        <div class="input-group">
                            <span class="input-group-addon">
                                <i class="material-icons">contact_phone</i>
                            </span>
                            <div class="form-line">
                                <input type="text" class="form-control" name="namesurname" placeholder="Phone Number" required>
                            </div>
                        </div>
                        <div class="input-group">
                            <span class="input-group-addon">
                                <i class="material-icons">email</i>
                            </span>
                            <div class="form-line">
                                <input type="email" class="form-control" name="email" placeholder="Email Address" required>
                            </div>
                        </div>
                        <div class="input-group">
                            <span class="input-group-addon">
                                <i class="material-icons">lock</i>
                            </span>
                            <div class="form-line">
                                <input type="password" class="form-control" name="password" minlength="6" placeholder="Password" required>
                            </div>
                        </div>
                        <div class="input-group">
                            <span class="input-group-addon">
                                <i class="material-icons">lock</i>
                            </span>
                            <div class="form-line">
                                <input type="password" class="form-control" name="confirm" minlength="6" placeholder="Confirm Password" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <input type="checkbox" name="terms" id="terms" class="filled-in chk-col-pink">
                            <label for="terms">I read and agree to the <a href="javascript:void(0);">terms of usage</a>.</label>
                        </div>

                        <button class="btn btn-block btn-lg bg-pink waves-effect" type="submit">SIGN UP</button>

                        <div class="m-t-25 m-b--5 align-center">
                            <router-link to="/login">Already registered? Login</router-link>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</template>
<script>
export default {
  name: 'signup',
  data () {
    return {
      user: {},
      users: [],
      userToDelete: {}
    }
  },
  mounted () {
    this.$emit('hide-console', true)
  },
  components: {
    
  },
  destroyed () {
      this.$emit('hide-console', false)
  }
}
</script>
<style scoped>
   
</style>
