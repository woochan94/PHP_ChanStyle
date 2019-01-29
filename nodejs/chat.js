var express = require('express');
var app = express();
var http = require('http').Server(app); //1
var io = require('socket.io')(http);    //1
var bodyParser = require('body-parser');

app.use(bodyParser.urlencoded({extended: false}));

var name;

// 최상위 경로 설정
app.use('/', express.static(__dirname));

app.get('/',function(req, res){  //2
    res.sendFile(__dirname + '/Streaming/Streaming.html');
});

app.post('/form_receiver', function (req, res) {
    name = req.body.name;
    console.log(name);
    res.sendFile(__dirname + '/Streaming/Streaming.html');
});

io.on('connection', function(socket) {

    var name2 = name;

    io.to(socket.id).emit('change name', name2);

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
