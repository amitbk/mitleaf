import axios from "axios";
import alert from "./alert";
// import config from "../config.js";

export default {
  getPosts: function(data) {
    return new Promise(function(resolve, reject) {
      let url = "/api/posts?";
      if(data.firm_id) url += "firm_id="+ data.firm_id;
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

  deletePost: function(id) {
    let self = this;
    return new Promise(function(resolve, reject) {
      let url = "/api/posts/"+id;

      alert.deleteConfirm().then(r => {
        if(!!r) {
          axios.delete( url )
            .then(response => {
              alert.deleteSuccess('Post');
              resolve(response);
            })
            .catch(e => {
              console.error("Error: ", e);
              reject(e.response.data.message);
            });
        }
      })



    });
  },

  groupByDate: function(posts) {
    // groupBy Date
    let groupByDate = [];
    posts.filter(el => {
      let post_date = el.schedule_on.split(' ')[0]
      if(!groupByDate[post_date])
        groupByDate[post_date] = [];

      groupByDate[post_date].push(el);
    })
    return groupByDate;
  }
}
