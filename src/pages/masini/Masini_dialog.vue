<template>
  <el-dialog title="Masini" :visible.sync="showPopup" class="my-dialog-class">
    <el-form
      label-position="top"
      :inline="false"
      :rules="rules"
      label-width="100%"
      :model="selectedObject"
      ref="my-form"
      @submit.prevent="save"
      v-loading="loadingVisible"
    >
      <el-row :gutter="15">
        <el-col :md="8">
          <el-form-item label="Marca">
            <el-input class="full-width" v-model="selectedObject.Marca" />
          </el-form-item>
        </el-col>
        <el-col :md="8">
          <el-form-item label="Model">
            <el-input class="full-width" v-model="selectedObject.Model" />
          </el-form-item>
        </el-col>
        <el-col :md="8">
          <el-form-item label="Culoare">
            <el-input class="full-width" v-model="selectedObject.Culoare" />
          </el-form-item>
        </el-col>
        <el-col :md="8">
          <el-form-item label="Disponibil">
            <el-checkbox
              v-model="selectedObject.Disponibil"
              true-label="1"
              false-label="0"
            >
              Disponibil
            </el-checkbox>
          </el-form-item>
        </el-col>
      </el-row>
    </el-form>
    <span slot="footer" class="dialog-footer">
      <el-button @click="showPopup = false"> Renunta </el-button>
      <el-button type="primary" @click="save"> Salveaza </el-button>
    </span>
  </el-dialog>
</template>

<script>
import settings from "@/backend/LocalSettings";
import BasePage from "@/pages/BasePage";

export default {
  name: "Masini_dialog",
  extends: BasePage,
  components: {},
  data() {
    return {
      baseUrl: "",
      showPopup: false,
      mode: "add",
      selectedObject: {
        Marca: "",
        Model: "",
        Culoare: "",
        Disponibil: "",
      },
      Info: {},
      rules: {
        //   Nume: [ { required: true, message: "Campul este obligatoriu" } ]
        Marca: [{ required: true, message: "Campul este obligatoriu" }],
        Model: [{ required: true, message: "Campul este obligatoriu" }],
        Culoare: [{ required: true, message: "Campul este obligatoriu" }],
        Disponibil: [{ required: true, message: "Campul este obligatoriu" }],
      },
    };
  },
  methods: {
    show_me: async function (id) {
      console.log(id);
      this.showPopup = true;
      if (id == null) {
        this.mode = "add";
      } else {
        this.mode = "edit";
        var result = await this.post("masini/get_info_item_dialog", { id: id });
        this.selectedObject = result.Item;
      }
    },
    async get_info() {
      var response = await this.post("masini/get_info_for_dialog");
    },
    save: async function () {
      this.$refs["my-form"].validate(async (valid) => {
        if (valid) {
          await this.post("masini/save", {
            mode: this.mode,
            object: this.selectedObject,
          });
          this.showPopup = false;
          this.$emit("save");
        }
      });
    },
  },
  mounted: function () {
    this.baseUrl = settings.BASE_URL;
    this.get_info();
  },
};
</script>

<style lang="less" scoped>
.full-width {
  width: 100%;
}
</style>
