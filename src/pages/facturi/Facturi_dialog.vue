<template>
  <el-dialog title="Facturi" :visible.sync="showPopup" class="my-dialog-class">
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
          <el-form-item label="Client">
            <el-input class="full-width" v-model="selectedObject.Client" />
          </el-form-item>
        </el-col>
        <el-col :md="8">
          <el-form-item label="Cnp">
            <el-input class="full-width" v-model="selectedObject.Cnp" />
          </el-form-item>
        </el-col>
      </el-row>

      <el-row :gutter="15">
        <el-col :md="8">
          <el-form-item label="Total">
            <el-input class="full-width" v-model="selectedObject.Total" />
          </el-form-item>
        </el-col>
      </el-row>
      <el-row :gutter="15">
        <el-col :md="8">
          <el-select multiple v-model="value1" placeholder="Select">
            <el-option
              v-for="item in facturi"
              :key="item.Id"
              :label="item.Nume"
              :value="item.Id"
            >
            </el-option>
          </el-select>
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
  name: "Facturi_dialog",
  extends: BasePage,
  components: {},
  data() {
    return {
      value1: "",
      value: "Option5",
      baseUrl: "",
      showPopup: false,
      mode: "add",
      selectedObject: {
        Client: "",
        Cnp: "",
        Total: "",
      },
      produse: [],
      Info: {},
      rules: {
        //   Nume: [ { required: true, message: "Campul este obligatoriu" } ]
        Client: [{ required: true, message: "Campul este obligatoriu" }],
        Cnp: [{ required: true, message: "Campul este obligatoriu" }],
        Total: [{ required: true, message: "Campul este obligatoriu" }],
      },
    };
  },
  methods: {
    show_me: async function (id) {
      this.showPopup = true;
      if (id == null) {
        this.mode = "add";
      } else {
        this.mode = "edit";
        var result = await this.post("facturi/get_info_item_dialog", {
          id: id,
        });
        this.selectedObject = result.Item;
      }
    },
    async get_info() {
      var response = await this.post("facturi/get_info_for_dialog");
      //   console.log(response.produse)
      // selectam produse
      this.facturi = response.facturi;
    },
    save: async function () {
      this.$refs["my-form"].validate(async (valid) => {
        if (valid) {
          await this.post("facturi/save", {
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
