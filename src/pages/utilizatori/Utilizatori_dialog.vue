<template>
    <el-dialog title="Utilizatori" :visible.sync="showPopup" class="my-dialog-class" >
        <el-form label-position="top" :inline="false" :rules="rules" label-width="100%"  :model='selectedObject'  ref='my-form' @submit.prevent="save" v-loading="loadingVisible" >
            <el-row :gutter="15" >

                <el-col :span='8'>
                    <el-form-item label='Nume' >
                        <el-input  class='full-width' v-model='selectedObject.Nume' />
                    </el-form-item>
                </el-col>
                <el-col :span='8'>
                    <el-form-item label='Email' >
                        <el-input  class='full-width' v-model='selectedObject.Email' />
                    </el-form-item>
                </el-col>
                <el-col :span='8' v-if="mode=='add'">
                    <el-form-item label='Parola' >
                        <el-input  class='full-width' v-model='selectedObject.Parola' />
                    </el-form-item>
                </el-col>
                <el-col :span='8'>
                    <el-form-item label='Grup de drepturi' >
                        <el-select v-model='selectedObject.IdGrupDrepturi'  class='full-width'>        <el-option v-for='item in Info.rights_groups' :key="'rights-groups' + item.Id" :label='item.Name' :value='item.Id'></el-option>
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
        name: "Utilizatori_dialog",
        extends: BasePage,
        data () {
            return {
                showPopup: false,
                mode: 'add',
                selectedObject: {
                    Nume: '' , Email: '' , Parola: '' , IdGrupDrepturi: '' ,
                },
                Info:{
                    rights_groups: [],                 },
                rules: {
                    //   Nume: [ { required: true, message: "Campul este obligatoriu" } ]
                    Nume: [ { required: true, message: 'Campul este obligatoriu' } ],
                    Email: [ { required: true, message: 'Campul este obligatoriu' } ],
                    Parola: [ { required: true, message: 'Campul este obligatoriu' } ],
                    IdGrupDrepturi: [ { required: true, message: 'Campul este obligatoriu' } ],
                }
            }
        },
        methods: {
            show_me: async function( id ) {
                this.showPopup        = true;
                if( id == null )
                {
                    this.mode = "add";
                    this.selectedObject.Nume  = '';
                    this.selectedObject.Email = '';
                    this.selectedObject.Parola= '';
                }
                else
                {
                    this.mode             = "edit";
                    var            result = await this.post("utilizatori/get_info_item_dialog", { id: id } );
                    this.selectedObject   = result.Item;
                }
            },
            async get_info(){
                var response = await this.post("utilizatori/get_info_for_dialog" );
                this.Info.rights_groups = response.rights_groups;            },
            save: async function() {
                this.$refs['my-form'].validate( async(valid) => {
                    if (valid)
                    {
                        await this.post("utilizatori/save", { mode: this.mode, object: this.selectedObject } );
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