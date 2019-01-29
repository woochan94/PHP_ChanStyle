// server.js

var express = require('express');
var bodyParser = require('body-parser');
var app = express();
var http = require('http').Server(app); //1
var io = require('socket.io')(http);    //1

app.use(bodyParser.urlencoded({extended: false}));

var name;
var id;
var room;

app.get('/',function(req, res){  //2
    res.sendFile(__dirname + '/client.html');
});

app.post('/form_receiver', function (req, res) {
    name = req.body.name;
    id = req.body.id;
    console.log(id);
    res.sendFile(__dirname + '/client2.html');
});


io.on('connection', function(socket){ //3
    console.log('user connected: ', socket.id);  //3-1
    var name2 = name;
    var id2 = id;
    socket.on('joinRoom',function (data) {
        console.log('joinRoom' + data);
        // 기존 방에서 나오기
        socket.leave(room);

        room = data;
        socket.join(room);
    });

    /*io.to(socket.id).emit('change name',name2);   //3-1*/
    io.to(socket.id).emit('change name',name2);

    socket.on('disconnect', function(){ //3-2
        console.log('user disconnected: ', socket.id);
    });

    socket.on('send message', function(name,text){ //3-3
        var msg = name + ' : ' + text;
        console.log(msg);
        io.to(room).emit('receive message', msg);
    });

    socket.emit('RoomId', id2);



/*    socket.on('joinRoom', function (data) {
        // 기존 방에서 나오기
        socket.leave(room);

        room = data;
        socket.join(room);
        console.log(room);
    })*/

});

http.listen(3000, function(){ //4
    console.log('server on!');
});















/*
// server.js
var express = require('express');
var bodyParser = require('body-parser');
var app = express();
var http = require('http').Server(app); // app을 http에 연결시킴
var io = require('socket.io')(http);    // http를 다시 socket.io에 연결시킴 -> socket.io가 express를 직접 받아들이지 못하기 때문에

app.use(bodyParser.urlencoded({extended: false}));

var id = '';
var name = '';

app.post('/form_receiver', function (req, res) {
    id = req.body.id;
    name = req.body.name;
    res.sendFile(__dirname + '/chat.html');
});

// io.on(Event, 함수) 는 서버에 전달된 EVENT를 인식하여 함수를 실행시키는 event listener.
io.on('connection', function(socket){
    console.log('user connected: ', socket.id);  //3-1
    var name2 = name;
    socket.join(id); //socket이 접속하면 'rm'이라는 room으로 들어가게 하는 것이다.

    // change name이란 event를 발생시킨다.
    // emit -> event를 발생시키는 함수
    // 이 event는 client.html의 해당 event listener에서 처리됨, io.to(socket.id).emit 을 사용하여 해당 socket에만 event를 전달
                    //3-1
    socket.on('disconnect', function(){ //3-2
        console.log('user disconnected: ', socket.id);
    });

    socket.on('send message', function(name, text){ //3-3
        var msg = name + ' : ' + text;
        io.to(id).emit('receive message', msg);
    });
});

http.listen(3000, function(){ //4
    console.log('server on!');
});*/
