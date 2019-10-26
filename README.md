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