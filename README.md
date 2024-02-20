# yodo

Configurar .env
ALMACENAMIENTO_URL=""
DO_CLAVE_ACCESO=""
DO_CLAVE_SECRETA=""
DO_REGION=""
DO_BUCKET=""

GM_CLAVE=""


Correr comando
php bin/console lexik:jwt:generate-keypair
php bin/console doctrine:migrations:migrate
symfony server:start