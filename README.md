Hola bienvenido a la ducumentacion de mi API. Creada por Joaquin Pavon, para la materia WEB 2 de la carrera TUDAI.


## Se recomienda usar POSTMAN para que sea mas facil de utilizar y manipular la API.

El ENDPOINT es: ` http://localhost/trabajo-practico-especial-2/api/ `


## Arrancamos por la tabla de la BD llamada JUEGOS.

# METODO POST:
 ` $router->addRoute('game', 'POST', 'ApiController', 'insertApiGame'); `
 ` http://localhost/trabajo-practico-especial-2/api/game `

Para insertar un nuevo juego se utiliza el formato JSON de la siguiente manera:

{
"Nombre": "Mu Online",
"Fecha": "Aug 15, 2021", 
"Precio": "1200",
"Descripcion":"Juego RPG blablabla...",
"Genero_ID": "16"

}

Los GENERO_ID disponibles son los siguientes: (Se debe poner el numero de ID del genero que quieras seleccionar)
- Deportivo: 2
- Estrategia: 15
- Arcade: 16
- Simulador: 17
- Accion : 18
- Musicales: 28

Si el Genero_ID es incorrecto se informara un Error.



# METODO PUT:
`$router->addRoute('game/:ID', 'PUT', 'ApiController', 'UpdateApiGame');`
 `http://localhost/trabajo-practico-especial-2/api/game/77 `


 Para modificar un juego se debe poner la ID del juego a modificar EN LA URL y utilizar tambien el formato JSON de la siguiente manera:

 {
"Nombre": "Juego modificado",
"Fecha": "Aug 15, 2021", 
"Precio": "1200",
"Descripcion":"Juego RPG blablabla...",
"Genero_ID": "16"

}

Los GENERO_ID disponibles son los siguientes: (Se debe poner el numero de ID del genero que quieras seleccionar)
- Deportivo: 2
- Estrategia: 15
- Arcade: 16
- Simulador: 17
- Accion : 18
- Musicales: 28

Si el Genero_ID es incorrecto se informara un Error.

# METODO DELETE:
`$router->addRoute('game/:ID', 'DELETE', 'ApiController', 'DeleteApiGame');`
 `http://localhost/trabajo-practico-especial-2/api/game/77 `
 Para eliminar un juego se debe seguir la URL de arriba, poniendo la ID del juego a eliminar. Hay que tener en cuenta que el juego a eliminar no debe tener comentarios puestos si no primero va a tener que eliminar el juego. Si el juego tiene comentarios le saldra un aviso de ese respectivo error.


 # METODO GET por ID.
 `$router->addRoute('game/:ID', 'GET', 'ApiController', 'getApiGame');`
 `http://localhost/trabajo-practico-especial-2/api/game/30`
- Si nosotros queremos traer un juego por su respectiva ID tenemos que seguir la idea de la URL de arriba. Hay que estar seguros que la ID exista, si no saldra su respectivo aviso.


# METODO GETALL con sus parametros: `$router->addRoute('games', 'GET', 'ApiController', 'getApiGames');`
# Parametros:
- orderby = ASC o DESC.
- sort = Columna existente. Nombre, Fecha, Precio, Descripcion, ID_Juego, Genero_ID.
- page, limit: Cantidad para omitir y mostrar, tienen que ser INT, nunca un string, ni 0 en el page.
- filter: Filtrado por Genero_ID, los generos ID son los siguientes: 
|Deportivo: 2
|Estrategia: 15
|Arcade: 16
|Simulador: 17
|Accion : 18
|Musicales: 28


🛑🛑 EJEMPLOS de getALL 🛑🛑

`http://localhost/trabajo-practico-especial-2/api/games` Este es el getALL basico para traer todos los juegos.

`http://localhost/trabajo-practico-especial-2/api/games?orderby=ASC&sort=Precio&page=1&limit=3&filter=2` uso los cinco parametros para poder ordenar de forma ASC, por la columna precio, paginandolo y filtrandolo por el Genero 2 (deportivo).

`http://localhost/trabajo-practico-especial-2/api/games?orderby=ASC&sort=Precio&page=2&limit=1` Ordeno de manera ASC por la columna precio y lo pagino.

`http://localhost/trabajo-practico-especial-2/api/games?orderby=ASC&sort=Precio&filter=2` Ordeno de manera ASC por la columna precio filtrando por el genero 2 (deportivo).

`http://localhost/trabajo-practico-especial-2/api/games?page=1&limit=3&filter=2` Paginado con filtro por genero.

`http://localhost/trabajo-practico-especial-2/api/games?page=1&limit=5` Juegos mostrado con paginado.

`http://localhost/trabajo-practico-especial-2/api/games?orderby=desc&sort=Nombre` Juegos mostrados por orden y por alguna columna, en este caso Nombre.

`http://localhost/trabajo-practico-especial-2/api/games?filter=16` filtrado de los juegos por Genero_ID, en este caso juegos Arcade (16).



# TABLA COMENTARIOS:


# METODO POST:

`$router->addRoute('game/:ID/comentario','POST','ApiComentariosController','InsertComment');`
 `http://localhost/trabajo-practico-especial-2/api/game/33/comentario`

Al querer hacer un comentario en un juego, necesitamos traer la ID del juego y hacer el post en formato JSON de la siguiente manera:

{
"comentario": "asdasdasd",
"ID_Juego": "33"
}

Las ID_Juego disponibles son:

- Assassin's Creed 4 : 26
- Age of Empres IV: 28
- Microsoft Flight Simulator: 29
- Los sims 4: 30
- Tony Hawk's Pro Skater 1 + 2: 31
- FIFA 19: 32
- Snow Bros: 33
- Pac-Man: 34
- Mu Online: 79

# Metodo DELETE

`$router->addRoute('game/:ID/comentario/:comentarioID','DELETE' 'ApiComentariosController','DeleteComment');`
`http://localhost/trabajo-practico-especial-2/api/game/66/comentario/29`

Para eliminar un juego tengo que poner la ID del juego, con la ID del comentario a eliminar, como en el ejemplo mostrado.


# Metodo GET - Traer un comentario por ID.

`$router->addRoute('comentario/:ID', 'GET', 'ApiComentariosController', 'getComment');`
`http://localhost/trabajo-practico-especial-2/api/comentario/31`

Pongo la ID del comentario a traer. Si no existe un comentario con esa ID sera informado.


## Metodo GET - Para taer todos los comentarios de un juego.

`$router->addRoute('game/:ID/comentarios', 'GET', 'ApiComentariosController', 'getGameComments');`
`http://localhost/trabajo-practico-especial-2/api/game/28/comentarios`

Traigo todos los comentarios de un juego poniendo la ID del juego que quiero traer, si ese juego no tiene comentarios será informado.

## Metodo GET - Para traer todos los comentarios de todos los juegos.
`$router->addRoute('comentarios', 'GET', 'ApiComentariosController', 'getComments');`
`http://localhost/trabajo-practico-especial-2/api/comentarios`


## Para autenticarse y poder hacer el POST/PUT/DELETE de juegos y comentarios es necesario autenticarse por TOKEN.

`$router->addRoute("auth/token", "GET", "authApiController", "getToken");`
`http://localhost/trabajo-practico-especial-2/api/auth/token`

- joacopavon@hotmail.com y contraseña: 12345




