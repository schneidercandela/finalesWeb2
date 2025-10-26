## Segundo Recuperatorio

La *Veterinaria “Pulgas Serranas”* desea modificar su sistema web para llevar la "historia clínica" de las mascotas de sus clientes. Para ello, nos entregan una base de datos con las siguientes tablas:
```
Mascota(id: int, nombre: varchar, id_cliente: int, ultimo_peso: int) 
Hitoria(id: int, fecha: date, peso: int, tratamiento: string, notas: string, id_mascota:int)
Cliente(id: int, nombre: string, email: int, telefono:string, suspendido: boolean)
```
### 1. MVC (alta) - Ingreso de un nuevo registro en la historia clínica de una mascota

Implemente el siguiente requerimiento siguiendo el patrón MVC. No es necesario realizar el router ni las vistas, <ins>sólo la función del controlador, modelos y middlewares necesarios.</ins>

Se debe poder <ins>ingresar un registro en la historia clínica de una mascota</ins> indicando los datos necesarios y cumpliendo las siguientes condiciones. Informar los errores correspondientes en caso de no cumplirlos.
* Controlar posibles errores de carga de datos.
* Verificar que el usuario esté logueado.
* Verificar que la mascota exista.
* Verificar que el cliente no esté suspendido.
* No se pueden realizar más de un tratamiento por día a las mascotas.
* Se debe actualizar el ultimo_peso de la mascota con el peso del nuevo registro en la historia clínica.


### 2. API REST (RESTful)
La veterinaria quiere desarrollar una API RESTful para brindar un servicio para acceder a la información de las historias clínicas y mascotas.

a. Defina los endpoints (verbos y urls con parámetros), para cada uno de los siguientes requerimientos. <ins>No es necesario implementar ninguno</ins>.

- Listar las historias clínicas ordenadas por fecha asc o desc: 
     - **GET**: `mascota?sortBy=fecha&oder=ASC` y/o `mascota?sortBy=fecha&oder=DESC`
- Eliminar una mascota:
    - **DELETE** `mascota/:id`
- Listar todas las mascotas de un cliente determinado:
    - **GET**: `mascota?cliente=id`
- Actualizar una historia clínica:
     - **PUT** `historia/:id`

b. Implemente sólo la <ins>función del controlador</ins> correspondiente para **"Actualizar una historia clínica"**.

c. Implemente sólo la <ins>función del controlador</ins> correspondiente para **"Listar las historias clinicas ordenadas por fecha asc o desc"**. Incluir el nombre de la mascota.

### 3. TEORÍA: Responda verdadero o falso. <ins>Justifique su respuesta.</ins>

<details> 
  <summary>i. Las verificaciones de seguridad se deben realizar del lado del servidor o del lado del cliente. Es redundante realizarla en ambos lados.</summary>
  Falso. Las verificaciones de seguridad deben realizarse del lado del servidor, porque es el único lugar confiable donde se puede garantizar la integridad de los datos y la seguridad ya que no puede ser manipulado por el usuario. 
</details>

<details> 
  <summary>ii. Para proteger una filtración de contraseñas alcanza con encriptar las mismas en la base de datos.</summary>
  Falso. Encriptar las contraseñas es una medida importante, pero no suficiente. Además, se debe usar un algoritmo de hashing fuerte (como bcrypt o Argon2).
</details>

<details> 
  <summary>iii. Client Side Renderin es un mejor enfoque que Server Side Rendering.</summary>
  Falso. Ningún enfoque es "mejor" que el otro. El Client Side Rendering (CSR) es útil para aplicaciones dinámicas y rápidas despues de cargar el sitio, pero Server Side Rendering (SSR) es mejor para SEO y tiempos de carga iniciales rapidos. La elección depende del caso de uso.
</details>

<details> 
  <summary>iv. HTTP es un protocolo de comunicación entre cliente y servidor state-less.</summary>
  Verdadero. HTTP es un protocolo sin estado (stateless), lo que significa que cada solicitud del cliente al servidor es independiente y no se guarda el contexto entre solicitudes. Se puede manejar el estado usando tecnologías como cookies o tokens.
</details>

<details> 
  <summary>v. Un mismo JWT puede sedr usado para autenticarse en varios servidores distintos.</summary>
  Verdadero. Los tokens JWT son independientes del servidor y pueden ser usados para autenticarse en varios servidores si comparten la misma clave secreta para verificar la firma del token.
</details>