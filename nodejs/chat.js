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

        res.sendFile(__dirname + '/Streaming/Streaming.html');
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
    var name3; //관리자 구분하기 위한 변수

    io.to(socket.id).emit('change name', name2);
    io.to(socket.id).emit('title',title);

    socket.on('send message', function(name,text){ //3-3
        var msg = name + ' : ' + text;
        console.log(msg);
        io.emit('receive message', msg);
    });

    socket.on('test', function (text) {
        if(text == 123) {
            name3 = socket.id;
            connection.query('insert into test(title, pname, pprice) values (?,?,?)',[title,pname,pprice], function (err, result)  {
                if(err) {
                    console.log("Error : " + err);
                } else {

                }
            });
        } else {
            console.log("고객");
        }
    })

    socket.on('disconnect', function(){ //3-2
        if(socket.id == name3) {
            connection.query('truncate test',function (err,result) {
                if(err) {

                }else {

                }
            });
            console.log('관리자 disconnect');
        } else {
            console.log('고객 disconnect');
        }
        console.log('user disconnected: ', socket.id);
    });
});

http.listen(3000, function(){ //4
    console.log('server on!');
});
