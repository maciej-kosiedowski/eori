Laravel number eori validation
---

## Installing

```shell
composer require slimad/eori
```

Example usage:
```
'eori' => 'sometimes|string|regex:/^[A-Z]{2}[A-Za-z0-9]{1,15}$/|eori',
```

Tested with laravel 9


## License

MIT
