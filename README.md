# Adminwebbplats för Johans Kök
av Jessica Ejelöv, jessicaejelov@gmail.com
Projekt för kursen Webbutveckling III på Mittuniversitetet. 

## Om webbplatsen
Denna webbplats är slutprojektet i kursen Webbutveckling III på Mittuniversitetet. 
Projektet handlar om att skapa en webbplats för en restaurang där man kan boka bord, se menyn samt kontakta restaurangen. En admin sida där man ska kunna lägga till maträtter på menyn samt hantera menyn och bokningar med ändringar och radera. Dessa två sidor ska konsumera en webbtjänst som är kopplad till en databas där menyer och bokningar sparas.
Det är en del av tre : Klient webbplats, Admin webbplats och webbtjänst som webbplatserna skickar och hämtar data från. 
### Länk
Demo på klient webbplatsen hittas [här](https://studenter.miun.se/~jeej2100/writeable/johanskok/).

## Konsumerar REST-webbtjänst 
Detta projekt konsumerar data från denna [webbtjänst](https://studenter.miun.se/~jeej2100/writeable/johansAPI/).
Github [länk](https://github.com/Webbutvecklings-programmet/projekt_webservice_vt22-Jessofnorth).

Webbtjänsten konsumerar webbtjänsten via FETCH och CURL och är uppbyggd av HTML, SASS, Javascript samt PHP. 

## CURL och FETCH
Denna webbplats hanterar att lägga till maträtter på menyn, uppdatera och radera maträtter samt bokningar. 
Updatera samt Radera sköts av FETCH. Även hämtning av bokningar sköts av FETCH. 
Hämtning och lägga till maträtter sköts av CURL. 
Inloggning sköts även det av CURL. 

## Klasser 
Det finns två klasser i PHP kod. 
Menu.class.php: hanterar hämtning samt addering av maträtter. 
User.class.php: Loggar ut användaren från admin sidan. 

## Endpoints mot webbtjänsten
 - menu.php : för att hämta, ändra, radera samt addera maträtter.
 - menu.php?category= : hämtar maträtter efter vilken kategori som anges. Tex starter för förrätter. 
 - login.php : för att logga in användaren. 
 - booking.php : för att hämta, ändra samt radera bokningar.

## Användning av webbplatsen
1. Lägg till en maträtt genom att fylla i formuläret med samtlig efterfrågad information och klicka på knappen. 
2. Listan med maträtter och listan med bokingar har `contenteditable`och kan därför klickas på för att ändra till exempel pris på maträtt. 
3. Klicka sedan på spara knappen under den post du vill ändra så sparas ändringen genom ett FETCH anrop mot webbtjänsten. Du får inte lämna några tomma fält. 
4. För att radera en post, klicka på knappen Radera under den specifika posten.


