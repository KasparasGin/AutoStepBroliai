1.Install xampp

2.Install composer
https://getcomposer.org/

3.Install git (atsisiųst projektą jaučiu ir be jo išeis bet sukelt vistiek reiks)
https://git-scm.com/downloads

4.Parsipučiat projektą

5.Atsidaryt cmd, nueit į projekto direktoriją

6.Konsolėj: composer install, palaukt kol atsiųs ir suinstaliuos viską

7.Surast projekte .env failą, surast eilutę kur db konfigūruoja (DATABASE_URL=mysql://root:@127.0.0.1:3306/symfony)šitą galit įkopint

8.Konsolėj: php bin/console doctrine:database:create (sukurs duombazę)

9.Konsolėj: php bin/console doctrine:schema:update --force (lenteles sukurs)

10.Konsolėj php bin/console server:run

Turėtų pasileist ir veikt
