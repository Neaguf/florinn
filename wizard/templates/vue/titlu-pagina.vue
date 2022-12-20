<template>
    <div class='titlu'>
        <el-row>
            <el-col :span="20">
                <h1> {{Titlu}} </h1>
            </el-col>
            <el-col :span="4" v-if="AdaugaVisible">
                <el-button type='primary' class='btn-adauga' @click="on_add_clicked" icon='el-icon-plus'> {{AdaugaText}} </el-button>
            </el-col>
        </el-row>
    </div>
</template>

<script>

import settings from '@/backend/LocalSettings';

export default {
  name: 'TitluPagina',
  props:{
      Titlu: "",
      AdaugaText: "Adauga",
      AdaugaVisible: true
  },
  data () {
    return { 
    }
  },
  methods: 
  {
    on_add_clicked: function(){
        this.$emit('on_add_clicked');
    },
  }
}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped lang="less">


</style>
