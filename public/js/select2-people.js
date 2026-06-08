/**
 * initPeopleSelect2
 *
 * @param {string} selector   - CSS selector del <select>
 * @param {object} options
 * @param {number} options.mode        - 1 = internos, 0 = externos (default: 1)
 * @param {string} options.placeholder - texto placeholder (default: 'Buscar...')
 *
 * @returns {{ setMode: function(number) }} objeto para cambiar modo dinámicamente
 *
 * El <select> debe tener data-url="{{ route('mamore.getpeople') }}"
 */
function initPeopleSelect2(selector, options) {
    options = options || {};

    var $el           = $(selector);
    var url           = $el.data('url');
    var intern_externo = options.mode !== undefined ? options.mode : 1;
    var placeholder   = options.placeholder || 'Buscar funcionario...';

    $el.select2({
        placeholder: placeholder,
        allowClear: true,
        minimumInputLength: 2,
        ajax: {
            url: url,
            type: 'get',
            dataType: 'json',
            delay: 250,
            data: function (params) {
                return {
                    search: params.term,
                    externo: intern_externo
                };
            },
            processResults: function (response) {
                return { results: response };
            }
        }
    });

    return {
        setMode: function (val) {
            intern_externo = val;
        }
    };
}
