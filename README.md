# BlogPro
Blog project with back office

Installation :
1. Clone the entire repository on your server.
2. Install composer (if you don't have it)
3. Run the composer install command in your clone file (see : https://getcomposer.org/doc/01-basic-usage.md)
4. Edit App/Config/config.php so that 'HOME_DIR' points to your public file (where index.php is)
5. Use the App/Config/blogDB.sql SQL request to setup the site's database.
6. Edit App/Config/database-SAMPLE with your database's infos and rename it "database.yml"

Comments management :
1. Create a Disqus account
2. Select "Universal Code" as the integration method
3. Copy the given code in App/View/Template/ViewArticle.php, between the Disqus tags
4. Finally, edit the two CONFIGURATION VARIABLES accordingly (see : https://help.disqus.com/customer/portal/articles/472098-javascript-configuration-variables)

Accessing Back Office :
http://your.URL.com/admin

Default login (modify these values in Settings panel of the Back Office):
Mail : admin@blogpro.com
Password : admin1234

