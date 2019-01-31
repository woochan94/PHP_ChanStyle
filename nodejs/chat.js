var express = require('express');
var app = express();
var http = require('http').Server(app); //1
var io = require('socket.io')(http);    //1
var bodyParser = require('body-parser');
var mysql = require('mysql');
var connection = mysql.createConnection({
    host : 'localhost',
    user : 'root',
    password : 'wjddncks!',
    database : 'chanstyle'
});

connection.connect();

app.use(bodyParser.urlencoded({extended: false}));

var name;
var title;
var pname;
var pprice;

// 최상위 경로 설정
app.use('/', express.static(__dirname));

app.get('/',function(req, res){  //2
    res.sendFile(__dirname + '/Streaming/Streaming.html');
});

app.post('/form_receiver', function (req, res) {
    name = req.body.name;
    if(name == '관리자') {
        title = req.body.title;
        pname = req.body.pname;
        pprice = req.body.pprice;

        connection.query('insert into test(title, pname, pprice) values (?,?,?)',[title,pname,pprice], function (err, result)  {
            if(err) {
                console.log("Error : " + err);
            } else {
                res.sendFile(__dirname + '/Streaming/Streaming.html');
            }
        });
    } else {
        connection.query('select * from test', function (err,result) {
            if(err) {
                console.log("Error : " + err);
            } else {
                if(result.length == 0) {
                    res.sendFile(__dirname + '/Streaming/Notstart_Streaming.html');
                } else {
                    res.sendFile(__dirname + '/Streaming/Streaming.html');
                }
            }
        })
    }

});

io.on('connection', function(socket) {

    var name2 = name;

    io.to(socket.id).emit('change name', name2);
    io.to(socket.id).emit('title',title);

    socket.on('send message', function(name,text){ //3-3
        var msg = name + ' : ' + text;
        console.log(msg);
        io.emit('receive message', msg);
    });

    socket.on('disconnect', function(){ //3-2
        console.log('user disconnected: ', socket.id);
    });
});

http.listen(3000, function(){ //4
    console.log('server on!');
});
