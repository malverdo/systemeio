# Тестовое задание systemeio

## [Задача](https://github.com/systemeio/test-for-candidates/blob/main/README.md)
- Написать symfony REST приложение для рассчета цены продукта и проведения оплаты


## Router
- Postman collections - /etc

Расчет цены POST http://localhost:2095/v1/calculation/price
```json
{
    "product": "Iphone",
    "taxNumber": "DE123456789",
    "couponCode": "D16",
    "paymentProcessor": "paypal"
}
```
Оплата POST http://localhost:2095/v1/payment/processor
```json
{
    "product": "Iphone",
    "taxNumber": "DE123456789",
    "couponCode": "D16",
    "paymentProcessor": "paypal"
}
```

### Validation Router
- product
    - NotBlank
- taxNumber
    - NotBlank
    - Regex('/^[A-Z]{2,4}[0-9]+$/')
- couponCode
    - optional
- paymentProcessor
    - NotBlank
    - Choice(['paypal', 'stripe', 'newstripe'])





# Поднятие проекта
## Команды 
```
docker-compose build
docker-compose up -d
docker exec systemeio_php composer install
docker exec systemeio_php php bin/console doctrine:migrations:migrate
docker exec systemeio_php php bin/console doctrine:fixtures:load -n
```

---

## OR

---

## Makefile
- Linux установка "sudo apt install make"
- Выполнить команду (всё тоже самое что и команды выше только одной командой)
```
make first-start
```


## Схема работы 

CalculationController ищет аргумент CalculationPriceRequest, RequestResolver проверяет и отправляет в CalculationPriceFormType,
Контроллер в случее успеха отправляет в траспорт query|command где происходит обработка, в случае успеха контроллер вызывает ResponseFactory

![img.png](Images%2Fimg.png)


## Дополнительно
- Использовал Статический анализ кода ["friendsofphp/php-cs-fixer"](https://github.com/PHP-CS-Fixer/PHP-CS-Fixer) 
- Засекретил [ENV](https://symfony.com/doc/current/configuration/secrets.html)
- UnitTest не сделал

## БД

```sql
DB_HOST=postgres
DB_DBNAME=systemeio
DB_PORT=5432
DB_USER=postgres
DB_PASSWORD=root
```

- **country_tax** 
  - id
  - percent
  - format
  - code
  - symbol
  - full_tax_number
- **coupon**
  - id
  - type
  - code
  - amount
- **product**
  - id
  - name
  - price_rub_amount
  - price_usd_amount
  - price_eur_amount