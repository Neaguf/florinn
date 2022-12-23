<template>
  <base-page>
    <titlu-pagina
      Titlu="Facturi"
      @on_add_clicked="show_dialog()"
      :AdaugaVisible="true"
    />
    <el-card style="margin: 5px 0px 5px 0px">
      <div slot="header" class="clearfix">
        <strong> Filtre </strong>
      </div>
      <div class="filtre">
        <el-form @submit.prevent.native="refresh_info()">
          <el-row :gutter="20">
            <el-col :span="4">
              <el-form-item label="Serie">
                <el-input v-model="Filters.Serie" />
              </el-form-item>
            </el-col>
            <el-col :span="4">
              <el-form-item label="Numar">
                <el-input v-model="Filters.Numar" />
              </el-form-item>
            </el-col>
            <el-col :span="4">
              <el-form-item label="Data">
                <el-input v-model="Filters.Data" />
              </el-form-item>
            </el-col>
            <el-col :span="4">
              <el-form-item label="Nume">
                <el-input v-model="Filters.Nume" />
              </el-form-item>
            </el-col>
            <el-col :span="4">
              <el-form-item label="Prenume">
                <el-input v-model="Filters.Prenume" />
              </el-form-item>
            </el-col>
            <el-col :span="4">
              <el-form-item label="Cnp">
                <el-input v-model="Filters.Cnp" />
              </el-form-item>
            </el-col>
            <el-col :md="24">
              <el-button
                type="primary"
                native-type="submit"
                @click="refresh_info()"
              >
                Aplica
              </el-button>
            </el-col>
          </el-row>
        </el-form>
      </div>
    </el-card>

    <el-table :data="Results">
      <el-table-column prop="Serie" label="Serie"></el-table-column
      ><el-table-column prop="Id" label="Numar"></el-table-column
      ><el-table-column prop="Nume" label="Nume"></el-table-column
      ><el-table-column prop="Prenume" label="Prenume"></el-table-column
      ><el-table-column prop="Data" label="Data"></el-table-column
      ><el-table-column fixed="right" label="Actiuni" width="200px">
        <template slot-scope="scope">
          <el-tooltip content="Modificare">
            <el-button
              type="primary"
              icon="el-icon-edit"
              circle
              @click="show_dialog(scope.row.Id)"
            />
          </el-tooltip>

          <el-tooltip content="Sterge">
            <el-button
              type="danger"
              icon="el-icon-delete"
              circle
              @click="delete_item(scope.row)"
            />
          </el-tooltip>
          <el-tooltip content="Printare">
            <el-button
              type="info"
              icon="el-icon-printer"
              circle
              @click="print_factura(scope.row.Id)"
            />
          </el-tooltip>
        </template>
      </el-table-column>
    </el-table>
    <el-pagination
      @size-change="refresh_info"
      @current-change="refresh_info"
      :page-size.sync="PaginationInfo.PerPage"
      :current-page.sync="PaginationInfo.Page"
      :total="PaginationInfo.RowCount"
      layout="pager"
    />
    <Facturi-dialog ref="dlg" @save="refresh_info()" />
  </base-page>
</template>

<script>
import settings from "@/backend/LocalSettings";
import BasePage from "@/pages/BasePage";
import Facturi_dialog from "@/pages/facturi/Facturi_dialog.vue";
import TitluPagina from "@/widgets/TitluPagina";

export default {
  name: "facturi",
  extends: BasePage,
  components: {
    "base-page": BasePage,
    "Facturi-dialog": Facturi_dialog,
    "titlu-pagina": TitluPagina,
  },
  data() {
    return {
      Results: [],
      base_url: "",
      Info: {},
      Filters: {
        Serie: "",
        Numar: "",
        Data: "",
        Nume: "",
        Prenume: "",
        Cnp: "",
      },
      OrderBy: {},
      PaginationInfo: {
        Page: 1,
        PerPage: 50,
        RowCount: 0,
        PageSizes: [10, 25, 50, 100, 200],
      },
    };
  },
  methods: {
    async get_info() {
      var response = await this.post("facturi/get_info");
      this.refresh_info();
    },

    async refresh_info() {
      var response = await this.post("facturi/index", {
        Filters: this.Filters,
        OrderBy: this.OrderBy,
        PaginationInfo: this.PaginationInfo,
      });
      this.Results = response.Results;
      this.PaginationInfo = response.PaginationInfo;
      //
      this.select_menu_item("facturi");
    },
    reset() {
      this.Filters = {
        Serie: "",
        Numar: "",
        Data: "",
        Nume: "",
        Prenume: "",
        Cnp: "",
      };
      this.refresh_info();
    },

    async delete_item(item) {
      var confirm = await this.$confirm(`Sunteti sigur ?`, "Warning");
      if (confirm) {
        await this.post("facturi/delete_item", { id: item.Id });
        this.refresh_info();
      }
    },

    show_dialog(id) {
      this.$refs.dlg.show_me(id);
    },
    async print_factura(idFactura) {
      //   await this.get("/api/index.php/factura/" + idFactura);
      window.open(settings.BASE_URL + "/factura/" + idFactura);
    },
  },
  mounted() {
    this.base_url = settings.BASE_URL;
    this.get_info();
  },
};
</script>

<style lang="less" scoped>
.top50 {
  margin-top: 20px;
}

.filtre {
  .el-input-number {
    width: 100% !important;
  }
}
</style>
