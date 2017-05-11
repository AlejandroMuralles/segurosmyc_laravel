<?php
return array(
    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | such as the size rules. Feel free to tweak each of these messages.
    |
    */
    "accepted"         => ":attribute debe ser aceptado.",
    "active_url"       => ":attribute no es una URL válida.",
    "after"            => ":attribute debe ser una fecha posterior a :date.",
    "alpha"            => ":attribute solo debe contener letras.",
    "alpha_dash"       => ":attribute solo debe contener letras, números y guiones.",
    "alpha_num"        => ":attribute solo debe contener letras y números.",
    "array"            => ":attribute debe ser un conjunto.",
    "before"           => ":attribute debe ser una fecha anterior a :date.",
    "between"          => array(
        "numeric" => ":attribute tiene que estar entre :min - :max.",
        "file"    => ":attribute debe pesar entre :min - :max kilobytes.",
        "string"  => ":attribute tiene que tener entre :min - :max caracteres.",
        "array"   => ":attribute tiene que tener entre :min - :max ítems.",
    ),
    "boolean"          => "El campo :attribute debe tener un valor verdadero o falso.",
    "confirmed"        => "La confirmación de :attribute no coincide.",
    "date"             => ":attribute no es una fecha válida.",
    "date_format"      => ":attribute no corresponde al formato :format.",
    "different"        => ":attribute y :other deben ser diferentes.",
    "digits"           => ":attribute debe tener :digits dígitos.",
    "digits_between"   => ":attribute debe tener entre :min y :max dígitos.",
    "email"            => ":attribute no es un correo válido",
    "exists"           => ":attribute es inválido.",
    "image"            => ":attribute debe ser una imagen.",
    "in"               => ":attribute es inválido.",
    "integer"          => ":attribute debe ser un número entero.",
    "ip"               => ":attribute debe ser una dirección IP válida.",
    "max"              => array(
        "numeric" => ":attribute no debe ser mayor a :max.",
        "file"    => ":attribute no debe ser mayor que :max kilobytes.",
        "string"  => ":attribute no debe ser mayor que :max caracteres.",
        "array"   => ":attribute no debe tener más de :max elementos.",
    ),
    "mimes"            => ":attribute debe ser un archivo con formato: :values.",
    "min"              => array(
        "numeric" => "El tamaño de :attribute debe ser de al menos :min.",
        "file"    => "El tamaño de :attribute debe ser de al menos :min kilobytes.",
        "string"  => ":attribute debe contener al menos :min caracteres.",
        "array"   => ":attribute debe tener al menos :min elementos.",
    ),
    "not_in"           => ":attribute es inválido.",
    "numeric"          => ":attribute debe ser numérico.",
    "regex"            => "El formato de :attribute es inválido.",
    "required"         => "El campo :attribute es obligatorio.",
    "required_if"      => "El campo :attribute es obligatorio cuando :other es :value.",
    "required_with"    => "El campo :attribute es obligatorio cuando :values está presente.",
    "required_with_all" => "El campo :attribute es obligatorio cuando :values está presente.",
    "required_without" => "El campo :attribute es obligatorio cuando :values no está presente.",
    "required_without_all" => "El campo :attribute es obligatorio cuando ninguno de :values estén presentes.",
    "same"             => ":attribute y :other deben coincidir.",
    "size"             => array(
        "numeric" => "El tamaño de :attribute debe ser :size.",
        "file"    => "El tamaño de :attribute debe ser :size kilobytes.",
        "string"  => ":attribute debe contener :size caracteres.",
        "array"   => ":attribute debe contener :size elementos.",
    ),
    "timezone"         => "El :attribute debe ser una zona válida.",
    "unique"           => ":attribute ya ha sido registrado.",
    "url"              => "El formato :attribute es inválido.",
    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attribute.rule" to name the lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
    */
    'custom' => array(
        'attribute-name' => array(
            'rule-name' => 'custom-message',
        ),
    ),
    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap attribute place-holders
    | with something more reader friendly such as E-Mail Address instead
    | of "email". This simply helps us make messages a little cleaner.
    |
    */
    'attributes' => array(
        'area_id' => 'area',
        'puesto_id' => 'puesto',
        'dpi' => 'DPI',
        'colaborador_id' => 'colaborador',
        'modulo_id' => 'modulo',
        'vista_id' => 'vista',
        'nit' => 'NIT',
        'username' => 'usuario',
        'password' => 'contraseña',
        'password_confirmation' => 'confirmación de contraseña',
        'perfil_id' => 'perfil',
        'aseguradora_id' => 'aseguradora',
        'pais_id' => 'pais',
        'departamento_id' => 'departamento',
        'municipio_id' => 'municipio',
        'cobertura_id' => 'cobertura',
        'consorcio_id' => 'consorcio',
        'pais_facturacion_id' => 'pais',
        'departamento_facturacion_id' => 'departamento',
        'municipio_facturacion_id' => 'municipio',
        'direccion_facturacion_id' => 'direccion',
        'zona_facturacion_id' => 'zona',
        'cliente_id' => 'cliente',
        'marca_id' => 'marca',
        'tipo_vehiculo_id' => 'tipo de vehículo',
        'frecuencia_pago_id' => 'frecuencia de pago',
        'dueno_id' => 'dueño',
        'ejecutivo_id' => 'ejecutivo',
        'anual_declarativa' => 'anual o declarativa',
        'vehiculo_id' => 'vehiculo',
        'poliza_declaracion_id' => 'declaración',
        'poliza_inclusion_id' => 'inclusión',
        'poliza_exclusion_id' => 'exclusion',
        'pct_deducible_robo' => 'porcentaje de deducible por robo',
        'deducible_robo' => 'deducible por robo',
        'deducible_minimo_robo' => 'deducible minimo por robo',
        'pct_deducible_dano' => 'porcentaje de deducible por daño',
        'deducible_dano' => 'deducible por daño',
        'deducible_minimo_dano' => 'deducible minimo por daño',
        'area_aseguradora_id' => 'area',
        'banco_id' => 'banco',
        'ramo_id' => 'ramo',
        'tipo_poliza_modificacion_id' => 'tipos de modificación de poliza'
        

    ),
);