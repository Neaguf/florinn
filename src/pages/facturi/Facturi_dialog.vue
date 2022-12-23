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
      <!-- Dialog -->
      <el-row :gutter="15">
        <el-col :md="8">
          <el-form-item label="Serie" prop="Serie">
            <el-input class="full-width" v-model="selectedObject.Serie" />
          </el-form-item> </el-col
        ><el-col :md="8">
          <el-form-item label="Nume" prop="Nume">
            <el-input class="full-width" v-model="selectedObject.Nume" />
          </el-form-item>
        </el-col>
        <el-col :md="8">
          <el-form-item label="Prenume" prop="Prenume">
            <el-input class="full-width" v-model="selectedObject.Prenume" />
          </el-form-item>
        </el-col>
        <el-col :md="8">
          <el-form-item label="Cnp" prop="Cnp">
            <el-input class="full-width" v-model="selectedObject.Cnp" />
          </el-form-item>
        </el-col>
      </el-row>
      <el-card>
        <h5>PRODUSE</h5>

        <!-- labels produse -->
        <div class="produseColoane">
          <p>Denumire</p>
          <p>Pret</p>
          <p>Cantitate</p>
          <p>Valoare</p>
        </div>
        <div
          v-for="(item, index) in itemProduse"
          :key="item.idProdus + index"
          class="produseValori"
        >
          <!-- facem un select pe id-ul produsului -->
          <el-select
            v-model="item.idProdus"
            @change="changeProdus(index, item.idProdus)"
            ><el-option
              v-for="produs in Produse"
              :key="produs.Id"
              :label="produs.Nume"
              :value="produs.Id"
            ></el-option
          ></el-select>
          <el-input-number
            style="width: 25%"
            v-model="item.pretProdus"
          ></el-input-number>
          <el-input-number
            style="width: 25%"
            v-model="item.cantitateProdus"
          ></el-input-number>
          <p style="width: 25%; padding-left: 60px">
            {{ item.pretProdus * item.cantitateProdus }}
          </p>
          <el-tooltip content="Sterge">
            <el-button
              type="danger"
              icon="el-icon-delete"
              circle
              @click="deleteProdus(index)"
            />
          </el-tooltip>
        </div>
        <el-button @click="addItemProdus()">+</el-button>
      </el-card>

      <el-card>
        TOTAL:
        {{
          itemProduse
            .map((p) => p.pretProdus * p.cantitateProdus)
            .reduce((acc, curent) => acc + curent, 0)
        }}
      </el-card>
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
      Produse: [],
      baseUrl: "",
      showPopup: false,
      mode: "add",
      selectedObject: {
        Serie: "",
        Numar: "",
        Nume: "",
        Prenume: "",
        Cnp: "",
        Data: "",
      },
      Info: {},
      rules: {
        //   Nume: [ { required: true, message: "Campul este obligatoriu" } ]
        Serie: [{ required: true, message: "Campul este obligatoriu" }],
        Data: [{ required: true, message: "Campul este obligatoriu" }],
        Nume: [{ required: true, message: "Campul este obligatoriu" }],
        Prenume: [{ required: true, message: "Campul este obligatoriu" }],
        Cnp: [{ required: true, message: "Campul este obligatoriu" }],
      },
      itemProduse: [{ idProdus: "", cantitateProdus: 1, pretProdus: 300 }],
    };
  },
  methods: {
    show_me: async function (id) {
      this.showPopup = true;
      if (id == null) {
        this.mode = "add";
        this.selectedObject = {
          Serie: "",
          Numar: "",
          Nume: "",
          Prenume: "",
          Cnp: "",
          Data: "",
        };
      } else {
        this.mode = "edit";
        var result = await this.post("facturi/get_info_item_dialog", {
          id: id,
        });
        this.selectedObject = result.Item;
        this.itemProduse = [];
        this.itemProduse = result.Produse.map((produs) => {
          return {
            idProdus: produs.IdProdus,
            cantitateProdus: produs.Cantitate,
            pretProdus: produs.Pret,
          };
        });
      }
    },
    async get_info() {
      var response = await this.post("facturi/get_info_for_dialog");
      this.Produse = response.produse;
    },
    save: async function () {
      this.$refs["my-form"].validate(async (valid) => {
        if (valid) {
          await this.post("facturi/save", {
            mode: this.mode,
            object: this.selectedObject,
            produse: this.itemProduse,
          });
          this.showPopup = false;
          this.$emit("save");
        }
      });
    },
    addItemProdus() {
      this.itemProduse.push({
        idProdus: "",
        cantitateProdus: "",
        pretProdus: "",
      });
    },
    deleteProdus(id) {
      console.log(id);
      this.itemProduse.splice(id, 1);
      console.log(this.itemProduse);
    },
    changeProdus(idProdusLista, idProdusBD) {
      this.itemProduse[idProdusLista].pretProdus =
        this.Produse[idProdusBD - 1].Pret;
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

.produseColoane {
  display: flex;
  flex-direction: row;
  gap: 15px;
}

.produseValori {
  display: flex;
  flex-direction: row;
  gap: 15px;
  padding-bottom: 10px;
}

.produseColoane p {
  width: 25%;
}
</style>
