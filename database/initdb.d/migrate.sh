#!/usr/bin/env bash

echo "========================================"
echo "[ RELEVENT ENVIRONMENT INFO ]"
echo "USER: $MYSQL_USER"
echo "PASS: $MYSQL_PASSWORD"
echo "ROOT PASS: $MYSQL_ROOT_PASSWORD"
echo "DB: $MYSQL_DATABASE"
echo "PREFIX: $WORDPRESS_TABLE_PREFIX"
echo "PRODUCTION: $PRODUCTION_URL"
echo "LOCAL: $DEV_URL"
echo "========================================"

if [ -z $WORDPRESS_TABLE_PREFIX ]; then
	echo "[ATTENTION] :: PREFIX EMPTY."
	echo "========================================"
	exit 0
fi
if [[ $PRODUCTION_URL == $DEV_URL ]]; then
	echo "[ATTENTION] :: LOCAL AND REMOTE ENVIRONMENT THE SAME."
	echo "========================================"
	exit 0
fi

if [[ $1 != "run" ]]; then
	echo "[DELAYED] :: STOPPING HERE"
	echo "========================================"
	exit 0
fi

# RIGHT, SO DO NOT AUTOMATE THIS THEN... CAN WE RUN MIGRATE LATER?
mysql -u root -p$MYSQL_ROOT_PASSWORD -D$MYSQL_DATABASE -e "
UPDATE ${WORDPRESS_TABLE_PREFIX}options SET option_value = REPLACE(option_value, '${PRODUCTION_URL}', '${DEV_URL}') WHERE option_name = 'home' OR option_name = 'siteurl'; 
UPDATE ${WORDPRESS_TABLE_PREFIX}posts SET guid = REPLACE(guid, '${PRODUCTION_URL}', '${DEV_URL}'); 
UPDATE ${WORDPRESS_TABLE_PREFIX}posts SET post_content = REPLACE(post_content, '${PRODUCTION_URL}', '${DEV_URL}'); 
UPDATE ${WORDPRESS_TABLE_PREFIX}posts SET post_content = REPLACE(post_content, 'src=\"${PRODUCTION_URL}\"', 'src=\"${DEV_URL}\"'); 
UPDATE ${WORDPRESS_TABLE_PREFIX}posts SET guid = REPLACE(guid, '${PRODUCTION_URL}', '${DEV_URL}') WHERE post_type = 'attachment'; 
UPDATE ${WORDPRESS_TABLE_PREFIX}postmeta SET meta_value = REPLACE(meta_value, '${PRODUCTION_URL}', '${DEV_URL}');"
