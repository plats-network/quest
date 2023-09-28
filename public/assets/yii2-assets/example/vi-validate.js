jQuery('#w0').yiiActiveForm([{
    "id": "testmodel-boolean_var",
    "name": "boolean_var",
    "container": ".field-testmodel-boolean_var",
    "input": "#testmodel-boolean_var",
    "validate": function (attribute, value, messages, deferred, $form) {
        yii.validation.boolean(value, messages, {
            "trueValue": "1",
            "falseValue": "0",
            "message": "Boolean phải là \"1\" hoặc \"0\".",
            "skipOnEmpty": 1
        });
    }
}, {
    "id": "testmodel-range_in_string",
    "name": "range_in_string",
    "container": ".field-testmodel-range_in_string",
    "input": "#testmodel-range_in_string",
    "validate": function (attribute, value, messages, deferred, $form) {
        yii.validation.required(value, messages, {"message": "Range In Strict Mode(EN, FR, ZN) không được để trống."});
        yii.validation.range(value, messages, {
            "range": ["EN", "FR", "ZN"],
            "not": false,
            "message": "Range In Strict Mode(EN, FR, ZN) không hợp lệ.",
            "skipOnEmpty": 1
        });
    }
}, {
    "id": "testmodel-integer_var",
    "name": "integer_var",
    "container": ".field-testmodel-integer_var",
    "input": "#testmodel-integer_var",
    "validate": function (attribute, value, messages, deferred, $form) {
        yii.validation.number(value, messages, {
            "pattern": /^[+-]?\d+$/,
            "message": "Integer phải là số nguyên.",
            "skipOnEmpty": 1
        });
    }
}, {
    "id": "testmodel-double_var",
    "name": "double_var",
    "container": ".field-testmodel-double_var",
    "input": "#testmodel-double_var",
    "validate": function (attribute, value, messages, deferred, $form) {
        yii.validation.number(value, messages, {
            "pattern": /^[-+]?[0-9]*\.?[0-9]+([eE][-+]?[0-9]+)?$/,
            "message": "Double Variable phải là số.",
            "skipOnEmpty": 1
        });
    }
}, {
    "id": "testmodel-number_min",
    "name": "number_min",
    "container": ".field-testmodel-number_min",
    "input": "#testmodel-number_min",
    "validate": function (attribute, value, messages, deferred, $form) {
        yii.validation.required(value, messages, {"message": "Number Min không được để trống."});
        yii.validation.number(value, messages, {
            "pattern": /^[-+]?[0-9]*\.?[0-9]+([eE][-+]?[0-9]+)?$/,
            "message": "Number Min phải là số.",
            "min": 10,
            "tooSmall": "Number Min không được nhỏ hơn 10",
            "skipOnEmpty": 1
        });
    }
}, {
    "id": "testmodel-number_max",
    "name": "number_max",
    "container": ".field-testmodel-number_max",
    "input": "#testmodel-number_max",
    "validate": function (attribute, value, messages, deferred, $form) {
        yii.validation.number(value, messages, {
            "pattern": /^[-+]?[0-9]*\.?[0-9]+([eE][-+]?[0-9]+)?$/,
            "message": "Number Max phải là số.",
            "max": 100,
            "tooBig": "Number Max không được lớn hơn 100.",
            "skipOnEmpty": 1
        });
    }
}, {
    "id": "testmodel-number_min_max",
    "name": "number_min_max",
    "container": ".field-testmodel-number_min_max",
    "input": "#testmodel-number_min_max",
    "validate": function (attribute, value, messages, deferred, $form) {
        yii.validation.number(value, messages, {
            "pattern": /^[-+]?[0-9]*\.?[0-9]+([eE][-+]?[0-9]+)?$/,
            "message": "Number Min, Max phải là số.",
            "min": 10,
            "tooSmall": "Number Min, Max không được nhỏ hơn 10",
            "max": 100,
            "tooBig": "Number Min, Max không được lớn hơn 100.",
            "skipOnEmpty": 1
        });
    }
}, {
    "id": "testmodel-file_image",
    "name": "file_image",
    "container": ".field-testmodel-file_image",
    "input": "#testmodel-file_image",
    "validate": function (attribute, value, messages, deferred, $form) {
        yii.validation.image(attribute, messages, {
            "message": "Không tải được file lên.",
            "skipOnEmpty": true,
            "mimeTypes": [],
            "wrongMimeType": "Chỉ các file với kiểu MIME sau đây được phép tải lên: ",
            "extensions": [],
            "wrongExtension": "Chỉ các file với phần mở rộng sau đây được phép tải lên: ",
            "maxFiles": 1,
            "tooMany": "Chỉ có thể tải lên tối đa 1 file.",
            "notImage": "File \"{file}\" phải là một ảnh."
        }, deferred);
    }
}, {
    "id": "testmodel-min_string",
    "name": "min_string",
    "container": ".field-testmodel-min_string",
    "input": "#testmodel-min_string",
    "validate": function (attribute, value, messages, deferred, $form) {
        yii.validation.string(value, messages, {
            "message": "Minimum String phải là chuỗi.",
            "min": 10,
            "tooShort": "Minimum String phải chứa ít nhất 10 ký tự.",
            "skipOnEmpty": 1
        });
    }
}, {
    "id": "testmodel-max_string",
    "name": "max_string",
    "container": ".field-testmodel-max_string",
    "input": "#testmodel-max_string",
    "validate": function (attribute, value, messages, deferred, $form) {
        yii.validation.string(value, messages, {
            "message": "Maximum String phải là chuỗi.",
            "max": 10,
            "tooLong": "Maximum String phải chứa nhiều nhất 10 ký tự.",
            "skipOnEmpty": 1
        });
    }
}, {
    "id": "testmodel-min_max_string",
    "name": "min_max_string",
    "container": ".field-testmodel-min_max_string",
    "input": "#testmodel-min_max_string",
    "validate": function (attribute, value, messages, deferred, $form) {
        yii.validation.string(value, messages, {
            "message": "String Min L:5, Max F1 M:10 phải là chuỗi.",
            "min": 5,
            "tooShort": "String Min L:5, Max F1 M:10 phải chứa ít nhất 5 ký tự.",
            "max": 10,
            "tooLong": "String Min L:5, Max F1 M:10 phải chứa nhiều nhất 10 ký tự.",
            "skipOnEmpty": 1
        });
    }
}, {
    "id": "testmodel-min_max_string2",
    "name": "min_max_string2",
    "container": ".field-testmodel-min_max_string2",
    "input": "#testmodel-min_max_string2",
    "validate": function (attribute, value, messages, deferred, $form) {
        yii.validation.string(value, messages, {
            "message": "String Min  L:4, Max F2 M:10 phải là chuỗi.",
            "min": 4,
            "tooShort": "String Min  L:4, Max F2 M:10 phải chứa ít nhất 4 ký tự.",
            "max": 10,
            "tooLong": "String Min  L:4, Max F2 M:10 phải chứa nhiều nhất 10 ký tự.",
            "skipOnEmpty": 1
        });
    }
}, {
    "id": "testmodel-email_var",
    "name": "email_var",
    "container": ".field-testmodel-email_var",
    "input": "#testmodel-email_var",
    "validate": function (attribute, value, messages, deferred, $form) {
        yii.validation.email(value, messages, {
            "pattern": /^[a-zA-Z0-9!#$%&'*+\/=?^_`{|}~-]+(?:\.[a-zA-Z0-9!#$%&'*+\/=?^_`{|}~-]+)*@(?:[a-zA-Z0-9](?:[a-zA-Z0-9-]*[a-zA-Z0-9])?\.)+[a-zA-Z0-9](?:[a-zA-Z0-9-]*[a-zA-Z0-9])?$/,
            "fullPattern": /^[^@]*<[a-zA-Z0-9!#$%&'*+\/=?^_`{|}~-]+(?:\.[a-zA-Z0-9!#$%&'*+\/=?^_`{|}~-]+)*@(?:[a-zA-Z0-9](?:[a-zA-Z0-9-]*[a-zA-Z0-9])?\.)+[a-zA-Z0-9](?:[a-zA-Z0-9-]*[a-zA-Z0-9])?>$/,
            "allowName": false,
            "message": "Email không phải là địa chỉ email hợp lệ.",
            "enableIDN": false,
            "skipOnEmpty": 1
        });
    }
}, {
    "id": "testmodel-url_var",
    "name": "url_var",
    "container": ".field-testmodel-url_var",
    "input": "#testmodel-url_var",
    "validate": function (attribute, value, messages, deferred, $form) {
        yii.validation.url(value, messages, {
            "pattern": /^(http|https):\/\/(([A-Z0-9][A-Z0-9_-]*)(\.[A-Z0-9][A-Z0-9_-]*)+)(?::\d{1,5})?(?:$|[?\/#])/i,
            "message": "URL không phải là URL hợp lệ.",
            "enableIDN": false,
            "skipOnEmpty": 1
        });
    }
}, {
    "id": "testmodel-filter_trim",
    "name": "filter_trim",
    "container": ".field-testmodel-filter_trim",
    "input": "#testmodel-filter_trim",
    "validate": function (attribute, value, messages, deferred, $form) {
        value = yii.validation.trim($form, attribute, [], value);
    }
}, {
    "id": "testmodel-filter_trim",
    "name": "filter_trim",
    "container": ".field-testmodel-filter_trim",
    "input": "#testmodel-filter_trim",
    "validate": function (attribute, value, messages, deferred, $form) {
        value = yii.validation.trim($form, attribute, [], value);
    }
}, {
    "id": "testmodel-range_in_min_max",
    "name": "range_in_min_max",
    "container": ".field-testmodel-range_in_min_max",
    "input": "#testmodel-range_in_min_max",
    "validate": function (attribute, value, messages, deferred, $form) {
        yii.validation.range(value, messages, {
            "range": ["5", "6", "7", "8", "9", "10", "11", "12", "13", "14", "15", "16", "17", "18", "19", "20"],
            "not": false,
            "message": "Range Min  L:5, Max F2 M:20 không hợp lệ.",
            "skipOnEmpty": 1
        });
    }
}, {
    "id": "testmodel-range_in",
    "name": "range_in",
    "container": ".field-testmodel-range_in",
    "input": "#testmodel-range_in",
    "validate": function (attribute, value, messages, deferred, $form) {
        yii.validation.range(value, messages, {
            "range": ["en", "fr", "zn"],
            "not": false,
            "message": "Range in (en, fr, zn) không hợp lệ.",
            "skipOnEmpty": 1
        });
    }
}, {
    "id": "testmodel-range_in_string",
    "name": "range_in_string",
    "container": ".field-testmodel-range_in_string",
    "input": "#testmodel-range_in_string",
    "validate": function (attribute, value, messages, deferred, $form) {
        yii.validation.required(value, messages, {"message": "Range In Strict Mode(EN, FR, ZN) không được để trống."});
        yii.validation.range(value, messages, {
            "range": ["EN", "FR", "ZN"],
            "not": false,
            "message": "Range In Strict Mode(EN, FR, ZN) không hợp lệ.",
            "skipOnEmpty": 1
        });
    }
}, {
    "id": "testmodel-passwordconfirm",
    "name": "passwordConfirm",
    "container": ".field-testmodel-passwordconfirm",
    "input": "#testmodel-passwordconfirm",
    "validate": function (attribute, value, messages, deferred, $form) {
        yii.validation.compare(value, messages, {
            "operator": "==",
            "type": "string",
            "compareAttribute": "testmodel-password",
            "compareAttributeName": "Testmodel[password]",
            "skipOnEmpty": 1,
            "message": "Confirm Password must be equal to \"Password\"."
        }, $form);
    }
}], []);
