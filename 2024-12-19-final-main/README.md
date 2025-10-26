## Final

La *Veterinaria “Pulgas Serranas”* desea modificar su sistema web para llevar la "historia clínica" de las mascotas de sus clientes. Para ello, nos entregan una base de datos con las siguientes tablas:
```
Mascota(id: int, nombre: varchar, id_cliente: int, ultimo_peso: int) 
Hitoria(id: int, fecha: date, peso: int, tratamiento: string, notas: string, id_mascota:int)
Cliente(id: int, nombre: string, email: int, telefono:string, suspendido: boolean)
```
### 1. MVC (Baja) - Eliminar una mascota

Implemente el siguiente requerimiento siguiendo el patrón MVC. No es necesario realizar el router ni las vistas, <ins>sólo la función del controlador, modelos y middlewares necesarios.</ins>

Se debe poder <ins>eliminar una mascota</ins> cumpliendo las siguientes condiciones. Informar los errores correspondientes en caso de no cumplirlos.
* Verificar que la mascota exista.
* Verificar que no tenga historias clínicas.
* Si es la única mascota del cliente, este debe ser eliminado.


### 2. API RESTful
La veterinaria quiere desarrollar una API RESTful para brindar un servicio para acceder a la información de las historias clínicas y mascotas.

Defina los endpoints (verbos y urls con parámetros), e implemente solo las <ins>funciones del controlador</ins> para:

a. <ins>Listar</ins> las historias clínicas de una **mascota** <ins>ordenadas</ins> por fecha asc o desc
b. Dar de <ins>alta<ins> una nueva **mascota**, donde el **cliente** es el usuario logueado
c. <ins>Modificar</ins> el ultimo_peso de una **mascota**

### 3. TEORÍA: Explique brevemente cómo funciona cada uno de los siguientes requerimientos

<details>
    <summary>a. Utilizar un mismo token JWT en 2 servidores</summary>
    Los tokens JWT los tiene el cliente y cuando quiere hacer una petición a cualquiera de los 2 servidores lo envía para autenticarse.
    Cualquier servidor puede verificar la firma del token para verificar su validez.
</details>

<details>
    <summary>b. Proteger las contraseñas cuando se filtra la base de datos</summary>
    El hashing es una función irreversible que se aplica a las contraseñas antes de ser almacenadas en la base de datos. 
    Por lo tanto, si la base de datos es filtrada, las contraseñas no pueden ser recuperadas.
</details>


<details>
    <summary>c. Identificar la sesión del usuario en un sistema SSR</summary>
    Para identificar la sesión del usuario, el browser envía una cookie en cada petición al servidor.
    Esta cookie contiene un código único que hace referencia a la sesión del usuario.
</details>

### 4. TEORÍA: Indique si las siguientes afirmaciones son verdaderas o falsas.

<details>
    <summary>a. PDO sirve para prevenir los ataques de Cross Site Scripting (XSS)</summary>
    F. PDO es una librería de PHP para conectarse a bases de datos.
</details>

<details>
    <summary>b. Se puede implementar una API REST válida que no devuelva JSON</summary>
    V. REST es una arquitectura que define cómo deben ser las peticiones y respuestas, pero no especifica el formato de los datos.
</details>

<details>
    <summary>c. Las APIs REST pueden ser consumidas por un CSR</summary>
    V. Las APIs REST pueden ser consumidas por cualquier cliente que pueda hacer peticiones HTTP.
</details>

<details>
    <summary>d. Todas las APIs necesitan al menos un método de autenticación</summary>
    F. La autenticación es opcional, depende de la necesidad del dominio de la aplicación.
</details>

<details>
    <summary>e. Si el único requerimiento no funcional es que el sitio ande en dispositivos con poca capacidad de cómputo, conviene SSR a CSR</summary>
    V. SSR es más eficiente en dispositivos con poca capacidad de cómputo, ya que el servidor se encarga de construir las vistas.
</details>

