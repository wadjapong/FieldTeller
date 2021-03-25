<template>
  <div>
<!-- Custom Content -->
    <div class="row clearfix">
        <div class="col-xs-12 col-sm-3">
            <!-- Edit Profile modal -->
            <div class="modal fade" id="editProfileModal" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Update Profile</h4>
                        </div>
                        <div class="modal-body">
                            <div class="form-group form-float">
                            <div class="form-line">
                                <input type="text" class="form-control" name="name" required>
                                <label class="form-label">Name</label>
                            </div>
                        </div>
                        <div class="form-group form-float">
                            <div class="form-line">
                                <input type="text" class="form-control" name="phone_number">
                                <label class="form-label">Primary Phone Number</label>
                            </div>
                        </div>
                        <div class="form-group form-float">
                            <div class="form-line">
                                <input type="email" class="form-control" name="email" required>
                                <label class="form-label">Email</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <input type="radio" name="gender" id="male" class="with-gap">
                            <label for="male">Male</label>

                            <input type="radio" name="gender" id="female" class="with-gap">
                            <label for="female" class="m-l-20">Female</label>
                        </div>
                        
                        <div class="form-group form-float">
                            <form action="/" id="frmFileUpload" class="dropzone" method="post" enctype="multipart/form-data">
                                <div class="dz-message">
                                    <div class="drag-icon-cph">
                                        <i class="material-icons">touch_app</i>
                                    </div>
                                    <h4>Drop image here or click to upload to change profile picture.</h4>
                                    <em>(Max size <strong>5Mb</strong> )</em>
                                </div>
                                <div class="fallback">
                                    <input name="file" type="file" multiple />
                                </div>
                            </form>
                        </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger waves-effect" data-dismiss="modal"><i class="material-icons">cancel</i> CLOSE</button>
                            <button type="button" class="btn btn-success waves-effect"><i class="material-icons">save</i> SAVE CHANGES</button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end of Edit Profile modal -->
            
            <!-- change password modal -->
            <div class="modal fade" id="changePasswordModal" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Change Password</h4>
                        </div>
                        <div class="modal-body">
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <input type="password" class="form-control" id="OldPassword" name="OldPassword" required>
                                    <label class="form-label">Old Password</label>
                                </div>
                            </div>
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <input type="password" class="form-control" id="NewPassword" name="NewPassword" required>
                                    <label class="form-label">New Password</label>
                                </div>
                            </div>
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <input type="password" class="form-control" id="NewPasswordConfirm" name="NewPasswordConfirm" required>
                                    <label class="form-label">New Password (Confirm)</label>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger waves-effect" data-dismiss="modal"><i class="material-icons">cancel</i> CLOSE</button>
                            <button type="button" class="btn btn-success waves-effect"><i class="material-icons">save</i> SAVE CHANGES</button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end of change password modal -->
            
            <!-- Edit about me modal -->
            <div class="modal fade" id="aboutMeModal" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">About Me</h4>
                            <small>The more customers know about you, the more likely they'll be confident in requesting your services.</small>
                        </div>
                        <div class="modal-body">
                            <div class="form-group form-float">
                            <div class="form-line">
                                <textarea class="form-control" name="description" rows="3" ></textarea>
                                <label class="form-label">Describe Yourself</label>
                            </div>
                        </div>
                        <div class="form-group form-float">
                            <div class="form-line">
                                <input type="text" class="form-control" >
                                <label class="form-label">Business Name - what name can your old customers use to identify you.</label>
                            </div>
                        </div>
                        <div class="form-group form-float">
                            <div class="form-line">
                                <input type="text" class="form-control" >
                                <label class="form-label">Twitter Handle - let your customers follow you</label>
                            </div>
                        </div>
                        <div class="form-group form-float">
                            <div class="form-line">
                                <input type="text" class="form-control" >
                                <label class="form-label">Instagram Handle - let your customers follow you</label>
                            </div>
                        </div>
                        <div class="form-group form-float">
                            <div class="form-line">
                                <input type="text" class="form-control">
                                <label class="form-label">Facebook Page - let your customers join your page</label>
                            </div>
                        </div>
                        <div class="form-group form-float">
                            <div class="form-line">
                                <input type="text" class="form-control" name="phone_number">
                                <label class="form-label">Website Address - if you already have a website, enter the url</label>
                            </div>
                        </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger waves-effect" data-dismiss="modal"><i class="material-icons">cancel</i> CLOSE</button>
                            <button type="button" class="btn btn-success waves-effect"><i class="material-icons">save</i> SAVE CHANGES</button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end of Edit about me modal -->
            
            <alert-modal :data="userToDelete" title="Close Your Account" message="Closing your account will delete your account from our services and 
            customers will no longer be able to request your services. Are you sure you want to close your account?"
            confirmButtonText="Yes, Close"/>
            <alert-modal :data="userToDelete" colour="modal-col-blue" identity="buzzAlert" confirmButtonColour="btn-success"
            confirmButtonIcon="thumb_up" confirmButtonText="Yes, Buzz" cancelButtonColour="btn-danger" title="Buzz Customers"
            message="Buzzing customers will remind them that you are at their service. Use this well else your customers can block your notifications.
            Are you sure you want to buzz your customers at this time?"/>

            <div class="card profile-card">
                <div class="profile-header">
                    <ul class="header-dropdown2 pull-right">
                        <li class="dropdown">
                            <a href="javascript:void(0);" style="color: white;" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                <i class="material-icons">more_vert</i>
                            </a>
                            <ul class="dropdown-menu pull-right">
                                <li><a href="javascript:void(0);" data-toggle="modal" data-backdrop="static" data-target="#editProfileModal"> <i class="material-icons">mode_edit</i> Edit Profile</a></li>
                                <li><a href="javascript:void(0);" data-toggle="modal" data-backdrop="static" data-target="#changePasswordModal"> <i class="material-icons">vpn_key</i> Change Password</a></li>
                                <li><a href="javascript:void(0);" data-toggle="modal" data-backdrop="static" data-target="#alertModal"> <i class="material-icons">delete</i> Close Account</a> </li>
                            </ul>
                        </li>
                    </ul>
                </div>
                <div class="profile-body">
                    <div class="image-area">
                        <img src="@/assets/images/user-lg.jpg" alt="AdminBSB - Profile Image" />
                    </div>
                    <div class="content-area">
                        <h3>Marc K. Hammond</h3>
                        <p>example@example.com</p>
                        <p>+23394884749</p>
                        <label class=""><i class="glyphicon glyphicon-star badge bg-pink font-15"> 4.5</i> </label>
                        <p>Service Provider</p>
                    </div>
                </div>
                <div class="profile-footer">
                    <ul>
                        <li>
                            <span>Total Services Provided</span>
                            <span>4000</span>
                        </li>
                        <li>
                            <span>Total Customers</span>
                            <span>300</span>
                        </li>
                        <li>
                            <span>Total Services Registered</span>
                            <span>3</span>
                        </li>
                    </ul>
                    <button data-toggle="modal" data-backdrop="static" data-target="#buzzAlert"
                    class="btn btn-info btn-lg waves-effect btn-block">
                        <i class="material-icons">record_voice_over</i> BUZZ CUSTOMERS 
                    </button>
                </div>
            </div>

            <div class="card card-about-me">
                <div class="header">
                    <h2>ABOUT ME</h2> <small> What potential customers see about you.</small>
                    <ul class="header-dropdown">
                        <li class="dropdown">
                            <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                <i class="material-icons">more_vert</i>
                            </a>
                            <ul class="dropdown-menu pull-right">
                                <li><a href="javascript:void(0);" data-toggle="modal" data-backdrop="static" data-target="#aboutMeModal"> <i class="material-icons">mode_edit</i> Edit</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
                <div class="body">
                    <ul>
                        <li>
                            <div class="title">
                                <i class="material-icons">notes</i>
                                Describe Yourself
                            </div>
                            <div class="content">
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam fermentum enim neque.
                            </div>
                        </li>
                        <li>
                            <div class="title">
                                <i class="material-icons">domain</i>
                                Business Name
                            </div>
                            <div class="content">
                                Adom wo whim
                            </div>
                        </li>
                        <li>
                            <div class="title">
                                <i class="material-icons">location_on</i>
                                Business Location
                            </div>
                            <div class="content">
                                Accra, Achimota
                            </div>
                        </li>
                        <li>
                            <div class="title">
                                <i class="fa fa-twitter"></i>
                                <a href="#"> @twitter_handle</a>
                            </div>
                        </li>
                        <li>
                            <div class="title">
                                <i class="fa fa-instagram"></i>
                                <a href="#"> instagram_handle</a>
                            </div>
                        </li>
                        <li>
                            <div class="title">
                                <i class="fa fa-facebook"></i>
                                <a href="#"> facebook page</a>
                            </div>
                        </li>
                        <li>
                            <div class="title">
                                <i class="fa fa-globe"></i>
                                <a href="#"> website</a>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-xs-12 col-sm-9">
            <div class="card">
                <div class="body">
                    <div>
                        <ul class="nav nav-tabs" role="tablist">
                            <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">What's New</a></li>
                        </ul>

                        <div class="tab-content">
                            <div role="tabpanel" class="tab-pane fade in active" id="home">
                                <div class="panel panel-default panel-post">
                                    <div class="panel-heading">
                                        <div class="media">
                                            <div class="media-body">
                                                <span class="media-heading">
                                                    <i class="material-icons">info_outline</i>
                                                </span>
                                                View what your customers are saying about you, your ratings, shout out to your customers and get feature updates here.
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="panel panel-default panel-post">
                                    <div class="panel-heading">
                                        <div class="media">
                                            <div class="media-left">
                                                <a href="#">
                                                    <img src="@/assets/images/user-lg.jpg" />
                                                </a>
                                            </div>
                                            <div class="media-body">
                                                <h4 class="media-heading">
                                                    <a href="#">Marc K. Hammond</a>
                                                </h4>
                                                What's new with your services? Shout out to your customers.
                                            </div>
                                        </div>
                                    </div>
                                    <div class="panel-footer">
                                       <div class="input-group">
                                        <div class="form-line">
                                            <textarea class="form-control" name="description" placeholder="Message" rows="3" ></textarea>
                                        </div>
                                        <span class="input-group-addon">
                                            <button class="btn btn-link"><i class="material-icons">send</i></button>
                                        </span>
                                    </div>
                                    </div>
                                </div>
                                <div class="panel panel-default panel-post">
                                    <div class="panel-heading">
                                        <div class="media">
                                            <div class="media-left">
                                                <a href="#">
                                                    <img src="@/assets/images/user-lg.jpg" />
                                                </a>
                                            </div>
                                            <div class="media-body">
                                                <h4 class="media-heading">
                                                    <a href="#">Marc K. Hammond</a>
                                                </h4>
                                                Shared publicly - 26 Oct 2018
                                            </div>
                                        </div>
                                    </div>
                                    <div class="panel-body">
                                        <div class="post">
                                            <div class="post-heading">
                                                <p>I am a very simple wall post. I am good at containing <a href="#">#small</a> bits of <a href="#">#information</a>. I require little more information to use effectively.</p>
                                            </div>
                                            <div class="post-content">
                                                <img src="@/assets/images/profile-post-image.jpg" class="img-responsive" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="panel-footer">
                                        <ul>
                                            <li>
                                                <a href="#">
                                                    <i class="material-icons">thumb_up</i>
                                                    <span>12 Likes</span>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#">
                                                    <i class="material-icons">comment</i>
                                                    <span>5 Comments</span>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#">
                                                    <i class="material-icons">share</i>
                                                    <span>Share</span>
                                                </a>
                                            </li>
                                        </ul>

                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="text" class="form-control" placeholder="Type a comment" />
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="panel panel-default panel-post">
                                    <div class="panel-heading">
                                        <div class="media">
                                            <div class="media-left">
                                                <a href="#">
                                                    <img src="@/assets/images/user-lg.jpg" />
                                                </a>
                                            </div>
                                            <div class="media-body">
                                                <h4 class="media-heading">
                                                    <a href="#">Marc K. Hammond</a>
                                                </h4>
                                                Shared publicly - 01 Oct 2018
                                            </div>
                                        </div>
                                    </div>
                                    <div class="panel-body">
                                        <div class="post">
                                            <div class="post-heading">
                                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                                            </div>
                                            <div class="post-content">
                                                <iframe width="100%" height="360" src="https://www.youtube.com/embed/10r9ozshGVE" frameborder="0" allowfullscreen=""></iframe>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="panel-footer">
                                        <ul>
                                            <li>
                                                <a href="#">
                                                    <i class="material-icons">thumb_up</i>
                                                    <span>125 Likes</span>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#">
                                                    <i class="material-icons">comment</i>
                                                    <span>8 Comments</span>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#">
                                                    <i class="material-icons">share</i>
                                                    <span>Share</span>
                                                </a>
                                            </li>
                                        </ul>

                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="text" class="form-control" placeholder="Type a comment" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- #END# Custom Content -->
  </div>
</template>

<script>
import AlertModal from '@/components/AlertModal'
export default {
  name: 'userprofile',
  data () {
    return {
      user: {},
      users: [],
      userToDelete: {},
      pageDetails: {
        name: 'Welcome', description: 'dear user'
      },
    }
  },
  mounted () {
    this.$emit('set-page-details', this.pageDetails)
  },
  components: {
    AlertModal
  }
}
</script>
<style scoped>
    .header-dropdown2 {
        list-style:none; 
        margin-left: -30%; 
        margin-top: -30px; 
    }
   .fa {
        padding: 3px;
        font-size: 30px;
        width: 30px;
        text-align: center;
        text-decoration: none;
    }

/* Add a hover effect if you want */
.fa:hover {
    opacity: 0.7;
}

/* Set a specific color for each brand */

/* Facebook */
.fa-facebook {
    color: #3B5998;
}

/* Twitter */
.fa-twitter {
    color: #55ACEE;
}
.fa-globe {
    color: #55ACEE;
}
.fa-instagram {
    color: #125688;
    
}
</style>
