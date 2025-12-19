# Webpro Project  
## RentalMovie (OneByOne)

### Requirements
- XAMPP Control Panel v3.3.0  
- MySQL  

---

### MySQL Port Configuration (phpMyAdmin)
1. Open **XAMPP Control Panel**
2. Click **Config** (MySQL) → `my.ini`
3. Change port (example: `3306` → `3307`) in:
   - `[client]`
   - `[mysqld]`

4. Go to file path: xampp/phpMyAdmin/config.inc.php
5. Change (or add if not exists):
```php
$cfg['Servers'][$i]['port'] = '3307';
```
### Start XAMPP Modules:

- Start Apache

- Start MySQL

Make sure both modules turn green

You should now be able to access phpMyAdmin by clicking Admin next to MySQL or via browser. http://localhost/phpmyadmin/

---

### Import Sample Database

Open phpMyAdmin

Import SQL file: onebyone.sql (located in DB folder)

Make sure sample data is successfully inserted

---

### Run the Project:

Register an account at: http://localhost/Project_Web/register.php
