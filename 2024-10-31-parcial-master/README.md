# WEB 2 - Resolución Examen Parcial 2024

La **Veterinaria "Pulgas Serranas"** desea desarrollar un sistema web para organizar su agenda. Desea tener el listado de mascotas y llevar registro de los turnos agendados.
Para ello nos entregan una base de datos con las siguientes tablas:

```
Turno(id: int, id_mascota: int, dia: int, mes: int, anio: int, hora: int)
Mascota(id: int, nombre: varchar, peso: int, DNI_cliente: int)
```

## Ejercicio 1 - Alta de turno
Implemente el siguiente requerimiento siguiendo el patrón MVC. No es necesario el router, ni las vistas ni los modelos: **<u>sólo la función del controlador y middlewares necesarios.</u>**

Se debe poder agregar un turno indicando todos los datos necesarios y cumpliendo las siguientes condiciones. <u>Informar los errores correspondientes en caso de no cumplirlos.</u>
- Controlar posibles errores de carga.
- Verificar que el usuario esté logueado.
- Verificar que la mascota exista.
- Verificar que no haya más de 3 turnos en una misma hora.

## Ejercicio 2 - Obtener turnos del día actual
Implemente el siguiente requerimiento siguiendo el patrón MVC. No es necesario realizar las vistas, sólo controlador(es), modelo(s) y las invocaciones a la vista.
- Se debe mostrar una lista de turnos correspondientes al día actual.
- Se debe informar el nombre de la mascota y su peso.
- Mostrar el total de turnos del día.


## Ejercicio 3 - API REST (RESTful)
La tienda quiere que sus clientes puedan administrar sus turnos desde una app. Para ello se le agrega una nueva columna a los turnos indicando el estado: ('Reservado', 'Confirmado', 'Cancelado').

Defina los **endpoints RESTful** necesarios para los siguientes requerimientos. <u>NO IMPLEMENTAR.</u>
- Administrador quiere ver turnos reservados:
    - **GET** `/turnos?estado=reservado`
- Usuario quiere agregar un nuevo turno: 
    - **POST** `/turnos`
- Usuario quiere ver el próximo turno a partir de DNI: 
    - **GET** `/turnos?dni=DNI`
- Administrador quiere confirmar o cancelar un turno: 
    - **PUT** `/turnos/:id/estado`
    - **PATCH** `/turnos/:id`
