var express = require("express");
var app = new express();
var http = require("http").Server(app);
var io = require("socket.io")(http)
var RTCMultiConnectionServer = require('rtcmulticonnection-server');
var bodyParser = require('body-parser');

app.use(bodyParser.urlencoded({extended: false}));

app.use('/', express.static(__dirname));

var name;
var title;

app.get('/',function(req, res){  //2
    res.sendFile(__dirname + '/Streaming/Streaming.html');
});

app.post('/form_receiver', function (req, res) {
    name = req.body.name;
    res.sendFile(__dirname + '/Streaming/Streaming.html');
});

io.on('connection', function (socket) {
    RTCMultiConnectionServer.addSocket(socket);

    var params = socket.handshake.query;

    if (!params.socketCustomEvent) {
        params.socketCustomEvent = 'custom-message';
    }

    socket.on(params.socketCustomEvent, function(message) {
        socket.broadcast.emit(params.socketCustomEvent, message);
    });
});

http.listen(3001, function(){ //4
    console.log('app.js server on!');
});