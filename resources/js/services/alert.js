import axios from "axios";
// import config from "../config.js";

export default {

  success: function(title) {
    window.Vue.swal({
      position: 'top-end',
      icon: 'success',
      title: title,
      showConfirmButton: false,
      timer: 1500
    })
  },
  deleteSuccess: function(label = 'Record') {
      window.Vue.swal(
      'Deleted!',
      label+' has been deleted.',
      'success'
    )
  },
  deleteConfirm: function() {
    return new Promise(function(resolve, reject) {

      window.Vue.swal({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
      }).then((result) => {
        if (result.isConfirmed) {

          resolve(true)
        } else resolve(false)
      })

    })
  },

}
