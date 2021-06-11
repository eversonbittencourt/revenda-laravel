APIs

## Autenticação

### POST `/api/login`
Login
```json
{
    "email" : "test@test.com",
    "password" : "12345"
}
```

## Endereços

### POST `/api/addresses/consult/post-code`
Consulta de endereço por cep
```json
{
    "post_code" : "89223250"   
}
```

### POST `/api/addresses/consult/route`
Consulta de endereço via logaduro
```json
{
    "route" : "roberto"   
}
```

### POST `/api/addresses`
Cadastro de endereço
```json
{
	"post_code" : "99999998",
	"route" : "Rua Professor Felicio Fuzinato",
	"neighborhood" : "Costa e Silva",
	"city" : "Joinville",
	"state" : "SC"
}
```

### PUT `/api/addresses/{id}`
Atualização de endereço
```json
{
	"post_code" : "99999998",
	"route" : "Rua Professor Felicio Fuzinato",
	"neighborhood" : "Costa e Silva",
	"city" : "Joinville",
	"state" : "SC"
}
```

### GET `/api/addresses/{id}`
Consulta de endereço via ID

### DELETE `/api/addresses/{id}`
Excluir endereço

### GET `/api/addresses`
Consulta de todos endereços

## Usuários

### POST `/api/users`
Cadastro de usuário 
```json
{
	"name" : "Uset Test 1",
	"email" : "user.test1@test.com",
	"password" : "12345",
    "password_confirmation" : "12345"
}
```

### PUT `/api/users/{id}`
Atualização de usuário
```json
{
	"name" : "Uset Test 1",
	"email" : "user.test1@test.com",
	"password" : "12345",
    "password_confirmation" : "12345"
}
```

### GET `/api/users/{id}`
Consulta de usuário via ID

### DELETE `/api/users/{id}`
Excluir usuário

### GET `/api/users`
Consulta de todos usuários