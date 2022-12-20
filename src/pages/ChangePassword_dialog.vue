<template>
    <el-dialog title="Schimbare parola" :visible.sync="showPopup" class="my-dialog-class" >
        <el-form label-position="top" :inline="false" :rules="rules" label-width="100%"  :model='selectedObject'  ref='my-form' @submit.prevent="save"  >
            <el-row :gutter="15" >

                <el-col :span='8'>
                    <el-form-item label='Parola veche' >
                        <el-input show-password  class='full-width' v-model='selectedObject.OldPassword' :autofocus="true"/>
                    </el-form-item>
                </el-col>
                <el-col :span='8'>
                    <el-form-item label='Parola noua' >
                        <el-input show-password class='full-width' v-model='selectedObject.NewPassword' />
                    </el-form-item>
                </el-col>
                <el-col :span='8'>
                    <el-form-item label='Repeta parola noua' >
                        <el-input show-password class='full-width' v-model='selectedObject.NewPassword2' />
                    </el-form-item>
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

    export default {
        name: "ChangePassword_dialog",
        data () {
            return {
                showPopup: false,
                selectedObject: {
                    OldPassword: '' , NewPassword: '' , NewPassword2: ''
                },
                Info:{
                },
                rules: {
                    OldPassword:  [ { required: true, message: 'Campul este obligatoriu' } ],
                    NewPassword:  [ { required: true, message: 'Campul este obligatoriu' } ],
                    NewPassword2: [ { required: true, message: 'Campul este obligatoriu' } ]
                }
            }
        },
        methods: {
            show_me: async function(  ) {
                this.showPopup                   = true;
                this.selectedObject.OldPassword  = '';
                this.selectedObject.NewPassword  = '';
                this.selectedObject.NewPassword2 = '';
            },
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
            save: async function() {
                this.$refs['my-form'].validate( async(valid) => {
                    if (valid)
                    {
                        var response = await this.post("utilizatori/change_password", { info: this.selectedObject } );
                        if( response.HasError == false )
                        {
                            this.$message( { message: "Parola schimbaa cu success!", type: 'success'  });
                            this.showPopup = false;
                        }
                        else
                        {
                            this.$message.error( response.Error );
                        }
                    }
                });
            }
        },
        mounted: function() {
        }
    };
</script>

<style lang="less" scoped>
    .full-width {
        width: 100%;
    }

</style>