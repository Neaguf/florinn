<template>
  <div>
    <b-navbar class="nav-on-top" toggleable="lg" type="dark" variant="dark">
      <b-navbar-brand href="#">
        <img src="../assets/logo.png" alt="logo" style="max-height: 20px" />
      </b-navbar-brand>

      <b-navbar-toggle target="nav_collapse"></b-navbar-toggle>

      <b-collapse is-nav id="nav_collapse" class="menu-bar">
        <b-navbar-nav>
          <b-nav-item href="#/dashboard" class="dashboard">
            Dashboard
          </b-nav-item>
          <!-- start aici inseram restul de elemente din meniu -->

          <b-nav-item href="#/facturi" class="facturi"> Facturi </b-nav-item>
          <b-nav-item href="#/produse" class="produse"> Produse </b-nav-item>

          <!-- end aici inseram restul de elemente din meniu -->
        </b-navbar-nav>

        <b-navbar-nav class="ml-auto">
          <b-nav-item-dropdown text="Utilizatori si drepturi" right>
            <b-dropdown-item href="#/utilizatori">Utilizatori</b-dropdown-item>
            <b-dropdown-item href="#/grupuri-utilizatori"
              >Grupuri utilizatori</b-dropdown-item
            >
            <b-dropdown-item href="#/categorii-drepturi"
              >Categorii drepturi</b-dropdown-item
            >
            <b-dropdown-item href="#/drepturi">Drepturi</b-dropdown-item>
          </b-nav-item-dropdown>

          <b-nav-item @click="change_password()"> Schimbare parola</b-nav-item>

          <b-nav-item @click="onLogout()" right> Iesire cont</b-nav-item>
        </b-navbar-nav>
      </b-collapse>
    </b-navbar>
    <change-password-dialog ref="changePassDlg"></change-password-dialog>
  </div>
</template>

<script>
import settings from "@/backend/LocalSettings";
import ChangePassword_dialog from "@/pages/ChangePassword_dialog";

export default {
  name: "Login",
  data() {
    return {
      user_type: "",
    };
  },
  components: {
    "change-password-dialog": ChangePassword_dialog,
  },
  methods: {
    post: async function (url, args = {}) {
      this.loadingVisible = true;
      var response = await this.$http.post(url, args);
      this.loadingVisible = false;
      if (settings.verify_response(response)) {
        return response.body;
      } else {
        this.$router.push("/");
      }
    },

    change_password: function () {
      this.$refs["changePassDlg"].show_me();
    },

    handleSelect: function (item) {
      console.log(item);
    },

    async onLogout() {
      settings.logout();
      this.$router.push("/");
    },
  },
  mounted() {
    this.user_type = settings.get_user_type();
  },
};
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style lang="less">
.navbar-dark .navbar-nav .nav-link:hover,
.navbar-dark .navbar-nav .nav-link:focus,
.navbar-dark .navbar-nav .show > .nav-link,
.navbar-dark .navbar-nav .nav-link.active {
  color: hsl(193, 11%, 34%) !important;
  opacity: 0.5 !important;
}

.navbar-toggler {
  background-color: hsl(193, 11%, 34%) !important;
}

.el-header {
  padding: 0;
}
.nav-on-top {
  width: 100%;
  z-index: 1000;
}

.navbar {
  width: 100%;
  padding: 10px;
}

.bg-dark {
  background-color: hsla(0, 0%, 100%, 0.9) !important;
}

.navbar-dark .navbar-nav .nav-link {
  color: hsl(193, 11%, 34%);
  text-transform: uppercase;
  margin: 0 5.5px;
  font-size: 13px;
  transition: 0.3s;
}

#navbar-toggler-icon,
.navbar-toggler {
  color: hsl(193, 11%, 34%) !important;
}

.navbar,
.navbar-dark {
  box-shadow: 0 0.3px 0.5px 0 rgba(0, 0, 0, 0.2),
    0 3px 5px 0 rgba(0, 0, 0, 0.19);
}

.navbar-dark .active .nav-link {
  background-color: hsla(193, 11%, 34%, 0.126);
  border-radius: 10px;
  color: hsl(193, 11%, 34%) !important;
}

.dropdown-menu {
  border: none;
  box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
}

.dropdown-item {
  color: hsl(193, 11%, 34%) !important;
}

.menu-bar,
.navbar-collapse,
.collapse {
  width: 100% !important;
}
</style>
