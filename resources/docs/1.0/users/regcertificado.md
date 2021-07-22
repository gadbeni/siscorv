- [Inicio](#access-to-list)
- [Filtros](#filters)
- [Crear Certificado](#create-certificate)
- [Vista del Certificado](#view-certificate)
- [Anular Certificado](#delete-certificate)


<a name="access-to-list"></a>
## Acceso al listado de Certificados no Adeudo
En el menu izquierdo seleccionar la opcion de certificados como se ve en la site. img.

![screenshot](/siscorv/docs/1.0/indexcertificates.png)

Muestra el listado de los certificados registrados solo de la sucursal a la que pertenece el usuario, 
solo los administradores pueden ver los certificados registrados en todas las sucursales.

<a name="filters"></a>
## Filtro
.El sistema realiza el filtro por cualquier atributo disponible de la vista

![screenshot](/siscorv/docs/1.0/search.png)

+ Codigo
+ Tipo
+ Precio
+ Carnet de Identidad
+ Nombre

<a name="create-certificate"></a>
## Registro de Certificado.
Dar Click en el boton color verde <larecipe-badge type="success" icon="fa fa-plus" rounded>Crear</larecipe-badge> el cual le mostrara una vista donde pondra la informacion necesaria para el registro del mismo 

![screenshot](/siscorv/docs/1.0/createcertificate.png)

A continuacion un listado de los campos requeridos y opcionales para su registro.

+ Tipo (`requerido`) Seleccionar interno o externo.
+ Precio (`opcional`) Se pone de forma automática dependiendo si es interno o externo.
+ Deuda (`opcional`) Si el funcionario tuviera deuda seleccionar el checkbox para habilitar el ingreso de la cantidad. 
> {info} Aclaración cuando introduzca la cantidad que adeuda presionar enter.

+ Funcionario (`requerido`) A quien le emitira el certificado, puede buscar por nombre como tambien por carnet de identidad(`recomendado`).
+ Nombre, Apellido Paterno, Apellido Materno, Ci, Alfanum, Expedido (`requerido`) Se llenan automaticamente al seleccionar el funcionario en caso de que exista.
Si Fuera Externo y no existe en la bd llenar los capos de forma obligatoria.
+ Descripcion (`requerida`) El sistema la genera de forma automática si quisiera personalizarla modificar el texto del campo.

Una vez introducido todos los datos necesarios para el registro del tomo presionar el boton 
<larecipe-badge type="info" rounded>Guardar</larecipe-badge>

Luego de haber registrado el certificado le motrara un boton donde podra imprimirlo.
<larecipe-badge type="info" rounded>Imprimir</larecipe-badge>

![screenshot](/siscorv/docs/1.0/certificate.png)

<a name="view-certificate"></a>
## Vista Certificado.
Dar Click en el boton color azul <larecipe-badge type="info" icon="fa fa-print" rounded></larecipe-badge> el cual le mostrara el certificado para poder imprimirlo.

<a name="delete-certificate"></a>
## Anulacion del Certificado.
Dar Click en el boton color rojo <larecipe-badge type="danger" icon="fa fa-trash" rounded></larecipe-badge> 
Tener en cuenta que esta opcion si es ejecutada es irreversible.