## Setup'as

1. docker-compose build && docker-compose up -d
2. npm install && npm run dev
3. docker-compose exec php php /var/www/html/artisan migrate
4. docker-compose exec php php /var/www/html/artisan db:seed

Stalų ir restoranų kūrimo Admin panelėje nebus. Tačiau juos galite kurti šiais enpoint'ais:
* POST /admin/restaurant-with-tables
* POST /admin/table

Norint atlikti rezervaciją būtina prisijungti kaip vartotojui.

Norint peržvelgti rezervacijas būtina prisijungti kaip adminui.

Jei turėsite klausimų - rašykite!



