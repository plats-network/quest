jQuery('#w0').yiiActiveForm([{
    "id": "testmodel-boolean_var",
    "name": "boolean_var",
    "container": ".field-testmodel-boolean_var",
    "input": "#testmodel-boolean_var",
    "validate": function (attribute, value, messages, deferred, $form) {
        yii.validation.boolean(value, messages, {
            "trueValue": "1",
            "falseValue": "0",
            "message": "Boolean は \"1\" か \"0\" のいずれかでなければいけません。",
            "skipOnEmpty": 1
        });
    }
}, {
    "id": "testmodel-range_in_string",
    "name": "range_in_string",
    "container": ".field-testmodel-range_in_string",
    "input": "#testmodel-range_in_string",
    "validate": function (attribute, value, messages, deferred, $form) {
        yii.validation.required(value, messages, {"message": "Range In Strict Mode(EN, FR, ZN) は空白ではいけません。"});
        yii.validation.range(value, messages, {
            "range": ["EN", "FR", "ZN"],
            "not": false,
            "message": "Range In Strict Mode(EN, FR, ZN) は無効です。",
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
            "message": "Integer は整数でなければいけません。",
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
            "message": "Double Variable は数字でなければいけません。",
            "skipOnEmpty": 1
        });
    }
}, {
    "id": "testmodel-number_min",
    "name": "number_min",
    "container": ".field-testmodel-number_min",
    "input": "#testmodel-number_min",
    "validate": function (attribute, value, messages, deferred, $form) {
        yii.validation.required(value, messages, {"message": "Number Min は空白ではいけません。"});
        yii.validation.number(value, messages, {
            "pattern": /^[-+]?[0-9]*\.?[0-9]+([eE][-+]?[0-9]+)?$/,
            "message": "Number Min は数字でなければいけません。",
            "min": 10,
            "tooSmall": "Number Min は 10 より小さくてはいけません。",
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
            "message": "Number Max は数字でなければいけません。",
            "max": 100,
            "tooBig": "Number Max は 100 より大きくてはいけません。",
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
            "message": "Number Min, Max は数字でなければいけません。",
            "min": 10,
            "tooSmall": "Number Min, Max は 10 より小さくてはいけません。",
            "max": 100,
            "tooBig": "Number Min, Max は 100 より大きくてはいけません。",
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
            "message": "ファイルアップロードに失敗しました。",
            "skipOnEmpty": true,
            "mimeTypes": [],
            "wrongMimeType": "以下の MIME タイプのファイルだけが許可されています: ",
            "extensions": [],
            "wrongExtension": "次の拡張子を持つファイルだけが許可されています : ",
            "maxFiles": 1,
            "tooMany": "最大で 1 個のファイルをアップロードできます。",
            "notImage": "ファイル \"{file}\" は画像ではありません。"
        }, deferred);
    }
}, {
    "id": "testmodel-min_string",
    "name": "min_string",
    "container": ".field-testmodel-min_string",
    "input": "#testmodel-min_string",
    "validate": function (attribute, value, messages, deferred, $form) {
        yii.validation.string(value, messages, {
            "message": "Minimum String は文字列でなければいけません。",
            "min": 10,
            "tooShort": "Minimum String は 10 文字以上でなければいけません。",
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
            "message": "Maximum String は文字列でなければいけません。",
            "max": 10,
            "tooLong": "Maximum String は 10 文字以下でなければいけません。",
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
            "message": "String Min L:5, Max F1 M:10 は文字列でなければいけません。",
            "min": 5,
            "tooShort": "String Min L:5, Max F1 M:10 は 5 文字以上でなければいけません。",
            "max": 10,
            "tooLong": "String Min L:5, Max F1 M:10 は 10 文字以下でなければいけません。",
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
            "message": "String Min  L:4, Max F2 M:10 は文字列でなければいけません。",
            "min": 4,
            "tooShort": "String Min  L:4, Max F2 M:10 は 4 文字以上でなければいけません。",
            "max": 10,
            "tooLong": "String Min  L:4, Max F2 M:10 は 10 文字以下でなければいけません。",
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
            "message": "Email は有効なメールアドレス書式ではありません。",
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
            "message": "URL は有効な URL 書式ではありません。",
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
            "message": "Range Min  L:5, Max F2 M:20 は無効です。",
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
            "message": "Range in (en, fr, zn) は無効です。",
            "skipOnEmpty": 1
        });
    }
}, {
    "id": "testmodel-range_in_string",
    "name": "range_in_string",
    "container": ".field-testmodel-range_in_string",
    "input": "#testmodel-range_in_string",
    "validate": function (attribute, value, messages, deferred, $form) {
        yii.validation.required(value, messages, {"message": "Range In Strict Mode(EN, FR, ZN) は空白ではいけません。"});
        yii.validation.range(value, messages, {
            "range": ["EN", "FR", "ZN"],
            "not": false,
            "message": "Range In Strict Mode(EN, FR, ZN) は無効です。",
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
            "message": "Confirm Password は \"Password\" と等しくなければいけません。"
        }, $form);
    }
}], []);
