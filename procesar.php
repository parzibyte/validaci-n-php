<?php
require __DIR__ . '/vendor/autoload.php'; #Cargar todas las dependencias
# Establecer idioma
use Valitron\Validator as V;
V::langDir(__DIR__ . "/vendor/vlucas/valitron/lang");
V::lang('es');

# Validar

# Instanciamos, indicando el arreglo que vamos a validar. En este caso es $_POST
$v = new \Valitron\Validator($_POST);

# Agregamos todas las reglas
# La sintaxis es:
# $v->rule("nombre_de_regla", "campo_de_arreglo")

# Se requieren todos los campos
$v->rule("required", ["nombre", "edad", "correo", "pass1", "pass2"]);

# El correo debe ser un correo
$v->rule("email", "correo");

# pass1 y pass2 deberían ser iguales
$v->rule("equals", "pass1", "pass2");

# La edad debería ser un número
$v->rule("numeric", "edad");
# Y ser mayor que 17
$v->rule("min", "edad", 17);

# Después de agregar todas las reglas, intentamos validar

# Hacer validación. Regresa true o false
if ($v->validate()) {
    echo "OK, datos correctos";
} else {
    # Si no es válido, mostramos los errores

    $errores = $v->errors();
    echo "<h2>Corrige lo siguiente:</h2>";

    foreach ($errores as $conjuntoDeErrores) {
        foreach ($conjuntoDeErrores as $error) {
            echo $error . "<br>";
        }
    }
}
