var mysql = require("mysql");
var conn = mysql.createConnection({
host:"192.168.1.103",
user:"test",
password: "test",
database: "ProjectDB",
});
con.connect(function(err) {
if (err) throw err;
console.log("Connected!");
})
