# Map-Device


# Installation on Device

You need to create compatbile image and push to Noovo Cloud first

These repos which are used to create images

1. https://github.com/ActiveLearningStudio/ActiveLearningStudio-API (quay.io/curriki/client:box)
2. https://github.com/ActiveLearningStudio/ActiveLearningStudio-react-client (quay.io/curriki/api:box)
3. Trax (quay.io/curriki/trax:box)
4. Tsugi (quay.io/curriki/tsugi:box)
5. Nginx
6. Certbot
7. Postgres
8. MySQL / MariaDB
9. Moodle


## Clone folder into specific directory say /media/sda1/curriki

    git clone https://github.com/ActiveLearningStudio/ActiveLearningStudio-docker-containers /media/sda1/curriki


## Pull / save images

    docker pull quay.io/curriki/api:box

    docker save -o currikiprod-api.tar quay.io/curriki/api:box
    docker save -o currikiprod-client.tar quay.io/curriki/client:box

    etc...


## Push images to NoovoCloud

### For API



    curl --location --request POST 'www.satott.com:8088/docker' \
    --progress-bar \
        --verbose \
    --header 'Authorization: [enter token here]' \
    --form 'checksum="[enter checksum here]"' \
    --form 'name="curriki_api"' \
    --form 'port="9001:80"' \
    --form 'file=@"[enter file path from above step]"' \
    --form 'tag="box"' \
    --form 'restart="always"' \
    --form 'volumeSSD=/media/sda1/curriki/api/storage:/var/www/html/storage,/media/sda1/curriki/api/.env:/var/www/html/.env'


### For Tsugi


    curl --location --request POST 'www.satott.com:8088/docker' \
    --progress-bar \
        --verbose \
    --header 'Authorization: [enter token here]' \
    --form 'checksum="[enter checksum here]"' \
    --form 'name="curriki_tsugi"' \
    --form 'port="6300:80"' \
    --form 'file=@"[enter file path from above step]"' \
    --form 'tag="noovo"' \
    --form 'restart="always"' \
    --form 'volumeSSD=/media/sda1/curriki/tsugi/config.php:/var/www/html/tsugi/config.php,/media/sda1/curriki/tsugi/mod/curriki/config.php:/var/www/html/tsugi/mod/curriki/config.php' 

### For Client



    curl --location --request POST 'www.satott.com:8088/docker' \
    --progress-bar \
        --verbose \
    --header 'Authorization: [enter token here]' \
    --form 'checksum="[enter checksum here]"' \
    --form 'name="curriki_client"' \
    --form 'port="3000:80"' \
    --form 'file=@"[enter file path from above step]"' \
    --form 'tag="noovo"' \
    --form 'restart="always"' \
    --form 'env=REACT_APP_PEXEL_API=[provided_separately_for_security_reasons],REACT_APP_API_URL=https://noovo.curriki.org/api/api,REACT_APP_RESOURCE_URL=https://noovo.curriki.org/api,REACT_APP_GOOGLE_CAPTCHA=[provided_separately_for_security_reasons],REACT_APP_GAPI_CLIENT_ID="[provided_separately_for_security_reasons]",REACT_APP_HUBSPOT=[provided_separately_for_security_reasons],REACT_APP_API_VERSION=v1,REACT_APP_H5P_KEY=[provided_separately_for_security_reasons],REACT_APP_TSUGI_SERVER_URL=[your_tsugi_url]/mod/curriki/,REACT_APP_SHARED_PROJECT_DEMO_USER=demoaccount@gmail.com,REACT_APP_SHARED_PROJECT_DEMO_PASS=[provided_separately_for_security_reasons],REACT_APP_SHARED_PROJECT_USERID=[provided_separately_for_security_reasons]' \
    --form 'volumeSSD=/media/sda1/curriki/client/.env:/usr/share/nginx/html/.env,/media/sda1/curriki/client/.env.local:/usr/share/nginx/html/.env.local'



### MariaDB


    curl --location --request POST 'www.satott.com:8088/docker' \
    --progress-bar \
        --verbose \
    --header 'Authorization: [enter token here]' \
    --form 'checksum="[enter checksum here]"' \
    --form 'name="curriki_mariadb"' \
    --form 'port="3307:3306"' \
    --form 'file=@"[enter file path from above step]"' \
    --form 'tag="noovo"' \
    --form 'restart="always"' \
    --form 'env=MYSQL_DATABASE=[mysql_db],MYSQL_USER=[mysql_user],MYSQL_PASSWORD=[mysql_password],MYSQL_ROOT_PASSWORD=[mysql_root_password],SERVICE_TAGS=dev,SERVICE_NAME=mysql' \
    --form 'volumeSSD=/media/sda1/curriki-db/dbdata/currikiprod1-mysqldata:/var/lib/mysql'


### Postgres


    curl --location --request POST 'www.satott.com:8088/docker' \
    --progress-bar \
        --verbose \
    --header 'Authorization: [enter token here]' \
    --form 'checksum="[enter checksum here]"' \
    --form 'name="curriki_postgres"' \
    --form 'port="5434:5432"' \
    --form 'file=@"[enter file path from above step]"' \
    --form 'tag="noovo"' \
    --form 'restart="always"' \
    --form 'env=POSTGRES_USER=[postgres_user],POSTGRES_PASSWORD=[postgres_password],POSTGRES_DB=[postgres_db],PGDATA=/var/lib/postgresql/data/currikiprod-postgresdata/' \
    --form 'volumeSSD=/media/sda1/curriki-db/dbdata/currikiprod1-postgresdata:/var/lib/postgresql/data/currikiprod-postgresdata'


### Certbot for certificate generation

    curl --location --request POST 'www.satott.com:8088/docker' \
    --progress-bar \
        --verbose \
    --header 'Authorization: [enter token here]' \
    --form 'checksum="[enter checksum here]"' \
    --form 'name="curriki_certbot"' \
    --form 'port="81:80,444:443"' \
    --form 'file=@"[enter file path from above step]"' \
    --form 'tag="noovo"' \
    --form 'restart="always"' \
    --form 'volumeSSD=/media/sda1/curriki/data/certbot/conf:/etc/letsencrypt,/media/sda1/curriki/data/certbot/www:/var/www/certbot'


### Trax

    curl --location --request POST 'www.satott.com:8088/docker' \
    --progress-bar \
        --verbose \
    --header 'Authorization: [enter token here]' \
    --form 'checksum="[enter checksum here]"' \
    --form 'name="curriki_trax"' \
    --form 'port="6900:6900"' \
    --form 'file=@"[enter file path from above step]"' \
    --form 'tag="noovo"' \
    --form 'restart="always"' \
    --form 'volumeSSD=/media/sda1/curriki/trax-lrs/storage:/var/www/html/storage,/media/sda1/curriki/trax-lrs/.env:/var/www/html/.env'




### Nginx


    curl --location --request POST 'www.satott.com:8088/docker' \
    --progress-bar \
        --verbose \
    --header 'Authorization: [enter token here]' \
    --form 'checksum="[enter checksum here]"' \
    --form 'name="curriki_nginx"' \
    --form 'port="80:80,443:443"' \
    --form 'file=@"[enter file path from above step]"' \
    --form 'tag="noovo"' \
    --form 'restart="always"' \
    --form 'volumeSSD=/media/sda1/curriki/data/nginx/prod-conf:/etc/nginx/conf.d,/media/sda1/curriki/data/certbot/conf:/etc/letsencrypt,/media/sda1/curriki/data/certbot/www:/var/www/certbot,/media/sda1/curriki/data/nginx/log:/var/log/nginx'



### Moodle




    curl --location --request POST 'www.satott.com:8088/docker' \
    --progress-bar \
        --verbose \
    --header 'Authorization: [enter token here]' \
    --form 'checksum="[enter checksum here]"' \
    --form 'name="curriki_moodle"' \
    --form 'port="8250:80"' \
    --form 'file=@"[enter file path from above step]"' \
    --form 'tag="noovo"' \
    --form 'restart="always"' \
    --form 'volumeSSD=/media/sda1/curriki/moodle/config.php:/var/www/html/config.php,/media/sda1/curriki/moodle/moodledata:/var/www/moodledata'




Once these images are pushed and tagged. Following commands are needed to sync with device





# Sync images to device




    curl --location --request PUT 'www.satott.com:8088/group/docker' \
    --header 'Content-Type: application/json' \
    --header 'Authorization: [enter token here]' \
    --data-raw '{
    "gp": [group_id],
    "imgs":[
        {
        "repo": "[noovo-client-repo]",
        "tag": "box"
        },
        {
        "repo": "[noovo-api-repo]",
        "tag": "box"
        },
        {
        "repo": "[noovo-certbot-repo]",
        "tag": "box-v1.3"
        },
        {
        "repo": "[noovo-postgres-repo]",
        "tag": "box-v1.1"
        },
        {
        "repo": "[noovo-mysql-repo]",
        "tag": "box-v1.1"
        },
        {
        "repo": "[noovo-tsugi-repo]",
        "tag": "box"
        },
        {
        "repo": "[noovo-trax-repo]",
        "tag": "box"
        },
        {
        "repo": "[noovo-nginx-repo]",
        "tag": "box"
        },
        {
        "repo": "[noovo-moodle-repo]",
        "tag": "box"
        },
    ]
    }'







## NOte:

For ssl generation from lets-encrypt you need to open port 80 / 443 from device for public

Square brackeds are meant to be replaced 
