<template>
  <base-page>
    <titlu-pagina
      Titlu="Masini"
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
              <el-form-item label="Masina">
                <el-input v-model="Filters.Masina" />
              </el-form-item>
            </el-col>
            <el-col :span="4">
              <el-form-item label="Model">
                <el-input v-model="Filters.Model" />
              </el-form-item>
            </el-col>
            <el-col :span="4">
              <el-form-item label="Culoare">
                <el-input v-model="Filters.Culoare" />
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
      <el-table-column prop="Marca" label="Marca"></el-table-column
      ><el-table-column prop="Model" label="Model"></el-table-column
      ><el-table-column prop="Culoare" label="Culoare"></el-table-column
      ><el-table-column prop="Disponibil" label="Disponibil"></el-table-column
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
    <Masini-dialog ref="dlg" @save="refresh_info()" />
  </base-page>
</template>

<script>
import settings from "@/backend/LocalSettings";
import BasePage from "@/pages/BasePage";
import Masini_dialog from "@/pages/masini/Masini_dialog.vue";
import TitluPagina from "@/widgets/TitluPagina";

export default {
  name: "masini",
  extends: BasePage,
  components: {
    "base-page": BasePage,
    "Masini-dialog": Masini_dialog,
    "titlu-pagina": TitluPagina,
  },
  data() {
    return {
      Results: [],
      base_url: "",
      Info: {},
      Filters: {
        Masina: "",
        Model: "",
        Culoare: "",
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
      var response = await this.post("masini/get_info");
      this.refresh_info();
    },

    async refresh_info() {
      var response = await this.post("masini/index", {
        Filters: this.Filters,
        OrderBy: this.OrderBy,
        PaginationInfo: this.PaginationInfo,
      });
      this.Results = response.Results;
      this.PaginationInfo = response.PaginationInfo;
      //
      this.select_menu_item("masini");
    },
    reset() {
      this.Filters = {
        Masina: "",
        Model: "",
        Culoare: "",
      };
      this.refresh_info();
    },

    async delete_item(item) {
      var confirm = await this.$confirm(`Sunteti sigur ?`, "Warning");
      if (confirm) {
        await this.post("masini/delete_item", { id: item.Id });
        this.refresh_info();
      }
    },

    show_dialog(id) {
      console.log(id);
      this.$refs.dlg.show_me(id);
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
