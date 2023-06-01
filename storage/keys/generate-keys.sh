sudo ssh-keygen -m pem -f sign_jwt -q -N ""
openssl rsa -in sign_jwt -pubout -out sign_jwt.pub
sudo chown www-data:www-data *
