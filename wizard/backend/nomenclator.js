
var         fs = require('fs');

exports.start = async function(id)
{
    console.log('\x1b[33m%s\x1b[0m', "--- Generator de nomenclatoare ---");
    //
    try
    {
        var content = await get_url_content(`http://breakingpoint-vue-helper.breakingpoint.ro/api/index.php/api/nomenclator/${id}`);
        var json    = JSON.parse(content);

        write_file( json.VueList_Path       , json.VueList_Filename         , json.VueList_Content       );
        write_file( json.VueDialog_Path     , json.VueDialog_Filename       , json.VueDialog_Content     );
        write_file( json.PhpController_Path , json.PhpController_Filename   , json.PhpController_Content );
        
        console.log('Done!');
    }
    catch(ex)
    {
        console.log(ex);
    }

}

 
function write_file( path, file_name, content){
    if(!fs.existsSync(path))
        fs.mkdirSync(path, { recursive: true });
    fs.writeFileSync(`${path}/${file_name}`, content);
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