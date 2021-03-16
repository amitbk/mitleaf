import axios from "axios";
import alert from "./alert";
// import config from "../config.js";

export default {
  getTemplates: function(data) {
    return new Promise(function(resolve, reject) {
      let url = "/api/templates?";

      // filters
      for(var key in data.filters)
        url+= "&"+key+"="+data.filters[key];

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
