var mysql = require('mysql');

var con = mysql.createConnection({
	host: "%",
	user: "rutvikpatel7",
	password: "Rutvikp6303",
	database: "ProjectDB"
	
});

con.connect(function (err){
	if (err) throw err;
	console.log("Connected to Database!");

});
	
