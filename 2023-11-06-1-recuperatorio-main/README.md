### WEB 2 - Resolución  1º Recuperatorio 06/11/2023

TickeYa es una plataforma para la venta de tickets de recitales. El sistema ya cuenta con su base de datos con las siguientes tablas:

```
Ventas(id: int, id_evento: int, id_usuario: int, cant_entradas: int, fecha_compra: date)
Eventos(id: int, nombre: varchar, precio: float, fecha_evento: date)
Usuarios(id: int, nombre: varchar, email: varchar, activo: boolean)
```
Implemente el siguiente requerimiento siguiendo el patrón MVC. No es necesario realizar las vistas, solo controlador(es), modelo(s) y las invocaciones a la vista. 

#### Se debe poder agregar una nueva venta:

    i.  Controle posibles errores de carga. 
    ii. Los datos ingresados deben obtenerse por POST
    iii.    Verificar que el evento y el usuario existan
    iv. Controlar que existan suficientes entradas disponibles para efectuar la venta 
    v.  En caso de poder realizar la venta, actualizar la cantidad de entradas restantes.

#### Aclaraciones

 * No es necesario implementar el formulario ni las acciones que lo muestran. Solo la o las acciones que reciben los datos.
 * No es necesario implementar el router.