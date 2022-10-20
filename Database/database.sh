#! /bin/bash

newUser='rutvik783'
newDbPassword='Shilpa@6303'
newDb='rutvik783'
host=localhost
#host='%'

# MySQL 5.7 and earlier versions 
#commands="CREATE DATABASE \`${newDb}\`;CREATE USER '${newUser}'@'${host}' IDENTIFIED BY '${newDbPassword}';GRANT USAGE ON *.* TO '${newUser}'@'${host}' IDENTIFIED BY '${newDbPassword}';GRANT ALL privileges ON \`${newDb}\`.*TO '${newUser}'@'${host}' IDENTIFIED BY '${newDbPassword}';FLUSH PRIVILEGES;"

# MySQL 8 and higher versions
commands="CREATE DATABASE \`${newDb}\`;CREATE USER '${newUser}'@'${host}' IDENTIFIED BY '${newDbPassword}';GRANT USAGE ON *.* TO '${newUser}'@'${host}';GRANT ALL ON \`${newDb}\`.* TO '${newUser}'@'${host}';FLUSH PRIVILEGES;"

echo "${commands}" | /usr/bin/mysql -u root -p
