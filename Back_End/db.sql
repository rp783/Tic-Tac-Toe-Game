var mysql = require('mysql');
var express = require('express');

var app = express();
app.use(express.json());

var con = mysql.createConnection({
  host: "192.168.1.114",
  user: "dharmesh",
  password: "Dharmeshp85",
  database: "ProjectDB"
});

con.connect(function(err) {
  if (err) throw err;
  console.log("Connected!");
/*
  var sql = "INSERT INTO UserTable (ID,Username,Password,FirstName,LastName,Email) VALUES ('1', 'Dharmesh85','Dharmeshp85','Dharmesh', 'Patel', 'test1@gmail.com')";
  con.query(sql, function (err, result) {
    if (err) throw err;
    console.log("Record Updated");
  });
});
*/
