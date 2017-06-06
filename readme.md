## Install

* git clone https://github.com/paolobasso99/stage-manager.git
* L'estensione ```php-ldap``` deve essere installata
* ```mysql -u user -p database-name < dump.sql```
* Copiare ```.env.example``` in ```.env```
* Configurare LDAP/mail/database in ```.env```
* ```composer install```
* Login tramite LDAP
* Assegnare il ruolo di admin all'utente ```php artisan voyager:admin {email}```
* ```php artisan check:sync-ldap``` per sincronizare le email con LDAP.
* Aggiungere [Cron](https://laravel.com/docs/5.4/scheduling).


## Commands

# Voyager
* ```php artisan voyager:admin {email}```: Assegna il ruolo di admin all'utente.

# Check
* ```php artisan check```: Controlla i siti che dovrebbero essere controllati.
* ```php artisan check:all```: Controlla tutti i siti.
* ```php artisan check:urls {urls*}```: Controlla un array di siti trovati in base all'url.
* ```php artisan check:reset```: Resetta il contatore dei siti che hanno fallito il controllo
* ```php artisan check:sync-ldap```: Sincronizza emails con LDAP


## To do

* key-server relation GUI
* Crypt password nel db
* Fix mail login


## Quando ho finito

* Aggiungi validation to sites
* Rimuovi testing email
* Implementa ShouldQueue per le emails
* Elimina dummy routes
* Elimina dummy users
* Fix roles
