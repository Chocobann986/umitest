(function($, uAdmin) {
    $(function() {
        var data = uAdmin.data.data;
        var encodingFieldName = 'encoding_' + data['object-type'];
        var formatFieldName = 'format';
        var sourceFieldName = 'source_name';

        loadFieldOptions(encodingFieldName, function() {
            loadFieldOptions(formatFieldName, function() {
                var encodingSelectize = getFieldSelectize(encodingFieldName);
                var selectedEncodingId = encodingSelectize.getValue();
                var selectedEncoding = null;

                if (selectedEncodingId) {
                    selectedEncoding = encodingSelectize.getItem(selectedEncodingId)[0].innerHTML;
                }

                if (!selectedEncoding) {
                    var defaultEncoding = data['default-encoding'];

                    if (defaultEncoding.toLowerCase() === 'cp1251' || !defaultEncoding) {
                        defaultEncoding = 'Windows-1251';
                    }

                    var defaultOption = _.find(_.values(encodingSelectize.options), function(option) {
                        return option.text.toLowerCase() == defaultEncoding.toLowerCase();
                    });

                    encodingSelectize.setValue(defaultOption.value);
                }

                var formatId = parseInt($('select[name*=' + formatFieldName + '] option:selected').val());
                var csvOptionId = parseInt(data['csv-format-id']);
                var ymlOptionId = parseInt(data['yml-format-id']);
                var $encodingSelectContainer = $('select[name*=' + encodingFieldName + ']').closest('div.relation');
                var $sourceInputContainer = $('input[name*=' + sourceFieldName + ']').closest('div.col-md-6');

                if (formatId === csvOptionId || formatId === ymlOptionId) {
                    $encodingSelectContainer.show();
                    $sourceInputContainer.show();
                } else {
                    $encodingSelectContainer.hide();
                    $sourceInputContainer.hide();
                }

                getFieldSelectize(formatFieldName).on('change', function(formatId) {
                    if (formatId === csvOptionId || formatId === ymlOptionId) {
                        $encodingSelectContainer.show();
                        $sourceInputContainer.show();
                    } else if (formatId) {
                        $encodingSelectContainer.hide();
                        $sourceInputContainer.hide();
                    }
                });
            })
        });

        /**
         * ?????????????????? ?????????????????? ???????????????? ?????? ???????? ???????? "???????????????????? ????????????"
         * @param {String} fieldName ?????? ????????
         * @param {Function} callback ?????????????????????? ?????????? ???????????????? ???????????????? ?????????????????? ?? DOM
         */
        function loadFieldOptions(fieldName, callback) {
            var fieldSelect = $('select[name*=' + fieldName + ']');
            var fieldContainer = fieldSelect.closest('div.relation');

            if (fieldContainer.length === 0) {
                return;
            }

            var control = new ControlRelation({
                container: fieldContainer,
                type: fieldContainer.attr("umi:type"),
                id: fieldContainer.attr("id"),
                empty: (fieldContainer.attr("umi:empty") === "empty")
            });

            control.loadItemsAll(callback);
        }

        /**
         * ???????????????????? ???????????? selectize ????????
         * @param {String} fieldName ?????? ????????
         * @returns {*}
         */
        function getFieldSelectize(fieldName) {
            var fieldSelect = $('select[name*=' + fieldName + ']');
            return fieldSelect.data().selectize;
        }

    });

}(jQuery, uAdmin));