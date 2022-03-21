# 1. comment s'installe faker ?
```
Pour installer Faker il faut une version de PHP >= 7.1 et faire 
composer require fakerphp/faker
```

# 2. donnez un exemple de code pour générer une adresse américaine en utilisant faker
```
$faker = Faker\Factory::create();
echo $faker->address();
```

# 3. formattez une date en type DateTime : "2017/02/16 (16:15)"
```
echo date_format($faker->date(), 'Y/m/d').' ('.date_format($faker->time(), 'H:i').')';
```

