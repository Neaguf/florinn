<template>
<div>
    <b-navbar class='nav-on-top' toggleable="md" type="dark" variant="dark" >
        <b-navbar-toggle target="nav_collapse" />
        <b-navbar-brand href="#" >
            <img src="../assets/logo.png" alt="logo" style="max-height: 20px;" />
        </b-navbar-brand>
        <b-collapse is-nav id="nav_collapse" >
            
            <b-navbar-nav class='menu-bar'>
                <b-nav-item href="#/dashboard" class='dashboard'> Dashboard </b-nav-item>
                
                <!-- aici inseram restul de elemente din meniu -->

                <b-nav-item @click="onLogout()"  > Iesire cont</b-nav-item>
            </b-navbar-nav>
        </b-collapse>
    </b-navbar>
</div>
              
</template>

<script>

import settings from '@/backend/LocalSettings';

export default {
  name: 'Login',
  data () {
    return { 
      user_type: ''
    }
  },
  components: {
  },
  methods: 
  {
    post: async function(url, args={}){
      this.loadingVisible      = true;
      var             response = await this.$http.post(url, args );
      this.loadingVisible      = false;
      if( settings.verify_response(response) )
      {
        return response.body;
      } 
      else 
      {
        this.$router.push("/");
      }
    },

    handleSelect: function(item)
    {
        console.log(item);
    },

    async onLogout()
    {
        settings.logout();
        this.$router.push("/");
    }
  },
  mounted()
  {
    this.user_type    = settings.get_user_type();
  }
}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style lang="less">
.nav-on-top{
    z-index:1000;
}

.navbar{
  margin-top: 20px;
}

.bg-dark{
  background-color: #152e33 !important;
}

.navbar-dark .navbar-nav .nav-link{
    color: #44b0cc;
    text-transform: uppercase;
    font-size: 12px;
}

.navbar-dark .active .nav-link{
    background-color: #0d7aa3;
    color: white;
}

</style>
