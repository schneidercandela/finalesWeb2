## Recuperatorio

La *Veterinaria “Pulgas Serranas”* desea desarrollar un sistema web para organizar su agenda. Desea tener el listado de mascotas y llevar registro de los turnos agendados.
Para ello, nos entregan una base de datos con las siguientes tablas:
```
Turno(id: int, id_mascota: int, dia: int, mes: int, año: int, hora: int, estado: string)
Mascota(id: int, nombre: varchar, peso: int, DNI_cliente: int, premium: boolean) 
```

### 1. MVC (actualización) - Modificar un turno en el sistema

Implemente el siguiente requerimiento siguiendo el patrón MVC. No es necesario realizar el router ni las vistas,solo la función del controlador, modelos y middlewares necesarios.

Se debe poder modificar un turno indicando todos los datos necesarios y cumpliendo las siguientes condiciones. Informar los errores correspondientes en caso de no cumplirlos.
* Controlar posibles errores de carga de datos.
* Verificar que el usuario esté logueado.
* Verificar que la mascota exista.
* Si la mascota tiene más de 10 turnos en el sistema se debe cambiar el campo premium a “verdadero” automáticamente.



### 3. API REST (RESTful)
La tienda quiere que sus clientes puedan administrar sus turnos desde una app. Para ello se le agrega una nueva columna a los turnos indicando el id_usuario a quién pertenece el turno.

a. Indique la ruta RESTful correspondiente para dar de alta un nuevo turno.

b. Implemente la función del controlador correspondiente para el alta, almacenando el usuario logueado.


### 4. TEORÍA

a. Enumere los pasos desde que el explorador web pide un sitio web SSR con MVC hasta que éste se visualiza en la pantalla indicando donde ocurre cada acción.

<details> 
  <summary>Respuesta</summary>

1. El cliente pide el sitio web

2. El router identifica la ruta

3. Se llama al controller correspondiente

4. El controller llama a los modelos correspondientes

5. El controller llama a la vista

6. La vista genera el html

7. El servidor manda el html generado al cliente

8. El browser renderiza ese HTML
</details>


b. Indique si las siguientes oraciones son verdaderas o falsas. NO ES NECESARIO JUSTIFICAR, RESPUESTA INCORRECTA RESTA PUNTAJE:


<details> 
  <summary>i. Los datos de un token JWT solo pueden ser leídos del lado del servidor</summary>
   Falso, el token JWT no está encriptado, cualquiera lo puede leer.
</details>

<details> 
  <summary>ii. Un controller puede llamar a más de un modelo por petición HTTP.</summary>
Verdadero, puede usar tantos modelos como sean necesarios.
</details>

<details> 
  <summary>iii. Conectarse a una base de datos con PDO alcanza para evitar la inyección SQL.</summary>
Falso, se necesita usar de forma segura pasando los datos ingresados por el usuario de forma parametrizada en la sentencia execute().
</details>

<details> 
  <summary>iv. Las vistas solo pueden generar código HTML.</summary>
Falso, una vista podría generar JSON, XML, YML, o cualquier formato que sea necesario.
</details>

<details> 
  <summary>v. Un middleware permite realizar procesos intermedios comunes a muchos controladores.</summary>
Verdadero, es una acción intermedia entre la petición y el controlador para realizar acciones que serán requeridas por los controladores.
</details>
