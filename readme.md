## Install

1. git clone https://github.com/paolobasso99/stage-manager.git
2. composer Install
3. mysql -u user -p < dump.sql
4. Configurare mail in ```.env```
5. Login -> User = admin@admin.com / password = password

## Commands

* ```check``` Controlla i siti che dovrebbero essere controllati.
* ```check:all``` Controlla tutti i siti.
* ```check:reset``` Resetta il contatore dei siti che hanno fallito il controllo

## To do

1. Più velocità -> Queue per emails + guzzle async ?
