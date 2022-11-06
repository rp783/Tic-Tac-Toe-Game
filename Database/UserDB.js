var mysql = require('mysql');

var con = mysql.createConnection({
	host: "192.168.1.114",
	user: "rutvikpatel7",
	password: "Rutvikp@6303",
	database: "ProjectDB"
	
});

con.connect (function (err){
	if (err) throw err;
	console.log("Connected to Database!");

});

	
