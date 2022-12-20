<template>
<div class='titlu'>
    <el-row>
        <el-col class="display-titlu">
            <h1> {{Titlu}} </h1>
            <el-button v-if="AdaugaVisible" type='primary' class='btn-adauga' @click="on_add_clicked" icon='el-icon-plus'> {{AdaugaText}} </el-button>
        </el-col>
    </el-row>
</div>
</template>

<script>

import settings from '@/backend/LocalSettings';

export default {
    name: 'TitluPagina',
    props:{
        Titlu: "",
        AdaugaText: "Adauga",
        AdaugaVisible: true
    },
    data () {
        return {
        }
    },
    methods:
        {
            on_add_clicked: function(){
                this.$emit('on_add_clicked');
            },
        }
}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped lang="less">
    .titlu {
        margin: 0;
        padding: 0;
    }

</style>