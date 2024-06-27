## Endpoint de Consulta
GET /wp-json/dogs/v1/search

# Parâmetros de query possíveis:

age: lista de idades (exemplo: age=1,2,3)
size: lista de tamanhos (exemplo: size=small,medium)
gender: lista de gêneros (exemplo: gender=male,female)
page: número da página para paginação (exemplo: page=1)
Exemplo de URL
Todos os cachorros: /wp-json/dogs/v1/dogs?page=1
Filtrando por idade: /wp-json/dogs/v1/dogs?age=1,2&page=1
Filtrando por tamanho: /wp-json/dogs/v1/dogs?size=small,large&page=1
Filtrando por gênero: /wp-json/dogs/v1/dogs?gender=male&page=1
Combinando filtros: /wp-json/dogs/v1/dogs?age=1,2&size=small,large&gender=male&page=1