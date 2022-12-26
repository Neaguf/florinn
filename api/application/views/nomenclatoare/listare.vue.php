<template>
    <?php /* @var NomenclatorInfo $info */ ?>
    <base-page>
        <titlu-pagina Titlu="<?=$info->nume_nomenclator?>" @on_add_clicked="show_dialog()" :AdaugaVisible='true' />
        <el-card style='margin:5px 0px 5px 0px'>
            <div slot="header" class="clearfix">
                <strong> Filtre </strong>
            </div>
            <div class="filtre">
                <el-form @submit.prevent='refresh_info()'>
                    <el-row :gutter="20">
                        <?php
                        foreach( $info->Filtre as $f) {
                            /* @var Filtru $f */
                            echo $f->get_cod();
                        }
                        ?>
                        <el-col :span='24' >
                            <el-button type='primary' native-type='submit' @click='refresh_info()'> Aplica </el-button>
                        </el-col>

                    </el-row>
                </el-form>
                </div>
        </el-card>

<el-table :data="Results" >
    <?php
    foreach( $info->ColoaneListare as $c) {
        /* @var ColoanaListare $c */
        echo $c->get_cod();
    }
    ?>
<el-table-column fixed="right" label="Actiuni" width="200px" >
    <template slot-scope="scope" >

        <el-tooltip content="Modificare" >
            <el-button type="primary" icon="el-icon-edit"  circle @click="show_dialog(scope.row.Id)" />
    </el-tooltip>

    <el-tooltip content="Sterge" >
        <el-button type="danger" icon="el-icon-delete" circle @click="delete_item(scope.row)" />
</el-tooltip>

</template>
</el-table-column>
</el-table>
<el-pagination @size-change="refresh_info" @current-change= "refresh_info" :page-size.sync="PaginationInfo.PerPage" :current-page.sync="PaginationInfo.Page" :total="PaginationInfo.RowCount" layout="pager" />
<<?=$info->slug_dialog_tag?> ref='dlg' @save="refresh_info()" />
</base-page>
</template>

<script>
import settings from "@/backend/LocalSettings";
import BasePage from "@/pages/BasePage";
import <?=$info->slug_dialog?> from '@/pages/<?=$info->slug_nomenclator?>/<?=$info->vue_dialog_file_name?>';
import TitluPagina from '@/widgets/TitluPagina';

export default {
    name: "<?=$info->slug_nomenclator?>",
    extends: BasePage,
    components: {
        'base-page': BasePage,
        '<?=$info->slug_dialog_tag?>': <?=$info->slug_dialog?>,
        'titlu-pagina': TitluPagina
    },
    data () {
        return {
            Results: [],
            base_url: '',
            Info: {
                <?php
                foreach( $info->Filtre as $f) {
                    /* @var Filtru $f */
                    $text = $f->get_nume_din_array_info();
                    if(!empty($text)) echo $text.": [], ";
                }
                ?>
            },
            Filters: {
                <?php
                foreach( $info->Filtre as $f) {
                    /* @var Filtru $f */
                    $text = $f->get_cod_din_array_filtre();
                    echo "{$text}, ";
                }
                ?>
            },
            OrderBy: { },
            PaginationInfo: { Page: 1, PerPage: 50, RowCount: 0, PageSizes: [10, 25, 50, 100, 200] },
        }
    },
    methods: {

        async get_info(){
            var response        = await this.post("<?=$info->slug_nomenclator?>/get_info" );
            <?php
            foreach( $info->Filtre as $f) {
                /* @var Filtru $f */
                $text = $f->get_cod_din_get_info();
                if(!empty($text)) echo $text.PHP_EOL;
            }
            ?>
            this.refresh_info();
        },

        async refresh_info(){
            var response        = await this.post("<?=$info->slug_nomenclator?>/index", { Filters: this.Filters, OrderBy: this.OrderBy, PaginationInfo: this.PaginationInfo } );
            this.Results        = response.Results;
            this.PaginationInfo = response.PaginationInfo;
            //
            this.select_menu_item('<?=$info->slug_nomenclator?>');
        },
        reset(){
            this.Filters = {
                <?php
                foreach( $info->Filtre as $f) {
                    /* @var Filtru $f */
                    $text = $f->get_cod_din_array_filtre();
                    echo "{$text}, ";
                }
                ?>
            };
            this.refresh_info();
        },


        async delete_item( item ){
            var confirm =  await this.$confirm(`Sunteti sigur ?`, 'Warning');
            if( confirm )
            {
                await this.post("<?=$info->slug_nomenclator?>/delete_item", { id: item.Id } );
                this.refresh_info();
            }
        },

        show_dialog(id){
            this.$refs.dlg.show_me(id);
        }
    },
    mounted(){
        this.base_url = settings.BASE_URL;
        this.get_info();
    }
};
</script>

<style lang="less" scoped>

    .top50{
        margin-top: 20px;
    }

    .filtre{
        .el-input-number
        {
            width: 100% !important;
        }
    }

</style>
