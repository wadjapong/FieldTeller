<template>
  <div class="modal fade" :id="identity" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content" :class="colour">
            <div class="modal-header">
                <h4 class="modal-title" id="defaultModalLabel">{{title}}</h4>
            </div>
            <div class="modal-body">
                {{message}}
            </div>
            <div class="modal-footer">
                <button type="button" :class="cancelButtonColour" class="btn waves-effect" data-dismiss="modal"><i class="material-icons">cancel</i> Cancel</button>
                <button type="button" :class="confirmButtonColour" @click="deleteData(data)" class="btn btn-danger waves-effect"><i class="material-icons">{{confirmButtonIcon}}</i> {{confirmButtonText}}</button>
            </div>
        </div>
    </div>
  </div>
</template>

<script>
export default {
  name: 'alertmodal',
  props: {
    title: {
      default: 'Delete Record'
    },
    message: {
      default: 'Are you sure you want to delete this record?'
    },
    colour: {
      default: 'modal-col-red'
    },
    identity: {
      default: 'alertModal'
    },
    confirmButtonText: {
      default: 'Delete'
    },
    confirmButtonIcon: {
      default: 'delete'
    },
    confirmButtonColour: {
      default: 'btn-danger'
    },
    cancelButtonColour: {
      default: 'btn-success'
    },
    data: {}
  },
  methods: {
    deleteData (data) {
      this.$emit('confirm-delete',data);
    }
  }
}
</script>

