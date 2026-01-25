<?php

declare(strict_types=1);

use PhpCsFixer\Config;
use PhpCsFixer\Finder;

$finder = Finder::create()
    ->in([
        __DIR__ . '/app',
        __DIR__ . '/config',
        __DIR__ . '/database',
        __DIR__ . '/routes',
        __DIR__ . '/tests',
    ])
    ->exclude([
        'bootstrap/cache',
        'storage',
        'vendor',
        'node_modules',
    ])
    ->name('*.php')
    ->notName('*.blade.php')
    ->ignoreDotFiles(true)
    ->ignoreVCS(true);

$config = new Config();

return $config
    ->setParallelConfig(\PhpCsFixer\Runner\Parallel\ParallelConfigFactory::detect())
    ->setRiskyAllowed(true)
    ->setRules([
        // Базовый набор правил для PSR-12
        '@PSR12' => true,
        '@PSR12:risky' => true,

        // Совместимость с Laravel
        'array_syntax' => ['syntax' => 'short'],
        'ordered_imports' => ['sort_algorithm' => 'alpha'],
        'no_unused_imports' => true,

        // Строки
        'single_quote' => ['strings_containing_single_quote_chars' => false],
        'concat_space' => ['spacing' => 'one'],

        // Пробелы и отступы
        'blank_line_before_statement' => [
            'statements' => ['return', 'throw', 'try'],
        ],
        'method_chaining_indentation' => true,

        // Классы
        'self_accessor' => true,
        'visibility_required' => ['elements' => ['property', 'method', 'const']],

        // Функции
        'function_declaration' => ['closure_function_spacing' => 'none'],
        'lambda_not_used_import' => true,

        // Современный PHP
        'modernize_strpos' => true,
        'get_class_to_class_keyword' => true,

        // Для Laravel Eloquent
        'no_superfluous_phpdoc_tags' => [
            'allow_mixed' => true,
            'remove_inheritdoc' => true,
        ],
    ])
    ->setFinder($finder)
    ->setCacheFile(__DIR__ . '/.php-cs-fixer.cache')
    ->setLineEnding("\n");
