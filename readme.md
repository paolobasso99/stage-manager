## Install

* git clone https://github.com/paolobasso99/stage-manager.git
* L'estensione ```php-ldap``` deve essere installata nel LAMP
* ```mysql -u user -p database-name < dump.sql```
* ```composer install```
* Copiare ```.env.example``` in ```.env```
* Configurare LDAP/mail/database in ```.env```
* Login tramite LDAP
* Assegnare il ruolo di admin all'utente ```php artisan voyager:admin your@email.com```
* ```php artisan check:sync-emails``` per sincronizare le email con LDAP.
* Aggiungere [Cron](https://laravel.com/docs/5.4/scheduling).


## Commands

# Voyager
* ```php artisan voyager:admin your@email.com```: Assegna il ruolo di admin all'utente.

# Check
* ```php artisan check```: Controlla i siti che dovrebbero essere controllati.
* ```php artisan check:all```: Controlla tutti i siti.
* ```php artisan check:reset```: Resetta il contatore dei siti che hanno fallito il controllo
* ```php artisan check:sync-emails```: Sincronizza emails con LDAP


## To do

* Refactoring (eventi?)
* Fix mail login
* Migliorare GUI


## Quando ho finito

* Rimuovi testing email dall'invio
* Implementa ShouldQueue per le emails
