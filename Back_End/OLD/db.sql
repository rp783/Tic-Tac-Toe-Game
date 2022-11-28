var mysql = require('mysql');

var con = mysql.createConnection({
  host: "192.168.1.114",
  user: "dharmesh",
  password: "Dharmeshp85",
  database: "ProjectDB"
});

con.connect(function(err) {
  if (err) throw err;
  console.log("Connected!");

});

