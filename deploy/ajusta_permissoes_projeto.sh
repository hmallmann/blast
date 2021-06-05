#/bin/bash
find . -type d -print0 | xargs -0 chmod 0755
find . -type f -print0 | xargs -0 chmod 0644
chmod 777 -Rf storage/
chmod 777 -Rf bootstrap/cache/
chmod 777 -Rf public/
chmod 777 -Rf .env
chmod 777 -Rf temp/
chmod +x deploy/*.sh