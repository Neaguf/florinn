import Vue from "vue";

export default {
	version: "1.0",
	BASE_URL: 'BASE_URL_STRING',

	set_token: function(newToken) {
		window.localStorage.setItem("PROIECT_SLUG-token", newToken);
		Vue.http.headers.common["Token"] = newToken;
	},
    
  get_token: function() {
		return window.localStorage.getItem("PROIECT_SLUG-token");
	},

	set_user_type: function(newUserType) {
		window.localStorage.setItem("PROIECT_SLUG-user-type", newUserType);
	},
    
  get_user_type: function() {
		return window.localStorage.getItem("PROIECT_SLUG-user-type");
	},
    
  is_logged_in: function() {
		var token = this.get_token();
		return token !== "";
	},
    
    logout: function() {
		this.set_token("");
	},
    
    verify_response: function(response) {
		if (response.body.NotLogged) {
			return false;
		}
		return true;
    },
    
	verify_login_and_redirect: function(vueInstance) {
		if (!this.is_logged_in()) {
			vueInstance.$router.push("/");
		}
	},
};
