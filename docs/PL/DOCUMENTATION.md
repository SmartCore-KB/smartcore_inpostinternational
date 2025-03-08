# Moduł InPost International dla Magento 2

---
## Spis treści
1. [Informacje ogólne](#informacje-ogólne)
2. [Wymagania systemowe](#wymagania-systemowe)
3. [Instalacja](#instalacja)
4. [Uprawnienia](#uprawnienia)
5. [Autoryzacja](#autoryzacja)
6. [Konfiguracja modułu](#konfiguracja-modułu)
7. [Konfiguracja metody dostawy](#konfiguracja-metody-dostawy)
8. [Przesyłki](#przesyłki)
9. [Podjazdy kuriera](#podjazdy-kuriera)
10. [Szablony paczek](#szablony-paczek)
11. [Adresy podjazdu kuriera](#adresy-podjazdu-kuriera)
12. [Ceny oparte na wadze](#ceny-oparte-na-wadze)
13. [Dla developerów](#dla-developerów)
---
## Informacje ogólne
Moduł InPost International umożliwia integrację sklepu Magento 2 z międzynarodowymi usługami kurierskimi InPost. 
Główne funkcje:
- Nowa metoda dostawy w procesie zamówienia
- Cena metody dostawy zależna od wagi koszyka
- Integracja z geowidgetem (mapa punktów odbioru)
- Automatyczne lub ręczne tworzenie przesyłek międzynarodowych
- Zarządzanie szablonami przesyłek
- Zarządzanie adresami do podjazdu kuriera
- Zgłaszanie podjazdu kuriera
---
## Wymagania systemowe
Moduł jest przeznaczony dla sklepów opartych na Magento od wersji 2.4.4.  
Wymagania systemowe:
```json
{
    "php": ">=8.1.0 <8.3.0",
    "magento/framework": "^103.0.0",
    "magento/module-backend": "^102.0.0",
    "magento/module-store": "^101.0.0",
    "magento/module-sales": "^103.0.0",
    "firebase/php-jwt": ">=v6.10.1",
    "ext-openssl": "*",
    "ext-zip": "*"
}
```

---
## Instalacja
Moduł należy najpierw zainstalować na instalacji developerskiej lub testowej a dopiero po przetestowaniu na sklepie 
produkcyjnym. Instalacji oraz włączenia modułu powinien dokonywać developer posiadający doświadczenie z systemem Magento 2

1. Instalacja przez Composer (preferowana):
```bash
composer require smartcore/inpostinternational
bin/magento module:enable Smartcore_InPostInternational
bin/magento setup:upgrade
bin/magento setup:di:compile
bin/magento setup:static-content:deploy
```

2. Instalacja przez archiwum ZIP:
- Pobierz archiwum
- Rozpakuj archiwum do katalogu `app/code/Smartcore/InPostInternational`
- Wykonaj polecenia:
```bash 
bin/magento setup:upgrade
bin/magento setup:di:compile
bin/magento setup:static-content:deploy
```

---
## Uprawnienia
Aby zarządzać uprawnieniami do funkcjonalności modułu w panelu administracyjnym Magento 2, należy wykonać następujące kroki:
1. Zaloguj się do panelu administracyjnego Magento 2.
2. Przejdź do sekcji `System > Permissions > User roles`.
3. Wybierz rolę użytkownika, którą chcesz edytować lub utwórz nową rolę.
4. W zakładce `Role Resources` znajdź sekcję dotyczącą modułu InPost International.
5. Zaznacz odpowiednie zasoby, aby przyznać lub odebrać uprawnienia do poszczególnych funkcjonalności modułu.

Zasoby, którymi można zarządzać:
- `Tworzenie przesyłki`
- `Wyświetlanie listy przesyłek`
- `Tworzenie podjazdu kuriera`
- `Wyświetlanie listy podjazdów kuriera`
- `Tworzenie szablonu paczki`
- `Wyświetlanie listy szablonów paczek`
- `Tworzenie adresu podjazdu kuriera`
- `Wyświetlanie listy adresów podjazdów kuriera`
- `Tworzenie ceny metody dostawy zależnej od wagi koszyka`
- `Wyświetlanie listy cen metod dostawy zależnych od wagi koszyka`

Po zapisaniu zmian, użytkownicy przypisani do danej roli będą mieli odpowiednie uprawnienia do funkcjonalności modułu.  

---
## Autoryzacja

### Uzyskanie dostępu do API
Aby skonfigurować autoryzację z API InPost, należy wygenerować `ClientID` i `ClientSecret`.  
W tym celu należy skontaktować się z przedstawicielem InPost.  
Następnie w panelu administracyjnym Magento 2 należy skonfigurować dane autoryzacyjne klikając w menu 
`Sales > InPost International > Konfiguracja modułu` lub w sekcji `Stores > Configuration > Sales > Shipping Settings > 
InPost International`.  
Należy zwrócić uwagę na wybrany tryb działania API (Środowisko testowe / Produkcja) w polu `Tryb` oraz poprawność 
wprowadzonych danych autoryzacyjnych.  
Po wprowadzeniu i zapisaniu zmian należy kliknąć przycisk `Zaloguj do InPost` w celu uzyskania dostępu do API InPost.  
Wspomniany przycisk należy używać za każdym razem po zmianie danych autoryzacyjnych lub przełączeniu trybu działania API.

### Geowidget
Moduł InPost International wykorzystuje geowidget do wyświetlania mapy z punktami odbioru. Aby skonfigurować geowidget,
należy skontaktować się z przedstawicielem InPost w celu uzyskania `Tokena geowidgetu`.
Następnie należy wprowadzić token w konfiguracji modułu w polu `Token geowidgetu produkcyjny` lub `Token geowidgetu
testowy` w zależności od wybranego trybu działania API.

---
## Konfiguracja modułu
*Ścieżka: Stores > Configuration > Sales > Shipping Settings > InPost International* lub *Sales > InPost International > Konfiguracja modułu*

### Ustawienia API

| Pole                        | Opis                                                                                                                                                             |
|-----------------------------|------------------------------------------------------------------------------------------------------------------------------------------------------------------|
| Tryb                        | Tryb pracy API:<br>- Sandbox - Środowisko testowe<br>- Production - Środowisko produkcyjne. Pod tym polem wyświetlana jest aktualnie zainstalowana wersja modułu |
| ClientID produkcyjne        | ClientID dla środowiska produkcyjnego                                                                                                                          |
| ClientSecret produkcyjne    | ClientSecret dla środowiska produkcyjnego                                                                                                                         |
| ClientID testowe            | ClientID dla środowiska testowego                                                                                                                              |
| ClientSecret testowe        | ClientSecret dla środowiska testowego                                                                                                                             |
| Token geowidget produkcyjny | Token dla widgetu mapy w środowisku produkcyjnym                                                                                                                 |
| Token geowidget testowy     | Token dla widgetu mapy w środowisku testowym                                                                                                                     |

### Ustawienia przesyłek

| Pole                                                                  | Opis                                                                                                                                                                                            |
|-----------------------------------------------------------------------|-------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------|
| Kod cechy produktu z wagą                                             | Kod cechy produktu z wagą (domyślnie `weight`) - używany w przypadku wyliczania ceny wysyłki zależnej od wagi koszyka                                                                           |
| Automatycznie twórz przesyłkę InPost po złożeniu zamówienia           | W przypadku ustawienia na "Tak" używany jest domyślny szablon paczki, domyślny adres podjazdu kuriera oraz domyślny sposób wysyłki                                                              |
| Automatycznie twórz wysyłkę zamówienia po utworzeniu przesyłki InPost | W przypadku ustawienia na "Tak" automatycznie tworzony jest dokument przesyłki w Magento (Sales > Shipments) wraz z użyciem tam numeru trackingowego przesyłki.                                 |
| Po utworzeniu przesyłki InPost zmień status zamówienia                | Pozwala automatycznie zmienić status zamówienia na wybrany po utworzeniu przesyłki InPost do danego zamówienia                                                                                  |
| Automatycznie ustaw ubezpieczenie dla przesyłek InPost                | Automatyczne ubezpieczenie przesyłek InPost:<br>- Nie - Bez ubezpieczenia<br>- Tak, wartość zamówienia<br>- Tak, stała wartość<br/>Należy pamiętać że ubezpieczenie wyrażane jest w walucie EUR |
| Stała wartość ubezpieczenia                                           | To pole pojawi się w momencie wybrania "Tak, stała wartość" w polu powyżej. Pozwala ustawić kwotę ubezpieczenia                                                                                 |
| Production well-known url                                             | Adres url well-known z konfiguracją OpenID dla trybu produkcyjnego. Nie należy zmieniać bez wyraźnego powodu!                                                                                   |
| Sandbox well-known url                                                | Adres url well-known z konfiguracją OpenID dla trybu testowego. Nie należy zmieniać bez wyraźnego powodu!                                                                                       |

### Dane i ustawienia nadawcy

| Pole             | Opis                                                                                                                                              |
|------------------|---------------------------------------------------------------------------------------------------------------------------------------------------|
| Sposób wysyłki   | Sposób wysyłki:<br>- Z adresu (podjazd kuriera)<br>- Z punktu (Paczkomat, Punkt odbioru, inne)<br/>Pozwala zdecydować jak będą nadawane przesyłki |
| Kraj nadania     | Kraj nadania (dostępne tylko dla nadania z punktu). Obecnie tylko Polska.                                                                         |
| Nazwa firmy      | Nazwa firmy nadawcy                                                                                                                               |
| Imię             | Imię nadawcy                                                                                                                                      |
| Nazwisko         | Nazwisko nadawcy                                                                                                                                  |
| Email            | Email nadawcy                                                                                                                                     |
| Prefiks telefonu | Prefiks telefonu nadawcy                                                                                                                          |
| Numer telefonu   | Numer telefonu nadawcy                                                                                                                            |
| Język            | Język nadawcy                                                                                                                                     |
---
## Konfiguracja metody dostawy

### Podstawowa konfiguracja metody dostawy
*Ścieżka: Stores > Configuration > Sales > Delivery Methods* lub *Sales > InPost International > Konfiguracja metody dostawy*

### Ustawienia ogólne

| Pole                       | Opis                                                                |
|----------------------------|---------------------------------------------------------------------|
| Włączone                   | Włącza/wyłącza metodę dostawy InPost International                  |
| Tytuł                      | Tytuł metody dostawy                                                |
| Nazwa metody               | Nazwa metody dostawy                                                |
| Pozycja                    | Pozycja metody wysyłki na liście dostępnych metod                   |
| Logo w procesie zamówienia | Logo wyświetlane w koszyku (dozwolone formaty: jpg, jpeg, gif, png) |

### Kalkulacja ceny

| Pole                                | Opis                                                                                                                                                                                                                                                                                                                                                                                                                                                 |
|-------------------------------------|------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------|
| Typ kalkulacji ceny                 | Sposób kalkulacji ceny:<br>- Stała - Stała cena dla wszystkich przesyłek<br>- Na podstawie wagi koszyka - Cena uzależniona od wagi koszyka. Należy wówczas skonfigurować ceny dla zakresów wag w menu *Sales > InPost Internatioanl > Ceny oparte na wadze*                                                                                                                                                                                          |
| Gdy waga koszyka jest poza zakresem | Zachowanie gdy waga koszyka znajduje się poza zdefiniowanymi zakresami:<br>- Użyj ceny z pola "Cena" poniżej - jeśli waga koszyka jest poniżej, powyżej lub pomiędzy zdefiniowanymi zakresami w menu *Sales > InPost Internatioanl > Ceny oparte na wadze* wówczas zostanie użyta cena z pola "Cena"<br>- Nie zezwalaj na wysyłkę - Zablokuj możliwość wysyłki. Ta opcja może być użyteczna aby zablokować możliwość wysyłki zbyt ciężkich zamówień. |
| Cena                                | Stała cena wysyłki (używana gdy "Typ kalkulacji ceny" = Stała lub gdy waga koszyka jest poza zdefiniowanymi zakresami i wybrano odpowiednią opcję w polu powyżej)                                                                                                                                                                                                                                                                                    |

### Darmowa dostawa

| Pole                                      | Opis                                                             |
|-------------------------------------------|------------------------------------------------------------------|
| Włącz próg darmowej dostawy               | Włącza/wyłącza próg darmowej dostawy                             |
| Próg kwotowy darmowej dostawy             | Kwota zamówienia powyżej której dostawa tą metodą będzie darmowa |
| Próg kwotowy darmowej dostawy z podatkiem | Czy uwzględniać podatek w progu darmowej dostawy                 |

### Ograniczenia krajów

| Pole                          | Opis                                                                                                                                                                                                                                                                                                                                                                |
|-------------------------------|---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------|
| Wysyłka do dozwolonych krajów | Określa dostępność wysyłki dla krajów:<br>- Wszystkie dozwolone kraje - wybranie tej opcji umożliwi złożenie zamówienia z tą metodą dostawy do dowolnego dozwolonego kraju, ale nie spowoduje to że możliwe będzie utworzenie przesyłki przy użyciu InPost International<br>- Wybrane kraje - tylko kraje z pola poniżej do których wysyłkę aktualnie wspiera moduł |
| Wysyłka do wybranych krajów   | Lista krajów dla których dostępna jest wysyłka (aktywne gdy "Wysyłka do dozwolonych krajów" = "Wybrane kraje"). Ta lista pokazuje również aktualnie wspieraną przez moduł listę krajów docelowych.                                                                                                                                                                  |

---
## Przesyłki

### Lista przesyłek
*Ścieżka: Sales > InPost International > Przesyłki*

Panel umożliwia podgląd wszystkich przesyłek InPost w systemie. Statusy przesyłek odświeżane są co 30 minut. Przesyłi starsze niż 1 miesiąc nie są odświeżane.

#### Akcje dostępne dla pojedynczej przesyłki:
- Pobieranie etykiety PDF - poprzez kliknięcie linku "Etykieta" w kolumnie "Akcja". Nastąpi pobranie etykiety w formacie PDF z nazwą złożoną z numeru zamówienia oraz ID przesyłki.

#### Akcje masowe:
- Usuń - operacja spowoduje usunięcie przesyłki z bazy danych Magento ale nie z API InPost International.
- Pobierz etykiety przesyłek - etykiety są łączone w jeden plik ZIP z nazwą zawierającą datę i godzinę utworzenia. W pliku ZIP znajdują się etykiety w formacie PDF z nazwami złożonymi z numerów zamówień oraz ID przesyłek.

### Tworzenie nowej przesyłki

#### Z poziomu listy przesyłek
1. Kliknij przycisk "Dodaj przesyłkę" w prawym górnym rogu listy przesyłek. Przesyłkę można utworzyć bez powiązania z zamówieniem.
2. Wypełnij formularz przesyłki:
- Wybierz sposób wysyłki - z adresu lub z punktu, domyślnie wybrany jest ten sam co w konfiguracji modułu. W przypadku wysyłki z punktu nie trzeba deklarować punktu nadania.
- Wybierz szablon paczki - domyślnie wybrany jest ten który został oznaczony jako domyślny
- Wybierz adres podjazdu kuriera
- Wprowadź dane odbiorcy, kraj docelowy, język oraz punkt odbioru
3. Kliknij "Zapisz" aby utworzyć przesyłkę

#### Z poziomu podglądu zamówienia
1. Otwórz szczegóły zamówienia
2. W sekcji "Przesyłki InPost International" kliknij przycisk "Utwórz przesyłkę"
3. Dane odbiorcy i punkt dostawy zostaną automatycznie uzupełnione z zamówienia
4. Uzupełnij brakujące wymagane pola
5. Kliknij "Zapisz" aby utworzyć przesyłkę

### Akcje masowe na liście zamówień
*Ścieżka: Sales > Orders*

W widoku listy zamówień dostępne są następujące akcje masowe dla InPost International:
- Utwórz przesyłkę InPost International - tworzy przesyłki InPost dla wybranych zamówień używając danych zamówień oraz ustawień domyślnych
- Pobierz etykiety przesyłek InPost International - pobiera etykiety dla przesyłek powiązanych z wybranymi zamówieniami w formie jednego pliku ZIP

### Etykiety przesyłek
Etykiety można pobrać na kilka sposobów:
- Bezpośrednio z listy przesyłek (akcja dla pojedynczej przesyłki w kolumnie "Akcja")
- Poprzez akcję masową na liście przesyłek
- Z poziomu szczegółów zamówienia (akcja dla pojedynczej przesyłki w kolumnie "Akcja")
- Poprzez akcję masową na liście zamówień

---

## Podjazdy kuriera

### Przeznaczenie
Funkcjonalność "Podjazdy kuriera" służy do zarządzania zleceniami podjazdu kuriera InPost w celu odebrania przesyłek.
Pozwala na:
- Tworzenie nowych zleceń podjazdu
- Przeglądanie historii zleceń
- Usuwanie zleceń z systemu

### Lista podjazdów
*Ścieżka: Sales > InPost International > Podjazdy kuriera*

### Tworzenie nowego zlecenia

#### Dane adresowe
| Pole                   | Opis                                                                                                                                                                                                               | Walidacja                     |
|------------------------|--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------|-------------------------------|
| Adres podjazdu kuriera | Wybór zdefiniowanego adresu podjazdu. Po wybraniu adresu system automatycznie sprawdza i wyświetla maksymalną godzinę podjazdu dla danego kodu pocztowego.                                                         | Wymagane                      |
| Podjazd od             | Data i godzina początku przedziału czasowego. Należy zwrócić uwagę na strefę czasową ustawioną w instalacji Magento ponieważ zdefiniowana w tym polu godzina jest przeliczana do strefy UTC i tak wysyłana do API. | Wymagane                      |
| Podjazd do             | Data i godzina końca przedziału czasowego. Podobnie jak wyżej, należy zwrócić uwagę na strefę czasową Magento.                                                                                                     | Wymagane                      |
| Liczba paczek          | Liczba paczek do odebrania                                                                                                                                                                                         | Wymagane, liczba większa od 0 |
| Całkowita waga paczek  | Łączna waga paczek                                                                                                                                                                                                 | Wymagane, liczba większa od 0 |
| Jednostka wagi paczek  | Obecnie tylko "Kilogramy"                                                                                                                                                                                          | Wymagane                      |
| Typ paczek             | Obecnie tylko "Paczka"                                                                                                                                                                                             | Wymagane                      |

### Usuwanie zlecenia
Usunięcie zlecenia z systemu:
- Usuwa wpis z bazy danych Magento
- **Nie powoduje anulowania zlecenia w systemie InPost** - zlecenie nadal będzie aktywne w API InPost
- Nie można cofnąć tej operacji

---
## Szablony paczek

### Przeznaczenie
Szablony paczek służą do przechowywania predefiniowanych ustawień paczek, które są później wykorzystywane podczas 
tworzenia przesyłek. Dzięki szablonom nie trzeba każdorazowo wprowadzać wymiarów i innych parametrów paczki.

Szablony są wykorzystywane w:
- Formularzu tworzenia nowej przesyłki
- Masowym tworzeniu przesyłek
- Automatycznym tworzeniu przesyłek po złożeniu zamówienia

### Lista szablonów
*Ścieżka: Sales > InPost International > Szablony paczek*

### Tworzenie / edycja szablonu

#### Pola podstawowe
| Pole                     | Opis                                                                                                            | Walidacja                                                                                                     |
|--------------------------|-----------------------------------------------------------------------------------------------------------------|---------------------------------------------------------------------------------------------------------------|
| Domyślny                 | Ustawia szablon jako domyślny. Ustawienie aktualnego szablonu jako domyślny wyłączy poprzedni domyślny szablon. | -                                                                                                             |
| Etykieta szablonu paczki | Nazwa identyfikująca szablon - służy tylko łatwiejszej identyfikacji szablonu w formularzu tworzenia przesyłki. | Wymagane                                                                                                      |
| Typ paczki               | Obecnie tylko "Standard"                                                                                        | Wymagane                                                                                                      |
| Długość                  | Długość paczki                                                                                                  | Wymagane, liczba większa od 0                                                                                 |
| Szerokość                | Szerokość paczki                                                                                                | Wymagane, liczba większa od 0                                                                                 |
| Wysokość                 | Wysokość paczki                                                                                                 | Wymagane, liczba większa od 0                                                                                 |
| Jednostka wymiarów       | Obecnie tylko "Centymetry"                                                                                      | Wymagane                                                                                                      |
| Waga                     | Waga paczki                                                                                                     | Wymagane, liczba większa od 0                                                                                 |
| Jednostka wagi           | Obecnie tylko "Kilogramy"                                                                                       | Wymagane                                                                                                      |
| Komentarz do paczki      | Komentarz wyświetlany na etykiecie. Można użyć `{orderId}` aby wstawić numer powiązanego zamówienia.            | Opcjonalne. Musi być wypełnione razem z kodem kreskowym albo nie pojawi się na etykiecie.                     |
| Kod kreskowy             | Kod kreskowy wyświetlany na etykiecie. Można użyć `{orderId}` aby wstawić numer powiązanego zamówienia.         | Opcjonalne. Musi być wypełnione razem z komentarzem. Tylko litery i cyfry (bez spacji, maksymalnie 16 znaków) |

### Domyślny szablon
- W systemie może być tylko jeden domyślny szablon
- Ustawienie nowego szablonu jako domyślnego automatycznie wyłącza tę opcję dla poprzedniego domyślnego szablonu
- Domyślny szablon jest używany przy:
  - Masowym tworzeniu przesyłek
  - Automatycznym tworzeniu przesyłek
  - Jako domyślnie wybrana opcja w formularzu nowej przesyłki

---
## Adresy podjazdu kuriera

### Przeznaczenie
Adresy podjazdu kuriera służą do przechowywania predefiniowanych lokalizacji, z których kurier InPost będzie odbierał 
przesyłki. Są wykorzystywane w przypadku wysyłki typu "Z adresu (podjazd kuriera)" i mogą zawierać inne adresy niż te z 
konfiguracji "Dane i ustawienia nadawcy" ponieważ dotyczą punktów fizycznego odbioru przesyłek.

Zdefiniowane adresy są wykorzystywane w:
- Formularzu tworzenia nowej przesyłki
- Masowym tworzeniu przesyłek
- Automatycznym tworzeniu przesyłek po złożeniu zamówienia
- Tworzeniu zleceń podjazdu kuriera

### Lista adresów
*Ścieżka: Sales > InPost International > Adresy podjazdu kuriera*

### Tworzenie / edycja adresu

#### Ustawienia podstawowe
| Pole                               | Opis                                                                                                      | Walidacja              |
|------------------------------------|-----------------------------------------------------------------------------------------------------------|------------------------|
| Domyślny                           | Ustawia adres jako domyślny. Ustawienie aktualnego adresu jako domyślny wyłączy poprzedni domyślny adres. | -                      |
| Etykieta                           | Nazwa identyfikująca adres - służy do łatwiejszej identyfikacji adresu w formularzu tworzenia przesyłki.  | Wymagane               |
| Imię osoby kontaktowej             | Imię osoby kontaktowej dla kuriera dostępnej pod danym adresem.                                           | Wymagane               |
| Nazwisko osoby kontaktowej         | Nazwisko osoby kontaktowej                                                                                | Wymagane               |
| Email osoby kontaktowej            | Email osoby kontaktowej                                                                                   | Wymagane               |
| Prefiks telefonu osoby kontaktowej | Prefiks telefonu                                                                                          | Wymagane               |
| Numer telefonu osoby kontaktowej   | Numer telefonu                                                                                            | Wymagane               |
| Ulica                              | Ulica                                                                                                     | Wymagane               |
| Numer domu                         | Numer domu                                                                                                | Wymagane               |
| Numer mieszkania                   | Numer mieszkania                                                                                          | Opcjonalne             |
| Kod pocztowy                       | Kod pocztowy                                                                                              | Wymagane               |
| Miasto                             | Miasto                                                                                                    | Wymagane               |
| Kraj                               | Kraj                                                                                                      | Wymagane, tylko Polska |
| Opis lokalizacji                   | Opis lokalizacji ułatwiający odnalezienie adresu                                                          | Wymagane               |

### Domyślny adres
- W systemie może być tylko jeden domyślny adres
- Ustawienie nowego adresu jako domyślnego automatycznie wyłącza tę opcję dla poprzedniego domyślnego adresu
- Domyślny adres jest używany przy:
  - Masowym tworzeniu przesyłek
  - Automatycznym tworzeniu przesyłek
  - Jako domyślnie wybrana opcja w formularzu nowej przesyłki
  - Jako domyślnie wybrana opcja w formularzu zlecenia podjazdu kuriera

---

## Ceny oparte na wadze

### Przeznaczenie
System cen opartych na wadze pozwala na definiowanie różnych stawek za przesyłkę w zależności od łącznej wagi produktów 
w koszyku. Jest to alternatywa dla stałej ceny wysyłki. Waluta oraz ewentualny podatek są zgodne z konfiguracją sklepu.
Aby aktywować ceny oparte na wadze należy:
1. Przejść do *Stores > Configuration > Sales > Delivery Methods > InPost International - Przesyłka międzynarodowa do punktu*
2. W polu "Typ kalkulacji ceny" wybrać opcję "Na podstawie wagi koszyka"
3. Zdefiniować co najmniej jeden zakres wagowy w sekcji *Sales > InPost International > Ceny oparte na wadze*

### Lista zakresów wagowych
*Ścieżka: Sales > InPost International > Ceny oparte na wadze*

### Tworzenie/edycja zakresu

#### Pola formularza
| Pole    | Opis                          | Walidacja                                                                                                  |
|---------|-------------------------------|------------------------------------------------------------------------------------------------------------|
| Waga od | Początek zakresu wagowego     | Wymagane, liczba ≥ 0                                                                                       |
| Waga do | Koniec zakresu wagowego       | Opcjonalne, liczba > "Waga od". Jeśli nie podano, ten zakres będzie działał do nieskończonej wagi koszyka. |
| Cena    | Cena dostawy dla tego zakresu | Wymagane, liczba ≥ 0                                                                                       |

#### Przykłady zakresów
    Od 0.00 do 1.09 kg - 10 EUR  
    Od 1.10 do 2.00 kg - 15 EUR  
    Od 2.01 do 5.00 kg - 20 EUR  
    Od 5.01 do (bez górnego limitu) - 30 EUR  

### Proces wyliczania ceny w koszyku
1. System sumuje wagę wszystkich produktów w koszyku
2. Wyszukuje zakres wagowy, w którym mieści się łączna waga
3. Przypisuje cenę z odpowiedniego zakresu
4. Jeśli waga nie mieści się w żadnym zakresie:
    - Zachowanie zależy od ustawienia "Gdy waga koszyka jest poza zakresem" w konfiguracji metody dostawy:
        - "Użyj ceny z pola Cena poniżej" - używa ceny zdefiniowanej w polu "Cena"
        - "Nie zezwalaj na wysyłkę" - metoda wysyłki staje się niedostępna

### Walidacja zakresów wagowych
System nie pozwala na utworzenie nakładających się zakresów. Przykłady nieprawidłowych konfiguracji:

    Od 0 do 2 kg
    Od 1 do 3 kg  // Nakłada się z poprzednim zakresem

    Od 0 do 5 kg
    Od 5 do 10 kg  // Nakłada się w punkcie 5 kg

Prawidłowe:

    Od 0 do 5 kg
    Od 5.01 do 10 kg  // Jest przerwa między zakresami

    Od 0 do 5 kg
    Od 6 do 10 kg  // Jest przerwa między zakresami

### Nieograniczony górny zakres
- Pole "Waga do" może pozostać puste
- Oznacza to, że zakres obejmuje wszystkie wagi powyżej wartości "Waga od"
- W danym momencie może istnieć tylko jeden zakres bez górnego limitu

### Uwagi
1. Waga produktów jest pobierana z atrybutu zdefiniowanego w konfiguracji modułu (domyślnie "weight")
2. Produkty bez zdefiniowanej wagi są traktowane jako produkty o wadze 0
3. System nie sprawdza maksymalnej wagi paczki - jest to weryfikowane podczas tworzenia przesyłki
4. Ceny oraz wagi można definiować z dokładnością do 2 miejsc po przecinku

---
## Dla developerów
### Dane punktu odbioru
Identyfikator punktu odbioru wybranego w procesie zamówienia jest zapisywany w tabelach `quote` oraz `sales_order` w kolumnie 
`inpostinternational_locker_id`. Z kolei pełne dane tego punktu (adres, godziny otwarcia, itp.) są zapisywane w kolumnie 
`inpostinternational_locker_data` w formacie JSON.

### Events
Moduł wykorzystuje następujące eventy:
`sales_order_place_after` - automatyczne tworzenie przesyłki   
`inpostinternational_shipment_created` - aktualizacja statusu zamówienia oraz tworzenie Magento order shipment   
`sales_model_service_quote_submit_before` - zapis punktu odbioru do zamówienia  
