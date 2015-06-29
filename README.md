#Descripción general:

El framework se inicializa creando una instancia de la clase Application y llamando a su método run(). Application es la encargada de orquestrar los diferentes componentes, y excepto el componente de routing que se instancia dentro del Application.php, el resto de decisiones sobre implementaciones de los componentes los haremos en el fichero index.php de la aplicación y setearemos los componentes llamando a los métodos correspondientes de la clase Application.

#Componentes:

##Controllers

Todos los controladores de la aplicación deberán implementar la interface Controller. Esta le entrará por dependencia
un objeto HttpRequest y un objeto Database.

    public function __invoke(HttpRequest $request,  Database $database);

##Database

Database utiliza dos interfaces: Database y Mysql. Está creada la implementación para PDO con mysql. Se ha creado una clase MysqlPDOConnection que extiende de PDO para hacer la conexión a la base de datos, y no hacerla instanciando PDO directamente. La clase MyslqPDO recibirá por constructor PDO que se le pasará des de Application en el momento de llamar al controlador que la tenga que utilizar. 

##Dispatching

Por un lado tenemos la clase Request que implementará array access que nos permitirá utilizar el $get, $post y $session como array. Esto lo hará httpRequest, que es la que recibirá una request en su contructor. El controlardor será el que recibirá la request y devolverá la response que podrá ser tipo web o json ahora mismo, pero se pueden crear otras implementando la interfaz Response.

Response servirá para pasar datos a la vista. En el caso de Json es sólo el array y en el caso de WebResponse se deberá pasar también el nombre del template donde se quiere printar la respuesta.

##Routing
PhpRouting y YmlRouting son implementaciones de RouteParser. Básicamente podremos utilizar uno u otro y pasándole un array con las rutas y la ruta actual nos devolverá el nombre de nuestra ruta, para que podamos definir el controlador.

#Views

Creadas clases para json y Twig. Recogerá la información Response y la pasará a la vista para renderizarla.