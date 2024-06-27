# API de Consulta de Cachorros

criei usando wordpress com ACF, estou usando headless com uma front em react(https://adotome-frontend.vercel.app/)

## Endpoint de Consulta

Para consultar informações sobre os cachorros, utilize o endpoint:

## Parâmetros de Consulta

Você pode usar os seguintes parâmetros de query para filtrar os resultados:

- `age`: lista de idades (exemplo: `age=1,2,3`)
- `size`: lista de tamanhos (exemplo: `size=small,medium`)
- `gender`: lista de gêneros (exemplo: `gender=male,female`)
- `page`: número da página para paginação (exemplo: `page=1`)

## Exemplos de Uso

### Todos os cachorros: 

GET /wp-json/dogs/v1/all

### Filtrando por idade: 

/wp-json/dogs/v1/dogs?age=1,2&page=1

### Filtrando por tamanho: 

/wp-json/dogs/v1/dogs?size=small,large&page=1

### Filtrando por gênero:

/wp-json/dogs/v1/dogs?gender=male&page=1

### Combinando filtros:

/wp-json/dogs/v1/dogs?age=1,2&size=small,large&gender=male&page=1

- OBS.: Certifique-se de substituir `wp-json/dogs/v1` pelo caminho correto da sua API. Para mais detalhes sobre os filtros disponíveis, consulte a seção de Parâmetros de Consulta acima.
 





