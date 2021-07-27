const fs = require("fs");

// const server = require('https').createServer({
//   key: fs.readFileSync("/etc/letsencrypt/live/siscor.ml/privkey.pem"),
//   cert: fs.readFileSync("/etc/letsencrypt/live/siscor.ml/fullchain.pem")
// });

const server = require('http').createServer();


const io = require('socket.io')(server, {
    cors: { origin: "*"}
});


io.on('connection', (socket) => {
    console.log('connection');

    socket.on('sendNotificationToServer', (message) => {
        io.sockets.emit('sendNotificationToClient', message);
    });


    socket.on('disconnect', (socket) => {
        console.log('Disconnect');
    });
});

server.listen(3000, () => {
    console.log('Server Socket.io is running');
});