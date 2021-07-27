- [Inicio](#access-to-list)
- [Filtros](#filters)
- [Crear Trámite](#create-archive)
- [Vista del Trámite](#view-archive)
- [Anular Trámite](#delete-archive)


<a name="access-to-list"></a>
## Acceso al listado de Trámites
En el menu izquierdo seleccionar la opcion de entradas como se ve en la site. img.

![screenshot](/{{route}}/1.0/entradasindex.png)

Muestra el listado de todas las entradas registradas en el sistema.

<a name="filters"></a>
## Filtro
.El sistema realiza el filtro por cualquier atributo disponible de la vista

![screenshot](/{{route}}/1.0/search.png)

+ Nro de Cite
+ Origen
+ Referencia
+ Fecha de Registro

<a name="create-archive"></a>
## Registro de Trámite.
Dar Click en el boton color verde <larecipe-badge type="success" icon="fa fa-plus" rounded>Crear</larecipe-badge> el cual le mostrara una vista donde pondra la informacion necesaria para el registro del mismo, a continuacion un listado de los campos requeridos y opcionales para su registro.

+ Tipo (`requerido`) Si el documento a registrar es interno o externo.
+ Nro de Cite (`requerido`) Sera visible solo cuando el tipo de documento sea externo, caso contrario no se mostrara en la vista de registro.
+ Nro de Hojas (`opcional`) Cantidad de hojas del documento.
+ Origen (`requerido`) Lugar de donde envian el documento.
+ Remitente (`requerido`) Quien envió el documento.
+ Archivos (`opcional`) Puede agregar más de un archivo al sistema, para adjuntar este documento primero devera escanear todo el tomo convertirlo a pdf, luego subirlo al sistema.
+ Referencia (`opcional`) Alguna referencia para el registro.

Una vez introducido todos los datos necesarios para el registro del tomo presionar el boton <larecipe-badge type="info" rounded>Guardar</larecipe-badge>


<a name="view-archive"></a>
## Vista a detalle del trámite.
Dar Click en el boton color azul <larecipe-badge type="warning" icon="fa fa-eye" rounded></larecipe-badge> el cual le mostrara en una vista la informacion registrada del trámite.

<a name="delete-archive"></a>
## Anulacion de Trámite.
Dar Click en el boton color rojo <larecipe-badge type="danger" icon="fa fa-trash" rounded></larecipe-badge> 
Tener en cuenta que esta opcion si es ejecutada es irreversible.