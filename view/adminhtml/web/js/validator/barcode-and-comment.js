require([
    'Magento_Ui/js/lib/validation/validator',
    'jquery',
    'mage/translate'
], function(validator, $){
    'use strict';

    validator.addRule(
        'validate-barcode-and-comment',
        function(value, params, additionalParams) {
            const barcode = $('[name="parceltemplate_fieldset[barcode]"]').val();
            const comment = $('[name="parceltemplate_fieldset[comment]"]').val();

            if ((barcode && comment) || (!barcode && !comment)) {
                return true;
            }
            return false;
        },
        $.mage.__('Both Barcode and Comment fields must be either filled or empty')
    );
});
