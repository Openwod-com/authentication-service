sudo ssh-keygen -m pem -f ./sign_jwt -q -N ""
sudo ssh-keygen -y -f sign_jwt -m pem -e > sign_jwt.pub
sudo chown www-data:www-data *
