
# Installation :

composer update

composer require symfony/webpack-encore-bundle

yarn install

yarn encore dev  

# Insertion par role :
     Dans la table users , il y trois roles à inserer qui sont :
    '[\"ROLE_DOCTOR\"]'
    '[\"ROLE_PATIENT\"]'
    '[\"ROLE_ADMINER\"]'
    
# Paramétrer votre email pour l'enregistrement du compte

 * Dans votre fichier .env.local :
 
     MAILER_URL=smtp://your_smtp_server:587?encryption=tls&auth_mode=login&username=your_username&password=your_password

 * Dans votre fichier config/services.yaml, définissez l'adresse e-mail de l'expéditeur en tant que paramètre :

     * config/services.yaml
     
          parameters:
               mailer_from_address: 'votre-email'

 # Vidéo explicative sur youtube : 
 
     https://youtu.be/5Z9LRWOTC14
     

