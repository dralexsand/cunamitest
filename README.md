## Api currency


### Create account:
```
POST:
http://127.0.0.1:8000/api/v1/create-account?name=Filomena Herman&email=ursula.dach@example.org&password=password

{
    "token": "2|MlxpTlVqJnYu4we66jnfM4hczZhTAnUhacIDAp1B"
}
```

### Sign in:
```
POST:
http://127.0.0.1:8000/api/v1/signin?name=Filomena Herman&email=ursula.dach@example.org&password=password

{
    "token": "2|MlxpTlVqJnYu4we66jnfM4hczZhTAnUhacIDAp1B"
}
```

### Get latest currencies
```
GET:
http://127.0.0.1:8000/api/v1/rates/specific?currency=EUR,GBP&base_currency=USD

{
    "GBP": 0.75531,
    "EUR": 0.88881
}
```
### Get currencies by data range
```
GET:
http://127.0.0.1:8000/api/v1/rates/dynamics?currency=EUR,GBP,CNY&base_currency=USD&date_from=2020-10-01&date_to=2021-12-19


{
    "2020-10-01": {
        "EUR": 0.85151,
        "GBP": 0.77609,
        "CNY": 6.79047
    },
    "2020-10-02": {
        "EUR": 0.8535,
        "GBP": 0.7732,
        "CNY": 6.74534
    },
    "2020-10-03": {
        "CNY": 6.79099,
        "EUR": 0.85348,
        "GBP": 0.77321
    },
    "2020-10-04": {
        "EUR": 0.85346,
        "GBP": 0.77357,
        "CNY": 6.79094
    },
    ...
}

```
