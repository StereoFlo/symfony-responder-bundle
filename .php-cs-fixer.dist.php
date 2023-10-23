<?php

declare(strict_types = 1);

return (new PhpCsFixer\Config())
    ->setRiskyAllowed(true)
    ->setRules([
        'array_indentation'                      => true,
        'array_syntax'                           => ['syntax' => 'short'],
        'binary_operator_spaces'                 => ['operators' => ['=' => 'align_single_space_minimal', '=>' => 'align_single_space_minimal']],
        'compact_nullable_typehint'              => true,
        'concat_space'                           => ['spacing' => 'one'],
        'declare_equal_normalize'                => ['space' => 'single'],
        'doctrine_annotation_indentation'        => true,
        'explicit_string_variable'               => true,
        'fully_qualified_strict_types'           => true,
        'increment_style'                        => [],
        'method_chaining_indentation'            => true,
        'multiline_comment_opening_closing'      => true,
        'multiline_whitespace_before_semicolons' => true,
        'no_alternative_syntax'                  => true,
        'blank_line_after_opening_tag'           => true,
        'no_useless_else'                        => true,
        'no_useless_return'                      => true,
        'ordered_class_elements'                 => ['sort_algorithm' => 'none'],
        'php_unit_method_casing'                 => ['case' => 'camel_case'],
        'phpdoc_add_missing_param_annotation'    => ['only_untyped' => true],
        'phpdoc_order'                           => true,
        'phpdoc_align'                           => true,
        'phpdoc_no_useless_inheritdoc'           => true,
        'no_superfluous_phpdoc_tags'             => true,
        'no_empty_phpdoc'                        => true,
        'ternary_to_null_coalescing'             => true,
        'declare_strict_types'                   => true,
        'no_unused_imports'                      => true,
        'single_blank_line_at_eof'               => true,
        'yoda_style'                             => ['equal' => true, 'identical' => true, 'less_and_greater' => null],
        'global_namespace_import'                => ['import_classes' => true, 'import_functions' => true,'import_constants' => true,],
        'native_function_invocation'             => [
            'exclude' => [],
            'include' => ['@internal'],
            'scope'   => 'namespaced',
            'strict'  => false,
        ],
        'native_constant_invocation' => [
            'exclude'      => ['null', 'false', 'true'],
            'include'      => [],
            'fix_built_in' => true,
            'scope'        => 'namespaced',
        ],
        'blank_line_before_statement' => ['statements' => [
            'return',
            'continue',
            'try',
        ]],
        'ordered_imports' => [
            'sort_algorithm' => 'alpha',
            'imports_order'  => ['class', 'const', 'function']
        ],
        'strict_comparison'                  => true,
        'strict_param'                       => true,
        'void_return'                        => true,
        'single_class_element_per_statement' => ['elements' => ['const']],
    ])
    ->setFinder(PhpCsFixer\Finder::create()
        ->exclude('vendor')
        ->in(__DIR__)
    );
