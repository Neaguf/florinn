const readline = require('readline');
var         fs = require('fs');
const       rl = readline.createInterface({ input: process.stdin, output: process.stdout });
const     http = require('http');
var exec = require('child_process').exec;


exports.start = async function( id, download_ci=true )
{
    console.log('\x1b[33m%s\x1b[0m', "--- Initializare proiect v2.0 ---");
    //
    try
    {
        var content = await get_url_content(`http://breakingpoint-vue-helper.breakingpoint.ro/api/index.php/api/initializare/${id}`);
        var json    = JSON.parse(content);

        var proiect         = json.Proiect;
        var vue_zip_url     = json.Vue_Zip_Url;
        var ci_zip_url      = json.CI_Zip_Url;
        var ci_others_url   = json.CI_Others_Url;

        var mysql_db_name = proiect.DatabaseName;
        var mysql_db_user = proiect.DatabaseUser;
        var mysql_db_pass = proiect.DatabasePass;
        var base_url_ci   = proiect.BaseUrlCI;
        var base_url      = proiect.BaseUrl;
        var proiect_slug  = proiect.Slug;

        console.log(`downloadam fisierele vue...`);
        await download_async( vue_zip_url, "vue.zip" );
        await execute("unzip -o vue.zip -d src");

        if( download_ci ){
            console.log(`downloadam code igniter...`);
            await download_async( ci_zip_url, "ci.zip" );
            await execute("unzip -o ci.zip -d ../../api");
        }
        console.log(`downloadam aditionalele code igniter...`);
        await download_async( ci_others_url, "ci-others.zip" );
        await execute("unzip -o ci-others.zip -d ../../api");

        //facem replaceurile principale
        var contents = fs.readFileSync('../../api/application/config/database.php', 'utf8');
        contents     = contents.replaceAll('MYSQL-USERNAME'   , mysql_db_user );
        contents     = contents.replaceAll('MYSQL-PASSWORD'   , mysql_db_pass );
        contents     = contents.replaceAll('MYSQL-DB'         , mysql_db_name );
        write_file("../../api/application/config", "database.php", contents);

        var contents = fs.readFileSync('../../api/application/config/config.php', 'utf8');
        contents     = contents.replaceAll('BASE-URL'           , base_url_ci );
        write_file("../../api/application/config", "config.php", contents);
        
        var contents = fs.readFileSync('src/backend/LocalSettings.js', 'utf8');
        contents = contents.replaceAll('BASE_URL_STRING' , base_url       );
        contents = contents.replaceAll('PROIECT_SLUG'    , proiect_slug   );
        write_file(`src/backend`,`LocalSettings.js`, contents);

        console.log('\x1b[33m%s\x1b[0m', `GATA! done!`);
    }
    catch(ex)
    {
        console.log(ex);
    }
    //inchidem readlineul
    rl.close();

}

function get_url_content (url)
{
    return new Promise((resolve, reject) => {
        const http      = require('http'),
              https     = require('https');

        let client = http;

        if (url.toString().indexOf("https") === 0) {
            client = https;
        }

        client.get(url, (resp) => {
            let data = '';

            // A chunk of data has been recieved.
            resp.on('data', (chunk) => {
                data += chunk;
            });

            // The whole response has been received. Print out the result.
            resp.on('end', () => {
                resolve(data);
            });

        }).on("error", (err) => {
            reject(err);
        });
    });
}

String.prototype.replaceAll = function(search, replacement) {
    var target = this;
    return target.replace(new RegExp(search, 'g'), replacement);
};

function download_async( url, local_file_name ) {
    return new Promise( function(resolve, reject){        
        http.get( url, function(response) {
            const file   = fs.createWriteStream( local_file_name );
            response.pipe(file);
            file.on('finish', function() {
                file.close();
                resolve( local_file_name );
            });
        });
    });
}

function write_file( path, file_name, content){
    if(!fs.existsSync(path))
        fs.mkdirSync(path, { recursive: true });
    fs.writeFileSync(`${path}/${file_name}`, content);
}

function execute(command)
{
    return new Promise( function(resolve, reject){       
        exec(command, function(error, stdout, stderr){ 
            resolve(stdout); 
        });
    });
};