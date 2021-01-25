import axios from "axios";
// import config from "../config.js";

export default {
  getPosts: function(data) {
    return new Promise(function(resolve, reject) {
      let url = "/api/posts/";
      if(data.firm_id) url += + data.firm_id;
      axios
        .get( url )
        .then(response => {
          console.log("response -- ", response.data);
          resolve(response);
        })
        .catch(e => {
          console.error("Error: ", e);
          reject(e.response.data.message);
        });
    });
  },
}
