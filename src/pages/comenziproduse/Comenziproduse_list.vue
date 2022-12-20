<template>
        <base-page>
        <titlu-pagina Titlu="ComenziProduse" @on_add_clicked="show_dialog()" :AdaugaVisible='true' />
        <el-card style='margin:5px 0px 5px 0px'>
            <div slot="header" class="clearfix">
                <strong> Filtre </strong>
            </div>
            <div class="filtre">
                <el-form @submit.prevent.native='refresh_info()'>
                    <el-row :gutter="20">
                        
            <el-col :span='4'>
                <el-form-item label='Id' >
                    <el-input v-model='Filters.Id' />
                </el-form-item>
            </el-col>                        <el-col :md='24' >
                            <el-button type='primary' native-type='submit' @click='refresh_info()'> Aplica </el-button>
                        </el-col>

                    </el-row>
                </el-form>
                </div>
        </el-card>

<el-table :data="Results" >
    <el-table-column prop='Id' label='Id'></el-table-column><el-table-column prop='IdFactura' label='IdFactura'></el-table-column><el-table-column prop='IdProduse' label='IdProduse'></el-table-column><el-table-column fixed="right" label="Actiuni" width="200px" >
    <template slot-scope="scope" >

        <el-tooltip content="Modificare">
            <el-button type="primary" icon="el-icon-edit"  circle @click="show_dialog(scope.row.Id)" />
    </el-tooltip>

    <el-tooltip content="Sterge" >
        <el-button type="danger" icon="el-icon-delete" circle @click="delete_item(scope.row)" />
</el-tooltip>

</template>
</el-table-column>
</el-table>
<el-pagination @size-change="refresh_info" @current-change= "refresh_info" :page-size.sync="PaginationInfo.PerPage" :current-page.sync="PaginationInfo.Page" :total="PaginationInfo.RowCount" layout="pager" />
<Comenziproduse-dialog ref='dlg' @save="refresh_info()" />
</base-page>
</template>

<script>
import settings from "@/backend/LocalSettings";
import BasePage from "@/pages/BasePage";
import Comenziproduse_dialog from '@/pages/comenziproduse/Comenziproduse_dialog.vue';
import TitluPagina from '@/widgets/TitluPagina';

export default {
    name: "comenziproduse",
    extends: BasePage,
    components: {
        'base-page': BasePage,
        'Comenziproduse-dialog': Comenziproduse_dialog,
        'titlu-pagina': TitluPagina
    },
    data () {
        return {
            Results: [],
            base_url: '',
            Info: {
                            },
            Filters: {
                Id: '' ,             },
            OrderBy: { },
            PaginationInfo: { Page: 1, PerPage: 50, RowCount: 0, PageSizes: [10, 25, 50, 100, 200] },
        }
    },
    methods: {

        async get_info(){
            var response        = await this.post("comenziproduse/get_info" );
                        this.refresh_info();
        },

        async refresh_info(){
            var response        = await this.post("comenziproduse/index", { Filters: this.Filters, OrderBy: this.OrderBy, PaginationInfo: this.PaginationInfo } );
            this.Results        = response.Results;
            this.PaginationInfo = response.PaginationInfo;
            //
            this.select_menu_item('comenziproduse');
        },
        reset(){
            this.Filters = {
                Id: '' ,             };
            this.refresh_info();
        },


        async delete_item( item ){
            var confirm =  await this.$confirm(`Sunteti sigur ?`, 'Warning');
            if( confirm )
            {
                await this.post("comenziproduse/delete_item", { id: item.Id } );
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
