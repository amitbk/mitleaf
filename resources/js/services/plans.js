import axios from "axios";
export default {
  getPlans: function(data) {
    return new Promise(function(resolve, reject) {
      let url = "/api/plans?";

      axios.get( url )
        .then(response => {
          resolve(response);
        })
        .catch(e => {
          console.error("Error: ", e);
          reject(e.response.data.message);
        });
    });
  },



}
