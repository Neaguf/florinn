<template>
    <el-dialog title="Drepturi" :visible.sync="showPopup" class="my-dialog-class" >
        <el-form label-position="top" :inline="false" :rules="rules" label-width="100%"  :model='selectedObject'  ref='my-form' @submit.prevent="save" v-loading="loadingVisible" >
            <el-row :gutter="15" >

                <el-col :span='8'>
                    <el-form-item label='Nume' >
                        <el-input  class='full-width' v-model='selectedObject.Name' />
                    </el-form-item>
                </el-col>
                <el-col :span='8'>
                    <el-form-item label='Key' >
                        <el-input  class='full-width' v-model='selectedObject.Key' />
                    </el-form-item>
                </el-col>
                <el-col :span='8'>
                    <el-form-item label='Categorie' >
                        <el-select v-model='selectedObject.CategoryId'  class='full-width'>        <el-option v-for='item in Info.rights_category' :key="'rights-category' + item.Id" :label='item.Name' :value='item.Id'></el-option>
                        </el-select>
                    </el-form-item>
                </el-col>            </el-row>
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
        name: "Drepturi_dialog",
        extends: BasePage,
        data () {
            return {
                showPopup: false,
                mode: 'add',
                selectedObject: {
                    Name: '' , Key: '' , CategoryId: '' ,
                },
                Info:{
                    rights_category: [],
                },
                rules: {
                    //   Nume: [ { required: true, message: "Campul este obligatoriu" } ]
                    Name: [ { required: true, message: 'Campul este obligatoriu' } ],
                    Key: [ { required: true, message: 'Campul este obligatoriu' } ],
                    CategoryId: [ { required: true, message: 'Campul este obligatoriu' } ],
                }
            }
        },
        methods: {
            show_me: async function( id ) {
                this.showPopup        = true;
                if( id == null )
                {
                    this.mode                = "add";
                    this.selectedObject.Name = '';
                    this.selectedObject.Key  = '';
                }
                else
                {
                    this.mode             = "edit";
                    var            result = await this.post("drepturi/get_info_item_dialog", { id: id } );
                    this.selectedObject   = result.Item;
                }
            },
            async get_info(){
                var response = await this.post("drepturi/get_info_for_dialog" );
                this.Info.rights_category = response.rights_category;            },
            save: async function() {
                this.$refs['my-form'].validate( async(valid) => {
                    if (valid)
                    {
                        await this.post("drepturi/save", { mode: this.mode, object: this.selectedObject } );
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