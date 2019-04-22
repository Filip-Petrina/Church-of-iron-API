Za testiranje loyalty login-a (HISHotelMobAppLoginLoyalty) možete koristiti sljedeće podatke:
LoyaltyID: 101580023188
Pass: 123456789

Primjer za metodu HISHotelMobAppLoginLoyalty:

XML poruka zahtjeva:

```
   <soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:lls="LLSoapNamespace">
   <soapenv:Header>
      <lls:ZaglavljeHIS>
         <Username>nivas_app</Username>
         <Password>llnivasapp123</Password>
         <Database>matis1.world</Database>
      </lls:ZaglavljeHIS>
   </soapenv:Header>
   <soapenv:Body>
      <lls:HISHotelMobAppLoginLoyaltyUpit>
         <LoyaltyID>123456789</LoyaltyID>
         <Password>pass</Password>
      </lls:HISHotelMobAppLoginLoyaltyUpit>
   </soapenv:Body>
</soapenv:Envelope>
```


Metodu HISHotelMobAppLoginRezervacija možete testirati sa:
KodRezervacije - 1avavtdtje
DatumDolaska – 09.10.2019.


### Common commands

Brisanje doctrine cache-a


```
bin/console doctrine:cache:clear-metadata
```

Update scheme


```
bin/console d:s:u --force
```

Brisanje cache-a aplikacije


```
bin/console c:c
```

Izvrši sve migracije


```
bin/console doctrine:migrations:migrate
```

Pokreni lokalni php server


```
bin/console server:run
```

### Git save credentials

```
git config --global user.useConfigOnly false
git config user.name "filipp"
git config user.email "filipp@nivas.hr"
git config credential.${remote}.username filipp
git config credential.helper store
```