<template>
  <el-container style="height: 100%;">
    <el-header style="height: 60px;" >
        <top-bar ref='meniul'/>
    </el-header>

    <el-container style="padding: 30px 20px;" >
        <el-main style="text-align:left; padding: 0px;" v-loading='loadingVisible' >
            <slot/>
        </el-main>
    </el-container>
  </el-container>
    
</template>

<script>
import settings from "./../backend/LocalSettings";
import TopBar from '@/widgets/TopBar';


export default {
  name: "base-page",
  components: { 
      'top-bar' : TopBar
  },
  data () {
    return { 
      loadingVisible: false
    }
  },
  methods: {
    post: async function(url, args={}){
      this.loadingVisible      = true;
      var             response = await this.$http.post(url, args );
      this.loadingVisible      = false;
      if( settings.verify_response(response) )
      {
        return response.body;
      } else {
        this.$router.push("/");
      }
    },
    select_menu_item(name){
      var menu  = document.getElementsByClassName('menu-bar').item(0);
      var items = menu.getElementsByTagName("li");
      for( var i = 0; i < items.length; i++ ){
        var item = items.item(i);
        item.classList.remove('active');
        if( item.classList.contains(name) )
        {
          item.classList.add('active');
        }
      };
    }
  },
  mounted: function() {
    settings.verify_login_and_redirect(this);
  }
};
</script>

<style scoped>
  
</style>