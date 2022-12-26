<template>
    <?php /* @var NomenclatorInfo $info */ ?>
    <el-dialog title="<?=$info->nume_nomenclator?>" :visible.sync="showPopup" class="my-dialog-class" >
        <el-form label-position="top" :inline="false" :rules="rules" label-width="100%"  :model='selectedObject'  ref='my-form' @submit.prevent="save" v-loading="loadingVisible" >
            <el-row :gutter="15" >
                <?php
                    foreach($info->EditFields as $ed){
                        /* @var EditField $ed */
                        echo $ed->get_cod();
                    }
                ?>
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
        name: "<?=$info->slug_dialog?>",
        extends: BasePage,
        data () {
            return {
                showPopup: false,
                mode: 'add',
                selectedObject: {
                    <?php
                        foreach($info->EditFields as $ed)
                        {
                            /* @var EditField $ed */
                            $text = $ed->get_cod_din_array_default();
                            echo "{$text}, ";
                        }
                    ?>
                },
                Info:{
                    <?php
                        foreach($info->EditFields as $ed)
                        {
                            /* @var EditField $ed */
                            $text = $ed->get_nume_din_array_info();
                            if(!empty($text)) echo "{$text}: [], ";
                        }
                    ?>
                },
                rules: {
                    //   Nume: [ { required: true, message: "Campul este obligatoriu" } ]
                    <?php
                    foreach($info->EditFields as $ed)
                    {
                        /* @var EditField $ed */
                        $coloana    = $ed->nume_coloana_din_db;
                        $required   = $ed->required ? 'true' : 'false';
                        echo "{$coloana}: [ { required: {$required}, message: 'Campul este obligatoriu' } ], ".PHP_EOL;
                    }
                    ?>
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
                    var            result = await this.post("<?=$info->slug_nomenclator?>/get_info_item_dialog", { id: id } );
                    this.selectedObject   = result.Item;
                }
            },
            async get_info(){
                var response = await this.post("<?=$info->slug_nomenclator?>/get_info_for_dialog" );
                <?php
                foreach($info->EditFields as $ed)
                {
                    /* @var EditField $ed */
                    echo $ed->get_cod_din_get_info();
                }
                ?>
            },
            save: async function() {
                this.$refs['my-form'].validate( async(valid) => {
                    if (valid)
                    {
                        await this.post("<?=$info->slug_nomenclator?>/save", { mode: this.mode, object: this.selectedObject } );
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