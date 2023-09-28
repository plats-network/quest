jQuery('#w0').yiiActiveForm([{
    "id": "testmodel-boolean_var",
    "name": "boolean_var",
    "container": ".field-testmodel-boolean_var",
    "input": "#testmodel-boolean_var",
    "validate": function (attribute, value, messages, deferred, $form) {
        yii.validation.boolean(value, messages, {
            "trueValue": "1",
            "falseValue": "0",
            "message": "Boolean는 1 또는 0 이어야 합니다.",
            "skipOnEmpty": 1
        });
    }
}, {
    "id": "testmodel-range_in_string",
    "name": "range_in_string",
    "container": ".field-testmodel-range_in_string",
    "input": "#testmodel-range_in_string",
    "validate": function (attribute, value, messages, deferred, $form) {
        yii.validation.required(value, messages, {"message": "Range In Strict Mode(EN, FR, ZN)는 공백일 수 없습니다."});
        yii.validation.range(value, messages, {
            "range": ["EN", "FR", "ZN"],
            "not": false,
            "message": "Range In Strict Mode(EN, FR, ZN)가 잘못되었습니다.",
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
            "message": "Integer는 반드시 정수이어야 합니다.",
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
            "message": "Double Variable는 반드시 숫자이어야 합니다.",
            "skipOnEmpty": 1
        });
    }
}, {
    "id": "testmodel-number_min",
    "name": "number_min",
    "container": ".field-testmodel-number_min",
    "input": "#testmodel-number_min",
    "validate": function (attribute, value, messages, deferred, $form) {
        yii.validation.required(value, messages, {"message": "Number Min는 공백일 수 없습니다."});
        yii.validation.number(value, messages, {
            "pattern": /^[-+]?[0-9]*\.?[0-9]+([eE][-+]?[0-9]+)?$/,
            "message": "Number Min는 반드시 숫자이어야 합니다.",
            "min": 10,
            "tooSmall": "Number Min는 \u0022{compareValue}\u0022 보다 작을 수 없습니다.",
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
            "message": "Number Max는 반드시 숫자이어야 합니다.",
            "max": 100,
            "tooBig": "Number Max는 \u0022{compareValue}\u0022 보다 클 수 없습니다.",
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
            "message": "Number Min, Max는 반드시 숫자이어야 합니다.",
            "min": 10,
            "tooSmall": "Number Min, Max는 \u0022{compareValue}\u0022 보다 작을 수 없습니다.",
            "max": 100,
            "tooBig": "Number Min, Max는 \u0022{compareValue}\u0022 보다 클 수 없습니다.",
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
            "message": "파일 업로드 실패하였습니다.",
            "skipOnEmpty": true,
            "mimeTypes": [],
            "wrongMimeType": "Only files with these MIME types are allowed: .",
            "extensions": [],
            "wrongExtension": "다음의 확장명을 가진 파일만 허용됩니다: ",
            "maxFiles": 1,
            "tooMany": "최대 1 개의 파일을 업로드할 수 있습니다.",
            "notImage": "파일 \"{file}\"은 이미지 파일이 아닙니다."
        }, deferred);
    }
}, {
    "id": "testmodel-min_string",
    "name": "min_string",
    "container": ".field-testmodel-min_string",
    "input": "#testmodel-min_string",
    "validate": function (attribute, value, messages, deferred, $form) {
        yii.validation.string(value, messages, {
            "message": "Minimum String는 반드시 문자이어야 합니다.",
            "min": 10,
            "tooShort": "Minimum String는 최소 10자 이어야합니다.",
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
            "message": "Maximum String는 반드시 문자이어야 합니다.",
            "max": 10,
            "tooLong": "Maximum String는 최대 10자 이어야합니다.",
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
            "message": "String Min L:5, Max F1 M:10는 반드시 문자이어야 합니다.",
            "min": 5,
            "tooShort": "String Min L:5, Max F1 M:10는 최소 5자 이어야합니다.",
            "max": 10,
            "tooLong": "String Min L:5, Max F1 M:10는 최대 10자 이어야합니다.",
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
            "message": "String Min  L:4, Max F2 M:10는 반드시 문자이어야 합니다.",
            "min": 4,
            "tooShort": "String Min  L:4, Max F2 M:10는 최소 4자 이어야합니다.",
            "max": 10,
            "tooLong": "String Min  L:4, Max F2 M:10는 최대 10자 이어야합니다.",
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
            "message": "Email는 올바른 이메일 주소 형식이 아닙니다.",
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
            "message": "URL는 올바른 URL 형식이 아닙니다.",
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
            "message": "Range Min  L:5, Max F2 M:20가 잘못되었습니다.",
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
            "message": "Range in (en, fr, zn)가 잘못되었습니다.",
            "skipOnEmpty": 1
        });
    }
}, {
    "id": "testmodel-range_in_string",
    "name": "range_in_string",
    "container": ".field-testmodel-range_in_string",
    "input": "#testmodel-range_in_string",
    "validate": function (attribute, value, messages, deferred, $form) {
        yii.validation.required(value, messages, {"message": "Range In Strict Mode(EN, FR, ZN)는 공백일 수 없습니다."});
        yii.validation.range(value, messages, {
            "range": ["EN", "FR", "ZN"],
            "not": false,
            "message": "Range In Strict Mode(EN, FR, ZN)가 잘못되었습니다.",
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
