<template>
    <div id="app">
        <router-view/>
    </div>
</template>

<script>
import settings from "@/backend/LocalSettings";

export default {
  name: 'App',
  methods:
  {
    async check_version()
    {
      var local_version  = settings.version;
      var server_version = await this.post("version");
      if( local_version != server_version )
      {
        this.$notify({
          title: 'Atentie',
          message: 'A aparut o noua versiune - <button onclick="window.location.reload()">Upgrade</button> ',
          dangerouslyUseHTMLString: true,
          type: 'warning',
          duration: 0
        });
      }
    },
    post: async function(url, args={}){
      var response = await this.$http.post(url, args );
      return response.bodyText;
    },
  },
  mounted()
  {
    //verificam daca exista o versiune mai noua  
    this.check_version();
  }
}
</script>

<style lang='less'>

@albastru-deschis: #44b0cc;

.text-albastru{
  color: @albastru-deschis;
}

.bg-albastru{
  background-color: @albastru-deschis;
}

div.titlu{
  background-color: #0d7aa3;
  h1{
    color: white;
    padding: 8px 15px;
    font-family: 'Lato', sans-serif;
    font-weight: 300;
  }
  .btn-adauga{
    float: right;
    height: 72px;
    padding-left: 50px;
    padding-right: 50px;
    background: #34c2e4; /* Old browsers */
    background: -moz-linear-gradient(top, #34c2e4 0%, #42b6df 50%, #4fabda 100%); /* FF3.6-15 */
    background: -webkit-linear-gradient(top, #34c2e4 0%,#42b6df 50%,#4fabda 100%); /* Chrome10-25,Safari5.1-6 */
    background: linear-gradient(to bottom, #34c2e4 0%,#42b6df 50%,#4fabda 100%); /* W3C, IE10+, FF16+, Chrome26+, Opera12+, Safari7+ */
    filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#34c2e4', endColorstr='#4fabda',GradientType=0 ); /* IE6-9 */
    border: none;
    border-radius: 0%;
    margin: 2px;
  }
}


html {
  height: 100%;
  background-position: center;
  background-size: cover;
  background-position: fixed;
  background-image: linear-gradient(to bottom, #30c6e6 0%, rgba(84, 167, 216, 0.6) 100%), url(./assets/login-bg.jpg);
  font-family: "Avenir", Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
}
body{
  background-color: transparent !important;
}
.my-dialog-class .el-dialog{
  width: 70%;
}
.full-width{
  width: 100%;
}
 .el-table td
  {
    padding: 2px 0px !important;
  }


</style>
