# yodo

Configurar .env
ALMACENAMIENTO_URL="123"
DO_CLAVE_ACCESO="123"
DO_CLAVE_SECRETA="123"

Correr comando
php bin/console lexik:jwt:generate-keypair
php bin/console doctrine:migrations:migrate
symfony server:start