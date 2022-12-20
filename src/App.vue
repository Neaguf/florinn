<template>
    <div id="app">
        <router-view/>
    </div>
</template>

<script>
    import settings from "@/backend/LocalSettings";

    export default {
        name: 'App',
        methods:
            {
                async check_version()
                {
                    var local_version  = settings.version;
                    var server_version = await this.post("version");
                    if( local_version != server_version )
                    {
                        this.$notify({
                            title: 'Atentie',
                            message: 'A aparut o noua versiune - <button onclick="window.location.reload()">Upgrade</button> ',
                            dangerouslyUseHTMLString: true,
                            type: 'warning',
                            duration: 0
                        });
                    }
                },
                post: async function(url, args={}){
                    var response = await this.$http.post(url, args );
                    return response.bodyText;
                },
            },
        mounted()
        {
            //verificam daca exista o versiune mai noua
            this.check_version();
        }
    }
</script>

<style lang='less'>
    @albastru-deschis: hsl(0, 57%, 53%);

    .navbar-dark .navbar-toggler-icon {
        color: hsl(193, 11%, 34%) !important;
        fill: hsl(193, 11%, 34%) !important;

    }

 

    .el-table {
        border-radius: 5px;
    }
    
    .number {
        border-radius: 5px;
        color: hsl(193, 11%, 34%) !important;
    }

    .text-albastru{
        color: @albastru-deschis;
    }

    .bg-albastru{
        background-color: @albastru-deschis;
    }

    .display-titlu {
        display: flex;
        justify-content: flex-start;
        align-items: center;


    }

    div.titlu{
        // background-color: hsl(196, 85%, 35%);
        h1{
            color: hsl(193, 11%, 34%) !important;
            // padding: 8px 15px;
            font-family: 'Lato', sans-serif;
            font-weight: 300;
            font-size: 25px;
        }
        .btn-adauga{
            // display: block;
            z-index: 1;
            text-align: center;
            height: 50px;
            // padding-left: 50px;
            // padding-right: 50px;
            color: hsl(193, 11%, 34%);
            background: transparent; /* Old browsers */
            border-radius: 10px !important;
            // background: -moz-linear-gradient(top, hsl(193, 11%, 34%) 0%, hsl(196, 11%, 57%) 50%, hsl(200, 11%, 58%) 100%); /* FF3.6-15 */
            // background: -webkit-linear-gradient(top, hsl(193, 11%, 34%) 0%,hsl(196, 11%, 57%) 50%,hsl(200, 11%, 58%) 100%); /* Chrome10-25,Safari5.1-6 */
            // background: linear-gradient(to top, hsl(193, 11%, 34%) 0%,hsl(196, 11%, 57%) 50%,hsl(200, 11%, 58%) 100%); /* W3C, IE10+, FF16+, Chrome26+, Opera12+, Safari7+ */
            filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#34c2e4', endColorstr='#4fabda',GradientType=0 ); /* IE6-9 */
            border: none;
            border-radius: 0%;
            margin: 2px;
        }

        .btn-adauga:hover {
            color: white;
            background-color: hsl(0, 0%, 71%);
        }
    }


    html {
        
        height: 100%;
        background-position: center;
        background-size: cover;
        background-position: fixed;
        background-color: #F7F7F8;
        font-family: "Avenir", Helvetica, Arial, sans-serif;
        -webkit-font-smoothing: antialiased;
        -moz-osx-font-smoothing: grayscale;
    }
    body{
        background-color: transparent !important;
    }
    .my-dialog-class .el-dialog{
        width: 80%;
    }
    .full-width{
        width: 100%;
    }

    
    .tox-tinymce-aux{
        z-index: 5000!important;
    }

</style>
