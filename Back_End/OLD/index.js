const express = require("express");
const bodyParser = require("body-parser")
const app = express();
const mysql = require("mysql");
const cors = require("cors");
const amqplib = require('amqplib');
const Producer = require('./Producer');
const producer = new Producer();

app.use(bodyParser.json('application/json'));

app.post("/register", async (req,res,next) => {
  await producer.publishMessage(req.body.UserName, req.body.Password, req.body.FirstName, req.body.LastName, req.body.Email);
  res.send();
});


app.use(cors());
app.use(express.json());

const db = mysql.createPool({
  host: "192.168.1.114",
  user: "dharmesh",
  password: "Dharmeshp85",
  database: "ProjectDB",
});
app.use(bodyParser.urlencoded({extended: true}));

console.log("Database Connected");
app.post('/register', (req, res)=>{ 

  const UserName = req.body.UserName;
  const Password = req.body.Password;
  const FirstName = req.body.FirstName;
  const LastName = req.body.LastName;
  const Email = req.body.Email;

  const sqlInsert = "INSERT INTO UserTable( UserName, Password, FirstName, LastName, Email) VALUES (?,?,?,?,?)";
  db.query(sqlInsert, [ UserName, Password, FirstName, LastName, Email], (err, result)=> {
    console.log(err);
    

  })
});
app.post('/login',(req, res)=> {

  const UserName = req.body.UserName;
  const Password = req.body.Password;

  db.query(
    "SELECT * FROM UserTable WHERE UserName = ? AND password = ?",
    [UserName, Password],
    (err,result) => {
      if(err){
        res.send({err:err});
      }
        if (result.length > 0) {
          res.send(result);
        }else{
          res.send({message:"Incorrect Username and/or Password"});
        }
      }
    );
    });  

  
app.listen(5001, () => {
  console.log("Yey, your server is running on port 5001");
})
