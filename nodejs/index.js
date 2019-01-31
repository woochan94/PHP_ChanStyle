var mysql      = require('mysql');
var connection = mysql.createConnection({
    host     : 'localhost',
    user     : 'root',
    password : 'wjddncks!',
    database : 'chanstyle'
});

connection.connect();

connection.query('SELECT * from test;', function (error, results, fields) {
    if (error){
        console.log(error);
    }
    console.log(results);
});

connection.end();