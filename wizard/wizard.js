var args = process.argv;
var cmd  = args[2];

if ( cmd == "nomenclator" ) {
    const script = require('./backend/nomenclator');
    script.start( args[3] );
}
if ( cmd == "initial" ) {
    console.log(args);
    const script = require('./backend/initial');
    var download_ci = true;
    if( args.length >= 3 && args[4] == "without_ci" ) download_ci = false;
    script.start( args[3], download_ci );
}

if( cmd == 'update' ){
    const http  = require('http');
    const fs    = require('fs');
    
    console.log('Downloadez ultimul wizard...');
    const file    = fs.createWriteStream("wizard.zip");
    http.get("http://breakingpoint-vue-helper.breakingpoint.ro/wizard.zip", function(response) {
        response.pipe(file);
        file.on('finish', function() {
            file.close();
            //dezarhivam
            console.log('\x1b[33m%s\x1b[0m','Gata, acum dezarhiveaza arhiva wizard.zip peste ce exista aici cu:');
            console.log('\x1b[33m%s\x1b[0m','unzip -o wizard.zip');
        });    
    });
}
