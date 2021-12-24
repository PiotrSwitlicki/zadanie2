Zadanie 1. Parsowanie/szukanie danych: (wo_for_parse.html)
- na postawie dostarczonego pliku (HTML) przygotuj parser

Dane ktore potrzebujemy wyciagnac do pliku CSV

- Tracking Number

- PO Number

- Data `Scheduled` w formacie daty i godziny (Y-m-d H:i)

- Customer

- Trade

- NTE (jako liczba float - bez formatowania)

- Store ID

- Address z rozbiciem na ulica,

- miasto,

- stan (2 litery)

- kod pocztowy

- Telefon (bez formatowania)


Rozwiązanie: Główny plik PHP HomeController jest w folderze app\Http\Controllers natomiast csv i plik do parsowania są w folderze public. Aplikację należy uruchamiać z wyłączonym podglądem pliku csv.
Adnotacja: Dane w dacie przekształciłem do właściwej kolejności na arrayach, żeby przyspieszyć pracę, ale bez problemu umiem to zrobić przy pomocy funkcji php data time. 
