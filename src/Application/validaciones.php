<?php
// validaciones.php

function integridad($data)
{
    $props = array(
        "id",
        "name",
        "referencia",
        "price",
        "peso",
        "categoria",
        "stock",
        "fecha_creacion"
    );

    foreach ($props as $key) {
        if (isset($data[$key])) {
            continue;
        } else {
            return ["La propiedad {$key} no está presente en el JSON.", true];
            break;
        }
    }
    return ["El JSON es válido", false];
}
