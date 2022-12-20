<template>
    <el-dialog title="Grupuri_utilizatori" :visible.sync="showPopup" class="my-dialog-class" >
        <el-form label-position="top" :inline="false" :rules="rules" label-width="100%"  :model='selectedObject'  ref='my-form' @submit.prevent="save" v-loading="loadingVisible" >
            <el-row :gutter="15" >

                <el-col :span='24'>
                    <el-form-item label='Name' >
                        <el-input  class='full-width' v-model='selectedObject.Name' />
                    </el-form-item>
                </el-col>

                <el-col :span="12" v-for="c in Info.CategoriiDrepturi" :key="'categorie' + c.Id" class="grid-item">
                    <el-card class="box-card">
                        <div slot="header" class="clearfix">
                            <strong>{{c.Name}}</strong>
                        </div>
                        <div v-for="d in c.Drepturi" :key="'drept' + d.Id" class="text item">
                            <el-checkbox v-model="d.Bifat">{{d.Name}}</el-checkbox>
                        </div>
                    </el-card>
                </el-col>

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
        name: "Grupuri_utilizatori_dialog",
        extends: BasePage,
        data () {
            return {
                showPopup: false,
                mode: 'add',
                selectedObject: {
                    Name: '' ,
                },
                Info:{
                    CategoriiDrepturi: []
                },
                rules: {
                    Name: [ { required: true, message: 'Campul este obligatoriu' } ],
                }
            }
        },
        methods: {
            show_me: async function( id ) {
                this.showPopup        = true;
                this.Info.CategoriiDrepturi.forEach(c => {
                    c.Drepturi.forEach(d => {
                        d.Bifat = false;
                    });
                });
                if( id == null )
                {
                    this.mode                = "add";
                    this.selectedObject.Name = '';
                }
                else
                {
                    this.mode             = "edit";
                    var            result = await this.post("grupuri_utilizatori/get_info_item_dialog", { id: id } );
                    this.selectedObject   = result.Item;
                    var bifate            = result.Bifate;
                    bifate.forEach(id_bifat => {
                        this.Info.CategoriiDrepturi.forEach(c => {
                            c.Drepturi.forEach(d => {
                                if( d.Id == id_bifat ) d.Bifat = true;
                            });
                        });
                    });
                }
                this.change_heights();
                setTimeout(() => {
                    this.change_heights();
                }, 500);
            },
            async get_info(){
                var       response          = await this.post("grupuri_utilizatori/get_info_for_dialog" );
                this.Info.CategoriiDrepturi = response.CategoriiDrepturi;
            },

            change_heights(){
              var panels     = document.querySelectorAll(".grid-item");
              var max_height = 0;
              for( var i = 0 ; i < panels.length; i++ ){
                  var panel = panels[i];
                  var height = panel.clientHeight;
                  if( height > max_height ) max_height = height;
              }
                for( var i = 0 ; i < panels.length; i++ )
                {
                    var panel = panels[i];
                    panel.style.height = max_height  + "px";
                }
            },
            save: async function() {
                this.$refs['my-form'].validate( async(valid) => {
                    if (valid)
                    {
                        var drepturi_bifate = [];
                        this.Info.CategoriiDrepturi.forEach(c => {
                            c.Drepturi.forEach(d => {
                                if( d.Bifat ) drepturi_bifate.push( d.Id );
                            });
                        });
                        await this.post("grupuri_utilizatori/save", { mode: this.mode, object: this.selectedObject, drepturi: drepturi_bifate } );
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
    .grid-item{
        padding-top: 10px;
        min-height: 200px;
        .el-card{
            height:100%;
        }
    }

</style>