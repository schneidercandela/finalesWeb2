## Final

La biblioteca popular "Villa Italia" quiere modernizar su sistema para gestionar préstamos de libros. Para ello, nos entregan una base de datos con las siguientes tablas:

```
Libro(id: int, titulo: string, autor: string; genero: string)
Usuario(id: int, nombre: string, email: string, rol: string)
Prestamo(id:int, id_usuario: int, id_libro: int, fecha_inic: date, fecha_fin: date,devuelto: bool)
```

> [!NOTE]  
> La variable devuelto fue para simplificar el examen, pero en un sistema real se podría haber usado una fecha_fin nula para indicar que el libro no fue devuelto.

### 1. MVC (Actualización) - Marcar la devolución de un libro

Implemente el siguiente requerimiento siguiendo el patrón MVC. No es necesario realizar el router ni las vistas, <ins>sólo la función del controlador, modelos y middlewares necesarios.</ins>

Se debe poder <ins>registrar la devolución</ins> de un libro cumpliendo las siguientes condiciones. Informar los errores correspondientes en caso de no cumplirlos:

- El usuario debe estar logueado y ser administrador.
- Verificar que el libro exista y esté en un préstamo en curso.
- La fecha de devolución debe ser la actual.

### 2. API RESTful

La biblioteca quiere desarrollar una API RESTful para brindar un servicio de consulta de libros.

a. Defina los endpoints (verbos y URLs con parámetros) para cada uno de los siguientes requerimientos.

<details>
    <summary>Listar todos los préstamos de un libro</summary>
    Verbo: GET
    URL: api/prestamos?id_libro=:id
</details>
<details>
    <summary>Listar los préstamos no devueltos de un usuario</summary>
    Verbo: GET
    URL: api/prestamos?id_usuario=:id&devuelto=false
</details>
<details>
    <summary>Listar libros disponibles</summary>
    Verbo: GET
    URL: api/libros?disponibles=true
</details>
<details>
    <summary>3º página de 10 libros ordenados por nombre</summary>
    Verbo: GET
    URL: api/libros?page=3&limit=10&order=titulo
</details>

b. Implemente <ins>solo la función del controlador</ins> del servicio de **libros** para mostrar los libros disponibles.

### 3. TEORÍA

<details>
    <summary>
        a. ¿En qué situaciones resulta más conveniente utilizar una API RESTful en lugar de una arquitectura basada en SSR y viceversa? Explique las ventajas y desventajas de cada enfoque dependiendo del caso de uso.
    </summary>
    Conviene usar una API RESTful cuando se necesitan acceder a los datos desde distintas plataformas o aplicaciones, ya que se pueden reutilizar los mismos servicios. 
    También cuando se busca reducir la carga del servidor, ya que evita renderizar vistas completas.
    Por otro lado, SSR es más conveniente cuando se necesita un SEO eficiente, ya que los motores de búsqueda pueden indexar el contenido de las páginas.
    También cuando se busca que el sitio sea consumido por dispositivos con poca capacidad, ya que el servidor renderiza las vistas.
</details>

<details>
    <summary>
        b. Describa la arquitectura cliente-servidor y su flujo de comunicación, detallando los componentes principales involucrados. Explique el papel del protocolo HTTP en esta arquitectura.
    </summary>
    La arquitectura cliente-servidor es un modelo de comunicación en el que uno o más clientes envían peticiones a un servidor y este responde con las respuestas correspondientes.
    El cliente es el encargado de iniciar la comunicación mientras que el servidor está a la espera.
    En la web, el protocolo HTTP es el encargado de definir cómo se deben hacer las peticiones y respuestas entre el cliente y el servidor.
</details>
