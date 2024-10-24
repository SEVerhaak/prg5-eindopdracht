
## 10 Okt:
- Eerste view aangemaakt ()
- Eerste controller aangemaakt ()

## 13 Okt:
- eerste ERD gemaakt

## 14 Okt:
- secret controller gemaakt, geeft array mee
- secret pagina, route en view aangemaakt
- custom navbar component aangemaakt
- navbar past aan of gebruiker ingelogd is
- log out knop toegevoegd

## 15 Okt:
- Eerste 2 DB toegevoegd (genres & albums)
- Breeze toegevoegd voor inloggen, registratie en authenticatie
- Eerste pagina toegevoegd met overzicht van alle albums
- Ingelogde gebruikers kunnen nu alle albums zien

## 17 okt
- Eerste form aangemaakt om albums toe te voegen
- Foreign keys toegevoegd aan de albums & user tabel
- User tabel gekoppeld aan de albums tabel
- Users kunnen nu een album uploaden en dat zit aan hun account gekoppeld
- Relaties van de DB gemaakt door middel van models (Album.php, Genre.php, User.php)

## 21 okt
- Plaatjes kunnen nu aan de database toegevoegd worden (Nog een blob)
- Erachter gekomen tijdens de les dat je beter plaatjes kan opslaan in de storage map dan een blob gebruiken
- Plaatjes worden nu opgeslagen in de /storage/albums
- Plaatjes worden nu correct weergeven in de overview
- Bij het aanmaken van een album is er nu een dropdown die alle genres uit de DB ophaalt waaruit de gebruiker kan kiezen
- Alles in 1 controller gezet en daarmee CRUD afgemaakt (AlbumController.php)

## 22 okt
- Navigatie op de CRUD paginas toegevoegd waardoor er niet meer in de zoekbalk genavigeerd hoeft te worden
- Zoekfunctie toegevoegd aan de AlbumController.php, aparte functie, zoekt op naam & artist in de DB
- Authenticatie toegevoegd voor albums verwijderen en gebruikers inzien
- Admin rol kan nu albums van gebruikers verwijderen
- Bij een album toevoegen kan je nu selecteren of die openbaar is ja of nee 
- view & controller aangepast voor de user edit functionaliteit voor de admin

## 24 okt
- Alles even opgeschoond, alle ongebruikte bestanden verwijderd, alle hoofd pagina's aan mappen toegevoegd voor overzicht
- Eerste CSS toegevoegd om het wat duidelijker te maken waarmee ik aan het werken ben
