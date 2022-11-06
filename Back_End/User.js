const express = require('express');
const mysql = require('mysql');


const app = express();

app.use(express.json());

const db = mysql.createConnection({
user:"192.168.1.114",
host:"dharmesh",
password:"Dharmeshp85",
database:"ProjectDB",
});


app.post('192.168.1.113:5000/register', (username, password, email) => {
 db.query(
 "INSERT INTO UserTable (UserName, Password, Email) VALUES(?,?,?)",
 [Username, Password, Email],
 (err, result) => { 
 console.log(err);
 }
 );
 });
 app.listen('192.168.1.113:5000', () => {
  console.log("running server");
  });
