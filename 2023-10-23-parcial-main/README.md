### WEB 2 - Resolución  Examen Parcial 23/10/2023

TickeYa es una plataforma para la venta de tickets de recitales. El sistema ya cuenta con su base de datos con las siguientes tablas:

```
Ventas(id: int, id_evento: int, id_usuario: int, cant_entradas: int, fecha_compra: date)
Eventos(id: int, nombre: varchar, precio: float, fecha_evento: date)
Usuarios(id: int, nombre: varchar, email: varchar, activo: boolean)
```
Implemente el siguiente requerimiento siguiendo el patrón MVC. No es necesario realizar las vistas, solo controlador(es), modelo(s) y las invocaciones a la vista. 

#### Listar todas las ventas realizadas en un día dado y para un evento dado. Por cada venta se deberá indicar id de la venta, cantidad de entradas, y precio total abonado.

    i.	Controle posibles errores de carga. Suponer que la vista no realiza ningún control.
    ii.	Los ingresos de datos deben obtenerse por GET
    iii. Verificar que el evento exista 
    iv.	No es necesario implementar el router del sistema
