<?php

if (!function_exists('file_limit_mb')) {
    /**
     * Límite de subida de archivos en MB.
     *
     * Lee setting('configuracion.fileLimit'). Si tiene un valor numérico entero
     * mayor a 0, lo usa; en cualquier otro caso (vacío, 0, negativo, decimal o
     * no numérico) devuelve el predeterminado de 5 MB.
     */
    function file_limit_mb(): int
    {
        $raw = trim((string) setting('configuracion.fileLimit'));

        return (ctype_digit($raw) && (int) $raw > 0) ? (int) $raw : 5;
    }
}

if (!function_exists('file_limit_kb')) {
    /**
     * Límite de subida en KB (para la regla de validación `max:` de Laravel).
     */
    function file_limit_kb(): int
    {
        return file_limit_mb() * 1024;
    }
}
