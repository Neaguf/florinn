<template>
  <base-page>
    <titlu-pagina Titlu="Dashboard" :AdaugaVisible='false'></titlu-pagina>
    
    <el-card style='margin:5px 0px 5px 0px'>
      <div slot="header" class="clearfix">
        <strong>Dashboard</strong>
      </div>
      <div>
          <p>continut dashboard</p>
      </div>
    </el-card>
</base-page>        

</template>

<script>
import settings from "../backend/LocalSettings";
import BasePage from "../pages/BasePage";
import TitluPagina from '../widgets/TitluPagina';

export default {
  name: "dashboard",
  extends: BasePage,
  components: {
      'base-page'   : BasePage,
      'titlu-pagina': TitluPagina
  },
  data () {
    return { 
    }
  },
  methods: {
    async get_info(){
      this.refresh_info();
    },

    async refresh_info(){
      this.select_menu_item('dashboard');
    },

  },
  mounted(){
    this.get_info();
  }
};
</script>

<style lang="less" scoped>

  .top50{
    margin-top: 20px;
  }
 
</style>
