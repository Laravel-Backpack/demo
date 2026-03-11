<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages here.
    | Translated into Vietnamese by TanNhatCMS
    */

    'accepted'           => 'Trường :attribute phải được chấp nhận.',
    'active_url'         => 'Trường :attribute không phải là một URL hợp lệ.',
    'after'              => 'Trường :attribute phải là một ngày sau ngày :date.',
    'alpha'              => 'Trường :attribute chỉ có thể chứa các ký tự chữ cái.',
    'alpha_dash'         => 'Trường :attribute chỉ có thể chứa chữ cái, số và dấu gạch ngang.',
    'alpha_num'          => 'Trường :attribute chỉ có thể chứa chữ cái và số.',
    'array'              => 'Trường :attribute phải là một mảng.',
    'before'             => 'Trường :attribute phải là một ngày trước ngày :date.',
    'between'            => [
        'numeric' => 'Trường :attribute phải nằm trong khoảng :min đến :max.',
        'file'    => 'Trường :attribute phải nằm trong khoảng :min đến :max kilobytes.',
        'string'  => 'Trường :attribute phải nằm trong khoảng :min đến :max ký tự.',
        'array'   => 'Trường :attribute phải có từ :min đến :max phần tử.',
    ],
    'boolean'            => 'Trường :attribute phải là true hoặc false.',
    'confirmed'          => 'Xác nhận :attribute không khớp.',
    'date'               => 'Trường :attribute không phải là một ngày hợp lệ.',
    'date_format'        => 'Trường :attribute không khớp với định dạng :format.',
    'different'          => 'Trường :attribute và :other phải khác nhau.',
    'digits'             => 'Trường :attribute phải có :digits chữ số.',
    'digits_between'     => 'Trường :attribute phải có từ :min đến :max chữ số.',
    'distinct'           => 'Trường :attribute có giá trị trùng lặp.',
    'email'              => 'Trường :attribute phải là một địa chỉ email hợp lệ.',
    'exists'             => 'Trường đã chọn :attribute không hợp lệ.',
    'filled'             => 'Trường :attribute là bắt buộc.',
    'image'              => 'Trường :attribute phải là một hình ảnh.',
    'in'                 => 'Trường đã chọn :attribute không hợp lệ.',
    'in_array'           => 'Trường :attribute không tồn tại trong :other.',
    'integer'            => 'Trường :attribute phải là một số nguyên.',
    'ip'                 => 'Trường :attribute phải là một địa chỉ IP hợp lệ.',
    'json'               => 'Trường :attribute phải là một chuỗi JSON hợp lệ.',
    'max'                => [
        'numeric' => 'Trường :attribute không được lớn hơn :max.',
        'file'    => 'Trường :attribute không được lớn hơn :max kilobytes.',
        'string'  => 'Trường :attribute không được lớn hơn :max ký tự.',
        'array'   => 'Trường :attribute không được có nhiều hơn :max phần tử.',
    ],
    'mimes'              => 'Trường :attribute phải là một tệp loại: :values.',
    'min'                => [
        'numeric' => 'Trường :attribute phải ít nhất là :min.',
        'file'    => 'Trường :attribute phải ít nhất là :min kilobytes.',
        'string'  => 'Trường :attribute phải ít nhất là :min ký tự.',
        'array'   => 'Trường :attribute phải có ít nhất :min phần tử.',
    ],
    'not_in'             => 'Trường đã chọn :attribute không hợp lệ.',
    'numeric'            => 'Trường :attribute phải là một số.',
    'present'            => 'Trường :attribute phải có mặt.',
    'regex'              => 'Định dạng của trường :attribute không hợp lệ.',
    'required'           => 'Trường :attribute là bắt buộc.',
    'required_if'        => 'Trường :attribute là bắt buộc khi :other là :value.',
    'required_unless'    => 'Trường :attribute là bắt buộc trừ khi :other là trong :values.',
    'required_with'      => 'Trường :attribute là bắt buộc khi :values có mặt.',
    'required_with_all'  => 'Trường :attribute là bắt buộc khi :values có mặt.',
    'required_without'   => 'Trường :attribute là bắt buộc khi :values không có mặt.',
    'required_without_all' => 'Trường :attribute là bắt buộc khi không có :values có mặt.',
    'same'               => 'Trường :attribute và :other phải khớp.',
    'size'               => [
        'numeric' => 'Trường :attribute phải có kích thước là :size.',
        'file'    => 'Trường :attribute phải có kích thước là :size kilobytes.',
        'string'  => 'Trường :attribute phải có kích thước là :size ký tự.',
        'array'   => 'Trường :attribute phải chứa :size phần tử.',
    ],
    'string'             => 'Trường :attribute phải là một chuỗi.',
    'timezone'           => 'Trường :attribute phải là một múi giờ hợp lệ.',
    'unique'             => 'Trường :attribute đã được sử dụng.',
    'url'                => 'Định dạng của trường :attribute không hợp lệ.',    

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

    'custom' => [
        'attribute-name' => [
            'rule-name' => 'custom-message',
        ],
    ],

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

    'attributes' => [],

];
