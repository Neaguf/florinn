<template>
    <el-dialog title="NUME_NOMENCLATOR" :visible.sync="showPopup" class="my-dialog-class" >
        <el-form label-position="top" :inline="false" :rules="rules" label-width="100%"  :model='selectedObject'  ref='my-form' @submit.prevent="save" v-loading="loadingVisible" >
            <el-row :gutter="15" >
                FIELDURI_EDITABILE
            </el-row>
        </el-form>
        <span slot="footer" class="dialog-footer" >
            <el-button @click="showPopup=false"     > Renunta  </el-button>
            <el-button type="primary" @click="save" > Salveaza </el-button>
        </span>
    </el-dialog>
</template>

<script>
import settings from "@/backend/LocalSettings";
import BasePage from '@/pages/BasePage';

export default {
  name: "SLUG_DIALOG",
  extends: BasePage,
  data () {
    return { 
      showPopup: false,
      mode: 'add',
      selectedObject: { FIELDURI },
      info:{
FIELDURI_INFO
      },
      rules: {
        //   Nume: [ { required: true, message: "Campul este obligatoriu" } ]
      }
    }
  },
  methods: {
     show_me: async function( id ) {
        this.showPopup        = true;
        if( id == null ) 
        {
            this.mode = "add";
        }
        else
        {
            this.mode             = "edit";
            var            result = await this.post("SLUG_NOMENCLATOR/get_info_item_dialog", { id: id } );
            this.selectedObject   = result.Item;
        }
    },
    async get_info(){
      PRELUARE_INFO
    },
    save: async function() {
        this.$refs['my-form'].validate( async(valid) => {
          if (valid) 
          {
            await this.post("SLUG_NOMENCLATOR/save", { mode: this.mode, object: this.selectedObject } );
            this.showPopup = false;
            this.$emit("save");
          }
        });
    }
  },
  mounted: function() {
      this.get_info();
  }
};
</script>

<style lang="less" scoped>
    .full-width {
        width: 100%;
    }
    
</style>