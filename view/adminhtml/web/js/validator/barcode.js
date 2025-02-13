require([
    'Magento_Ui/js/lib/validation/validator',
    'jquery',
    'mage/translate'
], function(validator, $){
    'use strict';

    validator.addRule(
        'validate-barcode',
        function(value) {
            if (!value) {
                return true;
            }
            return /^[A-Za-z0-9]{1,16}$/.test(value);
        },
        $.mage.__('Barcode can only contain letters and numbers (max 16 characters)')
    );
});
