<template>
  <div>
    <!-- Exportable Table -->
    <div class="row clearfix">
      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <!-- New user modal -->
        <div class="modal fade" id="messageModal" tabindex="-1" role="dialog">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h4 class="modal-title" id="defaultModalLabel">
                  Message Complainant
                </h4>
              </div>
              <div class="modal-body">
                <div class="form-group">
                  <textarea
                    v-model="message"
                    id="message"
                    cols="30"
                    rows="10"
                    class="form-control"
                  ></textarea>
                </div>
              </div>
              <div class="modal-footer">
                <button
                  type="button"
                  class="btn btn-danger waves-effect"
                  data-dismiss="modal"
                  @click="clearMsg"
                >
                  <i class="material-icons">cancel</i> CLOSE
                </button>
                <button
                  @click="sendMessage"
                  type="button"
                  class="btn btn-primary waves-effect"
                >
                  <i class="material-icons">send</i> SEND
                </button>
              </div>
            </div>
          </div>
        </div>
        <!-- end of new user modal -->
        <!-- <alert-modal :data="userToDelete" /> -->
        <div class="card">
          <div class="header">
            <h2>User's complaints</h2>
          </div>
          <div class="body">
            <div class="table-responsive">
              <table class="table table-striped table-hover">
                <thead>
                  <tr>
                    <th>Complainant</th>
                    <th>Complaint</th>
                    <th>Severity</th>
                    <th>Date of Complaint</th>
                    <th>Action Taken</th>
                    <th>Actions</th>
                  </tr>
                </thead>
                <tfoot>
                  <tr>
                    <th>Complainant</th>
                    <th>Complaint</th>
                    <th>Severity</th>
                    <th>Date of Complaint</th>
                    <th>Action Taken</th>
                    <th>Actions</th>
                  </tr>
                </tfoot>
                <tbody>
                  <tr v-for="(c, i) in complaints.data" :key="i">
                    <td>
                      {{
                        c.complainant.first_name + " " + c.complainant.last_name
                      }}
                    </td>
                    <td>{{ c.complaint }}</td>
                    <td>{{ c.severity }}</td>
                    <td>{{ c.created_at | moment("ddd, MMM Do YYYY") }}</td>
                    <td>{{ c.action }}</td>
                    <td>
                      <ul
                        style="list-style: none; margin-bottom: -10px"
                        class="header-dropdown"
                      >
                        <li class="dropdown">
                          <a
                            href="javascript:void(0);"
                            class="dropdown-toggle"
                            data-toggle="dropdown"
                            role="button"
                            aria-haspopup="true"
                            aria-expanded="false"
                          >
                            <i class="material-icons">more_vert</i>
                          </a>
                          <ul class="dropdown-menu pull-right">
                            <li>
                              <a
                                href="javascript:void(0);"
                                @click="updateAction(c.id, 'blocked')"
                              >
                                <i class="material-icons">lock_outline</i> Block
                                Complainant</a
                              >
                            </li>
                            <li>
                              <a
                                href="javascript:void(0);"
                                @click="updateAction(c.id, 'none')"
                              >
                                <i class="material-icons">lock_open</i> Unblock
                                Complainant</a
                              >
                            </li>
                            <li>
                              <a
                                href="javascript:void(0);"
                                data-toggle="modal"
                                data-target="#messageModal"
                                @click="complaint = c"
                              >
                                <i class="material-icons">message</i> Message
                                Complainant</a
                              >
                            </li>
                          </ul>
                        </li>
                      </ul>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- #END# Exportable Table -->
  </div>
</template>

<script>
// import AlertModal from "@/components/AlertModal";
export default {
  name: "complaints",
  data() {
    return {
      pageDetails: {
        name: "Complaints",
        description: "Customer complaints management",
      },
      complainant: {},
      complaints: [],
      message: "",
    };
  },
  mounted() {
    this.$emit("set-page-details", this.pageDetails);
    this.getAllComplaints();
  },
  methods: {
    getAllComplaints() {
      var _ = this;
      _.axios.defaults.headers.common["Authorization"] =
        "Bearer " + localStorage.getItem("access_token");
      _.axios
        .get("api/complaints")
        .then((response) => {
          _.complaints = response.data;
        })
        .catch((e) => {
          /* eslint-disable no-console */
          console.log(e);
          /* eslint-enable no-console */
        });
    },
    updateAction(id, _action) {
      var _ = this;
      var obj = {};
      obj.action = _action;
      _.axios.defaults.headers.common["Authorization"] =
        "Bearer " + localStorage.getItem("access_token");
      _.axios
        .put("api/complaint/" + id, obj)
        .then(() => {
          _.getAllComplaints();
          _.$toasted.show("Action Applied", {
            duration: 3000,
          });
        })
        .catch((e) => {
          /* eslint-disable no-console */
          console.log(e);
          /* eslint-enable no-console */
        });
    },
    sendMessage() {
      var _ = this;
      var dataToSend = {};
      dataToSend.first_name = _.complaint.complainant.first_name;
      dataToSend.last_name = _.complaint.complainant.last_name;
      dataToSend.email = _.complaint.complainant.email;
      dataToSend.message = _.message;
      _.axios.defaults.headers.common["Authorization"] =
        "Bearer " + localStorage.getItem("access_token");
      _.axios
        .post("api/complaints/inform_complainant", dataToSend)
        .then(() => {
          _.$toasted.show("Message Sent!", {
            duration: 4000,
          });
          _.updateAction(_.complaint.id, "informed");
          _.clearMsg();
        })
        .catch((e) => {
          /* eslint-disable no-console */
          console.log(e);
          /* eslint-enable no-console */
        });
    },
    clearMsg() {
      this.message = "";
      this.complaint = {};
    },
  },
  components: {
    // AlertModal,
  },
};
</script>

<style scoped>
.dropdown.open a {
  width: max-content;
}
</style>
