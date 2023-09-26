chmod -R 500 .
chmod -R 775 cache/
chmod -R 775 upload/
chmod -R 775 document_templates/
chmod -R 775 test/
chmod 700 suitecrm.log
chown -R www-data:www-data .
chmod 400 lockfiles.sh index.php config.php .htaccess