# BlogPro
Blog project with back office

Installation :
1. Clone the entire repository on your server.
2. Install composer (if you don't have it)
3. Run the composer install command in your clone file (see : https://getcomposer.org/doc/01-basic-usage.md)
4. Rename App/Config/config-SAMPLE.php into config.php
5. Edit config.php so that 'HOME_DIR' points to your public file (where index.php is)
6. Use the App/Config/blogDB.sql SQL request to setup the site's database.
7. Edit App/Config/database-SAMPLE with your database's infos and rename it "database.yml"

Accessing Back Office :
http://your.URL.com/admin

Default login (modify these values in Settings panel of the Back Office):
Mail : admin@blogpro.com
Password : admin1234

