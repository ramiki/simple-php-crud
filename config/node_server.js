

// import { createServer } from 'http';

// createServer(function (req, res) {

//     res.writeHead(200, {'Content-Type': 'text/html'});
//     res.end('Hello World!');
//   }).listen(8081);




var http = require('http');

http.createServer(function (req, res) {

  // res.writeHead(200, {'Content-Type': 'text/html'});
  // res.end('Hello World!');

  res.writeHead(301, { Location: "view.php" });
  res.end();

}).listen(8081);


   