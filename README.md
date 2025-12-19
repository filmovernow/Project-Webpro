#Webpro Project: RentalMovie
make sure you have 
-Xampp Control Panel v3.3.0
-MySQL
Change port to another port to use phpMyAdmin
by open config row MySQL in Xampp Control Panel and select my.ini
change port exmaple 3306 to 3307 in [client] and [mysqld]
and go to file path:xampp/phpMyAdmin/config.inc.php
change $cfg['Servers'][$i]['port'] = '3306';
to $cfg['Servers'][$i]['port'] = '3307';
or don't have you can add it
Next you Start Module ACtions
- Apache and MySQL
make sure module textbox is green background and you can connect to phpmyadmin by open admin next button from start button(MySQL)
after you can connect to phpMyAdmin you can add sample data by use file onebyone.sql in DB file and insert this file to your phpMyAdmin
after you have sample data in phpMyadmin you can register to this web by use http://localhost/Project_Web/register.php
That all how to use My project Thank you to read at all :)
