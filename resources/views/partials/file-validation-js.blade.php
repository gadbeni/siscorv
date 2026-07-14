{{-- Validación de archivos en el cliente: extensión, tamaño y firma real (magic bytes).
     El límite (MB) viene de setting('configuracion.fileLimit') vía helper file_limit_mb().
     Expone window.validarArchivo(file) y window.validarArchivos(fileList) -> Promise<bool>,
     y valida automáticamente cualquier <input type="file" class="imageLength">. --}}
<script>
(function () {
    if (window.__fileValidationLoaded) { return; }
    window.__fileValidationLoaded = true;

    var MAX_MB = {{ file_limit_mb() }};
    var MAX_BYTES = MAX_MB * 1024 * 1024;
    var PERMITIDAS = ['jpg', 'jpeg', 'png', 'pdf'];
    window.FILE_LIMIT_MB = MAX_MB;

    // Muestra un Swal SIEMPRE por encima de los modales de Bootstrap/Voyager.
    // El tema de Voyager fuerza .modal a z-index:100001, así que el aviso debe superarlo.
    function swalTop(opts) {
        opts.didOpen = function () {
            var c = document.querySelector('.swal2-container');
            if (c) { c.style.zIndex = '100050'; }
        };
        return Swal.fire(opts);
    }

    function alertaError(titulo, htmlBody) {
        swalTop({ icon: 'error', title: titulo, html: htmlBody, confirmButtonText: 'Entendido', confirmButtonColor: '#3097D1' });
    }

    function alertaPeso(file) {
        var mb = (file.size / 1024 / 1024).toFixed(1);
        var limitPct = Math.max(3, Math.min(100, (MAX_BYTES / file.size) * 100)).toFixed(0);
        swalTop({
            icon: 'warning',
            title: 'Archivo muy pesado',
            html:
                '<div style="max-width:300px;margin:0 auto">' +
                    '<div style="display:flex;align-items:center;gap:8px;justify-content:center;color:#555;font-size:13px;margin-bottom:14px">' +
                        '<i class="voyager-file-text" style="color:#d9534f;font-size:16px"></i>' +
                        '<span style="word-break:break-all">' + file.name + '</span>' +
                    '</div>' +
                    '<div style="position:relative;height:10px;border-radius:999px;background:#f2dede;overflow:hidden">' +
                        '<div style="height:100%;width:' + limitPct + '%;background:#5cb85c;border-radius:999px"></div>' +
                    '</div>' +
                    '<div style="display:flex;justify-content:space-between;font-size:11.5px;margin-top:6px">' +
                        '<span style="color:#3c763d;font-weight:600">Permitido: ' + MAX_MB + ' MB</span>' +
                        '<span style="color:#a94442;font-weight:600">Tu archivo: ' + mb + ' MB</span>' +
                    '</div>' +
                    '<p style="margin:16px 0 0;color:#777;font-size:13px">Comprimi el archivo o subilo dividido en partes de menos de ' + MAX_MB + ' MB.</p>' +
                '</div>',
            confirmButtonText: 'Entendido',
            confirmButtonColor: '#3097D1'
        });
    }

    // Detecta el tipo real leyendo los primeros bytes (firma del archivo).
    function tipoReal(file) {
        return new Promise(function (resolve) {
            var fr = new FileReader();
            fr.onloadend = function () {
                var b = new Uint8Array(fr.result);
                if (b[0] === 0x25 && b[1] === 0x50 && b[2] === 0x44 && b[3] === 0x46) { return resolve('pdf'); }
                if (b[0] === 0x89 && b[1] === 0x50 && b[2] === 0x4E && b[3] === 0x47) { return resolve('png'); }
                if (b[0] === 0xFF && b[1] === 0xD8 && b[2] === 0xFF) { return resolve('jpg'); }
                resolve(null);
            };
            fr.onerror = function () { resolve(null); };
            fr.readAsArrayBuffer(file.slice(0, 8));
        });
    }

    // Valida un archivo. Devuelve Promise<bool>. Muestra Swal en el primer fallo.
    window.validarArchivo = function (file) {
        return new Promise(function (resolve) {
            var ext = (file.name.split('.').pop() || '').toLowerCase();

            // 1) Extensión permitida
            if (PERMITIDAS.indexOf(ext) === -1) {
                alertaError('Formato no permitido',
                    'El archivo <b>' + file.name + '</b> no es una imagen ni un PDF.<br>' +
                    'Solo se aceptan <b>JPG, PNG o PDF</b>.');
                return resolve(false);
            }

            // 2) Tamaño máximo
            if (file.size > MAX_BYTES) {
                alertaPeso(file);
                return resolve(false);
            }

            // 3) El contenido real (firma) debe coincidir con la extensión
            tipoReal(file).then(function (real) {
                var esperado = (ext === 'jpeg') ? 'jpg' : ext;
                if (real === null || real !== esperado) {
                    alertaError('Archivo no valido',
                        'El archivo <b>' + file.name + '</b> no es un ' + ext.toUpperCase() + ' real; ' +
                        'su contenido no coincide con la extension.<br>' +
                        'Sube una imagen <b>JPG/PNG</b> o un <b>PDF</b> valido.');
                    return resolve(false);
                }
                resolve(true);
            });
        });
    };

    // Valida una lista de archivos en secuencia. Promise<bool> (true si TODOS son válidos).
    window.validarArchivos = function (files) {
        var arr = Array.prototype.slice.call(files);
        return new Promise(function (resolve) {
            (function next(i) {
                if (i >= arr.length) { return resolve(true); }
                window.validarArchivo(arr[i]).then(function (ok) {
                    if (!ok) { return resolve(false); }
                    next(i + 1);
                });
            })(0);
        });
    };

    // Inputs simples: valida al cambiar y limpia el input si algún archivo no pasa.
    $(document).on('change', '.imageLength', function () {
        var input = this;
        if (!input.files || !input.files.length) { return; }
        window.validarArchivos(input.files).then(function (ok) {
            if (!ok) { input.value = ''; }
        });
    });
})();
</script>
