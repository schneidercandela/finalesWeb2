## Final

La "Asociación Cultural El Faro" organiza talleres de arte y quiere digitalizar su sistema de gestión de talleres y alumnos. Para ello nos proveen la siguiente base de datos:

```
Taller(id: int, nombre: string, cupo_max: int, inicio: boolean, inscripcion_abierta: boolean)
Alumno(id: int, nombre: string, email: string, contraseña: string)
Inscripcion(id: int, id_alumno: int, id_taller: int, fecha_inscripcion: date, cancelada: boolean)
```

### 1. MVC (Actualización) - Desinscribirse a un taller

Implemente el siguiente requerimiento siguiendo el patrón MVC. No es necesario realizar el router ni las vistas, <ins>sólo la función del controlador, modelos y middlewares necesarios.</ins>

El sistema debe permitir que un alumno se dé de baja en un taller cumpliendo las siguientes condiciones. Informar los errores correspondientes:

- El usuario debe estar logueado.
- Verificar que el taller no haya iniciado.
- Verificar que el usuario esté inscripto en ese taller
- La inscripción se debe marcar como cancelada
- Si no inició y el cupo queda menor al máximo, volver a abrir el taller.

### 2. API RESTful

La asociación quiere desarrollar una API RESTful para brindar un servicio de consulta de inscripciones. Implemente <ins>solo la función del controlador y modelos</ins> para el siguiente requerimiento.

Listar los talleres en los que el usuario que invoca el servicio <ins>puede inscribirse<ins>. Se deben cumplir los siguientes requerimientos:

- Verificar que el usuario esté logueado
- Permitir ordenar ascendentemente o descendentemente por nombre de taller (el parámetro debe ser opcional: por defecto se ordena ascendente).

### 3. Teoría. Responda brevemente

<details>
    <summary>Explique cómo se almacena el estado de autenticación en aplicaciones con renderizado del lado del servidor y en APIs RESTful.</summary>
    En SSR se almacena en una base de datos de sessión del lado del servidor que es referenciada con una cookie almacenada en el front end. Mientras que en las API se suele almacenar la información en un token firmado con una clave privada que lo guarda el cliente.
</details>

<details>
    <summary>¿Cual es la diferencia principal entre una API REST y un sitio Server Side Rendering?</summary>
    La principal diferencia es el formato de las respuestas. Los servidores SSR responden con html mientras que las APIs suelen responder con JSON, XML, u otras estructuras que priorizan los datos por sobre el formato.
</details>

<details>
    <summary>Listá las formas de enviar datos a un servidor por HTTP con 2 ejemplos para cada una de ellas.</summary>
    URL/Query params: Ejemplo, parametros para especificar el ordenamiento, filtros de busqueda, o paginado.
    Body: Por ejemplo un formulario de contacto o un objeto json a ser insertado.
    Headers: Información extra para la petición, como puede ser el token que identifica al usuario o los formatos de respuesta acceptados.
</details>
